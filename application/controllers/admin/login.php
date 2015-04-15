<?php

/* 
 * Login screen to verify to get and verify admin user credentials
 * Upon successful login class will 
 * @var     username admin username, password and staus
 * @author  allshore resources
 * @ver     1.0
 * @date    01-04-2015
 */

//Restrict direct access to this file
if( !defined('BASEPATH') ) exit('No direct access allowed to this file');

class Login extends CI_Controller
{
    public $username    =   '';
    public $password    =   '';
//    public $statu       =   '';
    
    /*
     * default constructor to load necessary libraries, helpers
     */
    public function __construct() 
    {
        parent::__construct();
       
        $this->load->helper( array('form', 'url', 'html'));
        $this->load->library(array('table' , 'form_validation', 'session'));
        $this->load->model('admin/login_model');
        
        //echo Modules::run('login');
    }
    
    /*
     * Index function to show default login screen
     */
    public function index()
    {
        if($this->session->userdata('status')   ==  TRUE)
            redirect('admin/dashboard');
        $this->load->view('admin/loginform');
        
    }        
    
    /*
     * Verify the user and redirect to admin pages
     */
    public function verify()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE)
        {    
            
            $this->load->view('admin/loginform');
        }
        else
        {
            $this->username   =   $this->input->post('username');
            $this->password   =   $this->input->post('password');
            if( $this->login_model->verify_user($this->username, $this->password)   ==  TRUE )
            {
                $userdata   =   array(
                                       'username' => $this->username,
                                       'status'   => TRUE     
                                     );
                $this->session->set_userdata($userdata);
                redirect('admin/dashboard');
            }
            else
            {
                die("Alas! I am not the admin");
            }
        }
    }
}
