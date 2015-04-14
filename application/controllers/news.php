<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if( !defined('BASEPATH') ) exit('Restricted Access');

class News extends CI_Controller
{
    public $message    =   "";
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper( array( 'form', 'url' ) );
        $this->load->library('session', 'typography');
    }
    public function index()
    {
        
        $data['news']       =   $this->news_model->get_news();
        if($this->message)
            $data['message']    =   $this->message;
        $this->load->view('header');
        
        $this->load->view('news', $data);
    }
    public function view($slug)
    {
        $data['news']   =   $this->news_model->get_news($slug);
        $this->load->view('header');
        $this->load->view('newsdetail', $data);
    }
    public function add_news()
    {
        //die("Hello World");
        $this->load->view('header');
        $this->load->view('add_news_form');
    }
    public function insert_news()
    {
        //echo "<pre>";print_r($_POST);
        if( isset( $_POST ) && count( $_POST ) > 1 )
        {
            
            $title  =   $_POST['heading'];
            $title  =   str_replace(' ', '-', $title);
            $title  = str_replace('/[^A-Za-z0-9\-]/', '', $title);
            
            /**
             * file upload 
             */
            $config['upload_path']      = './uploads/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['max_size']         = '500';
            $config['max_width']        = '1024';
            $config['max_height']       = '768';
            
              
            $this->load->library( 'upload', $config );
            
           $error   = array();
            if( !$this->upload->do_upload() )
            {
                $error = array('error' => $this->upload->display_errors() );
                //$this->load->view('upload_form', $error);
            }
            else
            {
                       
                $fdata   =   array( 'upload_data' => $this->upload->data() );
                //$this->load->view( 'upload_success', $fdata );
            }    
            //file upload end
            if($error) 
            {    
                $data['message']    =   'uploaderror';
                $data['file_error'] =   $error;
                
            }
            else
            {
            
            $newsdata   =   array(
                'title'     =>  mysql_real_escape_string($_POST['heading']),
                'slug'      =>  $title,
                'detail'    =>  mysql_real_escape_string($_POST['body']),
                'image'     =>  $fdata['upload_data']['file_name']
            );
            
            $status     =   $this->news_model->insert_news($newsdata);
            
            $data['message']    =   ( $status     =   TRUE )    ?   "success" : "failed";
            }
               $this->load->view('header');     
               $this->load->view('add_news_form', $data);
            
        }
    }
    public function delete_news($id =  '') 
    {
        
       $this->message    =   ( $this->news_model->delete_news($id) ) ?
                                "News has been deleted successfully" :
                                "Sorry, There is some error while deleting, please contact web master";
       $this->session->set_flashdata( 'msg', $this->message );
       redirect( '/news/' );
       
    }
    
    public function edit_news( $id = '' )
    {
        
        $data['news_item']   =   $this->news_model->get_news_item($id);
        $this->load->view('edit_news', $data);
        
    }     
    
    public function update_news()
    {
        
        if( isset( $_POST ) && count( $_POST ) > 1 )
        {
            
            $title  =   $_POST['heading'];
            $title  =   str_replace(' ', '-', $title);
            $title  = str_replace('/[^A-Za-z0-9\-]/', '', $title);
            
            $data   =   array(
              'title'  => mysql_real_escape_string( $_POST['heading'] ),
              'slug'   => $title,
              'detail' => mysql_real_escape_string( $_POST['body'] ) 
            );
            $id =   $_POST['id'];
            
            $this->message  =   ( $this->news_model->update_news_item( $data, $id ) )    ?   "News updated Sucessfully" : "There is some error";
            $this->session->set_flashdata('msg', $this->message);
            redirect('/news/');
        }    
    }
}