<?php
if (!defined('BASEPATH')) die('Direct access not allowed');

/* 
 *controller class that show the statistics of admin activity in section.
 * @author  Allshore resources
 * @version 1.0.0
 * @date    02-04-2015
 */

class Dashboard extends CI_Controller
{
    
    /*
     * @function    default constructor to load classes and initialize data
     * @author      Allshore resources
     * @version     1.0.0
     * @return      void
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
//        if(!$this->session->userdata('status'))
//        {
//            redirect('admin/login');
//        }
    }
    
    /*
     * @function    default function to show initial screen
     * @author      Allshore resources
     * @version     1.0.0
     * @return      void
     */
    public function index()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/dashboard');
    }
    
}

