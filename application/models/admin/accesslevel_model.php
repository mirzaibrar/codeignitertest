<?php

if(!defined("BASEPATH")) die('Direct access is not allowed to this page');

/* 
 *@package Model class containing the crud database functions for access levels
 *@author  Muhammad Ibrar
 *@version 1.0.0
 *@license  GNU/GPL
 */

class Accesslevel_model extends CI_Model
{
    
    /*
     * @method default constructor to initialize variables and load class
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
    /*
     * @method function to show fetch access levels and return 
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return array
     */
    public function get_levels($cond    =   '')
    {
        if($cond)
        {
            $query  =   $this->db->get_where('levels',$cond);
        }
        else
        {
            $query  =   $this->db->get('levels');
        }
        
        return $query->result_array();
    }
    
    /*
     * @method  get the user groups from the database
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @License GNU/GPL general public license
     * @return array
     */
    public function get_usergroups()
    {
        $query  =   $this->db->get('user_group');
        return $query->result_array();
    }
    
    
    /*
     * @method  Insert the levels into database
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @License GNU/GPL general public license
     * @return array
     */
    public function insert($data)
    {
        return ($this->db->insert('levels', $data))?    TRUE :  FALSE;
    }
}