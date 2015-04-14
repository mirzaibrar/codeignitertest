<?php
if(!defined('BASEPATH')) die('Direct access to this file is not allowed');
/* 
 * @class Controlls the articles and its crud operations
 * @author Muhammad Ibrar
 * @version 1.0.0
 * @licence GNU/GPL General Public License
 */

class Articles extends CI_Controller
{
    
    /*
     * @function default constructor to initialize variables and load class
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    
    public function __construct()
    {
        
        parent::__construct();
        $this->load->library(array('session', 'table'));
        $this->load->helper(array('url', 'form'));
        $this->load->model('admin/article_model');
        
        if(!$this->session->userdata('status'))
        {
            redirect('admin/login');
        }
        $this->tinyMce = '
			<!-- TinyMCE -->
			<script type="text/javascript" src="'. base_url().'uploads/texteditors/tiny_mce/tinymce.min.js"></script>
			<script type="text/javascript">
				tinyMCE.init({
					// General options
					mode : "specific_textareas",
                                        editor_selector: "content_editor",
					theme : "modern"
                                        
                                        
				});
			</script>
			<!-- /TinyMCE -->
			';	
        
    }
    
    /*
     * @function default constructor to initialize variables and load class
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function index()
    {
        $list   =   $this->article_model->get_articles();
        $data['articles']   =   $list;
        $this->load->view('admin/articles', $data);
    }
    
    /*
     * @function show article form to take the values to add article
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function add()
    {
        $data['title']      =   '';
        $data['excerpt']    =   '';
        $data['detail']     =   '';
        
        $acl    =   $this->article_model->get_acl();
        $data['acl']        =   $acl;
        
        if($_POST && count($_POST)>0)
        {
            
            //form validation
            $this->load->library('form_validation');
        
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('excerpt', 'Excerpt', 'required');
            $this->form_validation->set_rules('content', 'Detail', 'required');
            
            $title    =   $this->input->post('title');
            $excerpt  =   $this->input->post('excerpt');
            $detail   =   $this->input->post('content');
            $access   =   $this->input->post('access');
            
            $insertdata =   array(
                'title'     =>  $title,
                'excerpt'   =>  $excerpt,
                'detail'    =>  $detail
            );
            //file upload settings
            $config['upload_path']  =   "./uploads";
            $config['max_witdh']    =   "1024";
            $config['max_height']   =   "1024";
            $config['max_size']     =   "1024";
            $config['allowed_types']     =   "gif|png|jpg";
            //load library
            $this->load->library('upload', $config);
            
            $error  =   array();
            
            if(!$this->upload->do_upload())
            {
                $error    =   array('error' =>  $this->upload->display_errors());
                $data['message']    =   'uploadfail';
            }
            else
            {
                $fdata  =   array('upload_data' =>  $this->upload->data());
                $insertdata['image']    =   $fdata['upload_data']['file_name'];
            }
            
            if(empty($error))
            {
                if($this->form_validation->run()    ==  FALSE)
                {
                    $error  =   array('validate'=> validation_errors());
                    $data['message']    =   'validate_fail';
                    unlink("./uploads/".$fdata['upload_data']['file_name']);
                }
                else
                {
                    if($this->article_model->insert_article($insertdata))
                    {
                        $data['message']    =   'success';
                    }
                    else
                    {
                        $data['message']    =   'db_fail';
                    }
                }
            }
            else
            {
                $data['error']  =   $error;
            }
            
        }
        $this->load->view('admin/header');
        $this->load->view('admin/add_article_form', $data);
       
    }
}
    