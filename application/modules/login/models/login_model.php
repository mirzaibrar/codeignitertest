<?php

/* 
 * @package contain the db operations for the login functions
 * @author Muhammmad Ibrar
 * @version 1.0.0
 */

class Login_form extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
}