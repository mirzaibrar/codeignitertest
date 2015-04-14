<?php

/* 
 * @package all database related function of front page content
 * @author Muhammad Ibrar
 * @version 1.0.0
 * @license GNU/GPL general public license
 */

class Front_model extends CI_Model
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
     * @method fetch the content from database and return
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return array 
     */
     public function get_content()
     {
         $query =   $this->db->get('articles');
         return $query->result_array();
     }
    
}
