<?php
if(!defined('BASEPATH')) die('Direct access to this file is not allowed');
/* 
 * @class Controlls the user access level groups and crud functionality
 * @author Muhammad Ibrar
 * @version 1.0.0
 * @licence GNU/GPL General Public License
 */

class Groups extends CI_Controller
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
        $this->load->model('admin/group_model');
        
        if(!$this->session->userdata('status'))
        {
            redirect('admin/login');
        }
        
    }
    
    /*
     * @function default page to load basic screen
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function index()
    {
  
        $groups     =   $this->group_model->parent_child();
        $parent     =   $this->group_model->get_groups(array('parent'=>0));
        
        $newar  =   array();
        $str="";      
        foreach($parent as $par)
        {
            $newar=  $this->_buildTree($groups, $par['id']);
            //onesol $str = $this->_traverse_tree($newar);
           $toppar =   "<strong>".$par['groupname']."</strong>";
            $str.= anchor('admin/groups/edit/'.$par['id'],$toppar);
            $str .= $this->_traverse_tree($newar);
        }    
       
        $data['groupstr']    =   $str;
        
        //$this->_traverse_tree($newar);
        
        
        $this->load->view('admin/header');
        $this->load->view('admin/groups', $data);
        
    }

     public function _traverse_tree($newar, $i=0, $code='')
    {
//onsolution        static $code    =   '';
                    //secsol        
                    $code    =   '';

        foreach($newar as $node)
        {
            $code   .=  "<div style='margin-top:5px;margin-bottom:5px;'>|---";
            for( $k= 0; $k<$i; $k++ )
            {
                 $code .= "|--- ";
            }
                 $code .= anchor('admin/groups/edit/'.$node['cid'],$node['child'])."<BR>";
            
            
            if(isset($node['children']))
            {
                $i++;
                
                //secsol
                $code .= $this->_traverse_tree($node['children'], $i, $code);
                //onesol
                $this->_traverse_tree($node['children'], $i, $code);
                
            }
            $code   .=  "</div>";
        }
        return $code;
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
    
    
    /*
     * @function add new user group
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function add()
    {
        $groups =   $this->group_model->get_groups();
        $data['groups'] =   $groups;
        
        $this->load->view('admin/header');
        $this->load->view('admin/add_group', $data);
    }
    
    
    /*
     * @function save the user group into the database
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function insert()
    {
        $this->load->library('form_validation');
        $groups =   $this->group_model->get_groups();
        $data['groups'] =   $groups;
        
        if($_POST)
        {
            $this->form_validation->set_rules('groupname', 'Group Name', 'required');
            
            if($this->form_validation->run()    ==  FALSE)
            {
                echo validation_errors();
            }
            else
            {
                $groupname  =   $this->input->post('groupname');
                $parent     =   $this->input->post('parent');
                
                $data['groupname']  =   $groupname;
                $data['parent']     =   $parent;
                
                if($this->_validate_group($groupname))
                {
                    $data['gerror'] =   'exist';
                }
                else
                {
                    $gdata  =   array(
                        'groupname' =>  $groupname,
                        'parent'    =>  $parent,
                        'status'    =>  1
                    );
                    if($this->group_model->insert($gdata))
                    {
                        $data['gerror'] =   'success';
                    }
                    else
                    {
                        $data['gerror'] =   'failed';
                    }
                }
            }
        }
        
        $this->load->view('admin/header');
        $this->load->view('admin/add_group', $data);
    }
    
    
    /*
     * @function edit the user group details
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function edit()
    {
        
        $this->load->view('admin/header');
        $this->load->view('admin/edit_group');
    }
    
    
    /*
     * @function check if user group already exists
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return boolean 
     */
    public function _validate_group($groupname)
    {
        $group  =   array('groupname'   =>  $groupname);
        $array  =   $this->group_model->get_groups($group);
        return (!empty($array['groupname'])) ? TRUE  :   FALSE;
    }
    
    
    
}
