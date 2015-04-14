<?php

if(!defined('BASEPATH'))  die('Direct access not allowed for this page');

/* 
 * controlls all the activity/functionality of admin user.
 * @author      allshore resources
 * @version     1.0.0
 * @created     02-04-2015 
 */
class User extends CI_Controller
{
    /*
     * @function default constructor to initialize the necessary variables and load classes
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @created 02-04-2015
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->library(array('session' , 'table'));
        $this->load->helper('url', 'form');
        $this->load->model('admin/user_model');
        if(!$this->session->userdata('status'))
        {
            redirect('admin/login');
        }
    }
    
    /*
     * @function default function for the user to show the list and crud operation links
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @created 02-04-2015
     */
    public function index()
    {
        $filter =   array();
        $data   =   array();
        
        if($this->uri->segment(3) ==  'filter')
        {    
            $filter =   $this->uri->uri_to_assoc(4);
            
        }
       
        $users_list   =   $this->user_model->get_users($filter);
        $data['users']  =   $users_list;
        $this->load->view('admin/header');
        $this->load->view('admin/user', $data);
    }
    
    /*
     * @function logouts user from the admin area and redirect to login form
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @created 02-04-2015
     */
    public function logout()
    {
        $this->session->unset_userdata('status');
        redirect('admin/login');
    }
    
    /*
     * @function add new user
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @created 02-04-2015
     * @return void
     */
    public function add_user()
    {
        $this->load->library(array('form_validation'));    
       $userdata   =   array(
                        'username'  =>  '',
                        'password'  =>  '',
                        'firstname' =>  '',
                        'lastname'  =>  '',
                        'email'     =>  '',
                        'status'    =>  '',
                        'group'     =>  ''
                    );
        if(!empty($_POST)){
             $userdata['etype'] =   "";
            //
            $this->form_validation->set_rules('firstname',  'First Name',            'required');
            $this->form_validation->set_rules('lastname',   'Last Name',            'required');
            $this->form_validation->set_rules('username',   'User Name',            'required');
            $this->form_validation->set_rules('password',   'Password',             'required');
            $this->form_validation->set_rules('cpassword',  'Confirm Password',     'required');
            $this->form_validation->set_rules('email',      'Email',                'required');
            
            $firstname  =   $this->input->post('firstname');
            $lastname   =   $this->input->post('lastname');
            $username   =   $this->input->post('username');
            $password   =   $this->input->post('password');
            $cpassword  =   $this->input->post('cpassword');
            $email      =   $this->input->post('email');
            $status     =   $this->input->post('active');
            $group      =   $this->input-> post('group');
            
            //set user information array
            $userdata   =   array(
                'username'  =>  $username,
                'password'  =>  md5($password),
                'firstname' =>  $firstname,
                'lastname'  =>  $lastname,
                'email'     =>  $email,
                'status'    =>  $status,
                'group'     =>  $group
            );
            if($this->form_validation->run()    ==  FALSE)
            {
                echo validation_errors(); 
                $userdata['message']    =   'failed';
                
            }
            else
            {
                if($this->_compare_passwords($password, $cpassword)  ==  FALSE)
                {
                    $userdata['message']    =   'failed';
                    $userdata['etype']      =   'passfailed';
                } 
                else if($this->_validate_email($email)   ==  'invalid')
                {
                    $userdata['message']    =   'failed';
                    $userdata['etype']      =   'emailfailed';
                }
                else if($this->_user_exist( $username )    ==  TRUE)
                {
                    $userdata['message']    =   'failed';
                    $userdata['etype']      =   'userexist';
                }    
                else
                {
                    
                    if($this->user_model->insert($userdata)    ==  TRUE)
                    {
                        $userdata['message']    =   'success';
                    }
                    else
                    {
                        $userdata['message']    =   'failed';
                    }
                }
                
            }
            
        }
        $userdata['groups'] =   $this->user_model->get_groups();
        $this->load->view('admin/header');
        $this->load->view('admin/add_user_form', $userdata);
    }
    
    /**
     * @function Retrives the user data from database and send to form
     * @author      Muhammad Ibrar
     * @version     1.0.0
     * @return void
     **/
    public function edit_user($id)
    {
        if($id)
        {
            $cond       =   array('id' => $id);
            $userinfo   =   $this->user_model->get_single_user($cond);
            //$group      =   $this->user_model->get_user_group($userinfo['group']);
            $groups =   array();
            $groups     =   $this->user_model->get_groups();
            $data   =   array(
                'id'        =>  $id,
                'username'  =>  $userinfo['username'],
                'firstname' =>  $userinfo['firstname'],
                'lastname'  =>  $userinfo['lastname'],
                'email'     =>  $userinfo['email'],
                'status'    =>  $userinfo['status'],
                'groupid'   =>  $userinfo['group'],
                'groups'    =>  $groups
                
            );
            
            $this->load->view('admin/header');
            $this->load->view('admin/edit_user_form', $data);
        }    
    }        
    
    /**
     * @function update user 
     * @author   Muhammad Ibrar
     * @version  1.0.0
     * @return   void
     **/
    public function update_user()
    {
        $this->load->library(array('form_validation'));
       
        if(!empty($_POST)){
             $userdata['etype'] =   "";
             
            //
            $this->form_validation->set_rules('firstname',  'First Name',           'required');
            $this->form_validation->set_rules('lastname',   'Last Name',            'required');
            $this->form_validation->set_rules('username',   'User Name',            'required');
            $this->form_validation->set_rules('password',   'Password',             'notrequired');
            $this->form_validation->set_rules('cpassword',  'Confirm Password',     'notrequired');
            $this->form_validation->set_rules('email',      'Email',                'required');
            
            if($this->form_validation->run()    ==  FALSE)
            {
             
                echo validation_errors(); 
                $userdata['message']    =   'failed';
            }
            else
            {
                $userid     =   $this->input->post('id');
                $firstname  =   $this->input->post('firstname');
                $lastname   =   $this->input->post('lastname');
                $username   =   $this->input->post('username');
                $password   =   $this->input->post('password');
                $cpassword  =   $this->input->post('cpassword');
                $email      =   $this->input->post('email');
                $status     =   $this->input->post('active');
                $group      =   $this->input->post('group');
                
                 //set user information array
                    $userdata   =   array(
                        'username'  =>  $username,
                        'password'  =>  md5($password),
                        'firstname' =>  $firstname,
                        'lastname'  =>  $lastname,
                        'email'     =>  $email,
                        'status'    =>  $status,
                        'group'     =>  $group
                    );
                
                if($this->_compare_passwords($password, $cpassword)  ==  FALSE)
                {
            
                    $userdata['message']    =   'failed';
                    $userdata['etype']      =   'passfailed';
                } 
                else if($this->_validate_email($email)   ==  'invalid')
                {

                    $userdata['message']    =   'failed';
                    $userdata['etype']      =   'emailfailed';
                }
                else if($this->_user_exist( $username, $userid )    ==  TRUE)
                {
                    $userdata['message']    =   'failed';
                    $userdata['etype']      =   'userexist';
                }    
                else
                {
                     
                   
                    if($this->user_model->update($userdata, $userid)    ==  TRUE)
                    {
                        $userdata['message']    =   'success';
                    }
                    else
                    {
                        
                        $userdata['message']    =   'failed';
                    }
                }
                
            }
           if($userdata['message']  ==  'success') {
              
               $this->session->set_flashdata('msg', 'User updated Successfully');
               redirect('admin/user');
           }
           else
           {
               
               $groups =   array();
               $groups     =   $this->user_model->get_groups();
               $userdata['groups']  =   $groups;
               $userdata['groupid']=    $group;
               $userdata['id']=    $userid;
               $this->load->view('admin/header');
               $this->load->view('admin/edit_user_form', $userdata);
           }
        }
    }
    
    /**
     * @function delete user from database
     * @author      Muhammad Ibrar
     * @version     1.0.0
     * @return void
     **/
    public function delete_user($userid)
    {
       
        if($this->user_model->delete($userid)) 
        {
             $message    =   "User deleted successfully";
        }
        else
        {
            $message    =   "There is some error deleting the user, please try again";
        }
        $this->session->set_flashdata('msg', $message);
        redirect('admin/user');
    }
    
    /**
     * @function validate the username already exists
     * @author      Muhammad Ibrar
     * @version     1.0.0
     * @return boolean Function will check if username already exists in admin
     **/
    public function _validate_email($email)
    {
        $query  =   $this->db->get_where('user', array('email' => $email));
        if($query->result_array)
        {
            $error  =   'exist';
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $error  =   'invalid';
        }else
        {
            return 'valid';
        }
        return $error;
    }
    
    
    /*
     * @function compare password and confirm passwords
     * @author Muhammad Ibrar
     * @version 1.0.0
     * @return boolean 
     */
    public function _compare_passwords($pass, $cpass)
    {
        return ($pass   ==  $cpass) ? TRUE  :   FALSE;
    }
    
    
    /*
     * @function Checks the user if username already exists in database
     * @author Muhammad Ibrar
     * @version 1.0.0
     * @return boolean 
     */
    public function _user_exist($username, $id='')
    {
        
        if($id)
        {
            $userarray  =   array('id' => $id);
            $singleuser =   array();
            $singleuser =    $this->user_model->get_single_user($userarray);
            if($singleuser['username']  ==  $username)
            {
                return FALSE;
            }
            else
            {
                
                $userarray  =   array('username' => $username);
                $singleuser =   array();
                $singleuser =    $this->user_model->get_single_user($userarray);
                return (!empty($singleuser)) ? TRUE : FALSE;
            }
        }
        else
        {
            $userarray  =   array('username' => $username);
            $singleuser =   array();
            $singleuser =    $this->user_model->get_single_user($userarray);
            return (!empty($singleuser)) ? TRUE : FALSE;
        }    
        
    }
}

