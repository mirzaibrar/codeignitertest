<?php
if( !defined('BASEPATH')) die("Direct access not allowed");

/* 
 * @class Get the data from table on supply data to verify
 * @author Allshore Resources
 * $version 1.1.0
 * $date    02-04-2015
 */

class Login_model extends CI_Model
{
    /*
     * constructor of the model loads database
     * @author  Allshore resources
     * @verion  1.1.10
     */
    public function __construct() {
        
        $this->load->database();
        parent::__construct();
    }
    
    /*
     *@method   verif-user 
     *@desc     check the supplied username and password 
     *          and return true if record found
     * @author  Allshore resources
     * @version 1.1.0
     * @return  return true/false 
     */
    public function verify_user($username, $password)
    {
        
        $query  =   $this->db->get_where('user', array('username' => $username, 'password' => MD5($password), 'status' => '1', 'group' => '1'));
        
        if($query->row_array())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
        
    }        
}

