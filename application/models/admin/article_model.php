<?php

if(!defined("BASEPATH")) die('Direct access is not allowed to this page');

/* 
 *@class Model class containing the crud database functions for articles
 *@author  Muhammad Ibrar
 *@version 1.0.0
 *@license  GNU/GPL
 */

class Article_model extends CI_Model
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
        $this->load->database();
    }
    
    /*
     * @function getch articles from database and return depending on codition passed through parameters
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return array 
     */
    public function get_articles($cond  =   array())
    {
        if($cond)
        {
            $query  =   $this->db->get_where('articles',$cond);
        }
        else
        {
            $query  =   $this->db->get('articles');
        }
        
        return $query->result_array();
    }
    
    /*
     * @function inserts new article into database
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return Boolean 
     */
    public function insert_article($data)
    {
        return ($this->db->insert('articles',$data)) ? TRUE : FALSE;
    }
    
    /*
     * @function fetch the default access levels and return
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return array 
     */
    public function get_acl()
    {
        $query  =   $this->db->get('levels');
        return $query->result_array();
    }
}