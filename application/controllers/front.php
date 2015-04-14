<?php
if(!defined('BASEPATH')) die ('Direct access to this page not allowed');
/*
 * @package shows the default page for the website including login screen
 * @author  Muhammad Ibrar
 * @version 1.0.0
 * @license GNU/GPL general public license
 */

class Front extends MX_Controller
{
    
    /*
     * @method  default constructor function to initialize variables and load classes
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @license GNU/GPL general public license
     * @return  void
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('front_model');
    }
    
    /*
     * @method  Default page for website that shows the front end content
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @license GNU/GPL general public license
     * @return  void
     */
    public function index()
    {
        $data['contentlist']    =   $this->front_model->get_content();
        
        $this->load->view('header');
        $this->load->view('front', $data);
    }
}

