<?php
if(!defined('BASEPATH')) die('Direct access to this file is not allowed');
/* 
 * @class Controlls the articles and its crud operations
 * @author Muhammad Ibrar
 * @version 1.0.0
 * @licence GNU/GPL General Public License
 */

class Accesslevel extends CI_Controller
{
    
    /*
     * @function default constructor to initialize variables and load class
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    
    public function __construct()
    {
        /**
         *@method constructor __construct(void) default constructor function to load classes and initialize variables
         *@author Muhammad Ibrar
         *@version 1.0.0
         *@return void constructor doesn't return anything  
         **/
        parent::__construct();
        $this->load->library(array('session', 'table'));
        $this->load->helper(array('url', 'form'));
        $this->load->model('admin/accesslevel_model');
        $this->load->model('admin/group_model');
        
        if(!$this->session->userdata('status'))
        {
            redirect('admin/login');
        }
    }
    
    
    /*
     * @method default method to load and show list of access levels
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function index()
    {
        $data['levels'] =   $this->accesslevel_model->get_levels();
         
        $this->load->view('admin/header');
        $this->load->view('admin/accesslevel', $data);
    }
    
    /*
     * @method  void add(void) will show the form and add the access level into the database
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function add()
    {
        $groups =   $this->group_model->parent_child();
        $parent     =   $this->group_model->get_groups(array('parent'=>0));
        
        $newar  =   array();
        $finar  =   array();
        $str="";      
        foreach($parent as $par)
        {
            $newar=  $this->_buildTree($groups, $par['id']);
            //onesol $str = $this->_traverse_tree($newar);
            array_push($finar,array($par['id']  =>  $par['groupname']));
            $finar  =   $this->_traverse_tree($newar,'', '', $finar);
            
        }    
        $data['groupar']    =   $finar;
        /********************************************
         * check if form is posted
         ********************************************/
        if(isset($_POST) && count($_POST) > 0)
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Level Name', 'required');
            $this->form_validation->set_rules('usergroups', 'User Group', 'required');
            
            if($this->form_validation->run()    ==  FALSE)
            {
                echo validation_errors();
                $data['msg']    =   "failed";
            }
            else
            {
                $levelname  =   $this->input->post('name');
                foreach ($this->input->post('usergroups') as $groups)
                {
                  $level_groups[] =   $groups;
                }
                $idata['name']  =   $levelname;
                $idata['groups']    = serialize($level_groups);
                if($this->accesslevel_model->insert($idata))
                {
                    $data['message']    =   "success";
                }
                else
                {
                    $data['message']    =   "dbfail";
                }
            }
            
            
        }
        $this->load->view('admin/header');
        $this->load->view('admin/accesslevel_add_form', $data);
    }
    
    
    public function _traverse_tree($newar, $i=0, $code='', $finar)
    {
        
//onsolution        static $code    =   '';
                    //secsol        
                    //$code    =   '';

        foreach($newar as $node)
        {
            if($code    !="")
                $code   =   '';
            $code   .=  "|---";
            for( $k= 0; $k<$i; $k++ )
            {
                 $code .= "|--- ";
            }
                 $code .= $node['child'];
            
            $itemelement  = array($node['cid']  =>  $code);
            array_push($finar, $itemelement);
            if(isset($node['children']))
            {
                $i++;
                
                //secsol
                $finar= $this->_traverse_tree($node['children'], $i,'', $finar);
                //onesol
               //$this->_traverse_tree($node['children'], $i, $code);
            }
            
           
        }
        
        return $finar;
    }
    
    /*
     * @method  build the tree and returns the parent child structure of array
     * @author Muhammad Ibrar
     * @version 1.0.0
     * @return  array
     * @license GNU/GPL General Public Lincense
     */
    public function _buildTree(array $dataset, $pid) {
    $tree = array();
    
    foreach ($dataset as  $group) {
      // echo $pid."---".$group['pid']."<BR>";
        if($pid ==  $group['pid'])
        { 
            //$tree[$pid][$group['cid']]=  $group['child'];
            
            $child =    $this->_buildTree($dataset, $group['cid']);
            
            if($child)
            {
                $group['children'] =   $child;
            }
            $tree[]=    $group;
            //print_r($tree);
        }  
        
    }

   return $tree;
} 
}    