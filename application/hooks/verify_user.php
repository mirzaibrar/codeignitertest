<?php
 if(!defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * @package this class will authenticate user
 * @author Muhammad Ibrar
 * @version 1.0.0
 * @variable   private CI  
 */

class Verify_user
{
    //variable to assing object of the codeigniter main class
    private $CI;
    
    
    /**
     * @method default method to load the instance and assing the class variable
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return  void
     */
    public function __construct() 
    {
        $this->CI   =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('url');
      echo  $this->CI->session->userdata('username');
    }
    
    /**
     * @method  default page method to check the user session and its values
     * @author Muhammad Ibrar
     * @version 1.0.0
     * @return void
     */
    public function check()
    {
        echo "HELLO WORLD";
        echo "I M HERE ";exit;
        if(!$this->CI->session->userdata('status'))
        {
            redirect('admin/login');
        }
        else
        {
            redirect('admin/dashboard');
        }
    }
}

