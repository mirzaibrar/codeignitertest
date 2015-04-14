<?php
if(!defined('BASEPATH')) die('Direct access to this file is not allowed');

/* 
 * @class model class provide access to database for user groups 
 * @author Muhammad Ibrar
 * @version 1.0.0
 * @License GNU/GPL General Public License
 */

class Group_model extends CI_Model
{
    
    /*
     * @function default constructor to initialize variables and load class
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return void 
     */
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /*
     * @function load the list of groups 
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return array 
     */
    public function get_groups($cond    =   '')
    {
        
        if($cond)
        {
            $this->db->where($cond);
            $groups =   $this->db->get('user_group');
            return $groups->result_array();
        }
        
        $groups =   $this->db->get('user_group');
        
        return $groups->result_array();
    }
    
    
    /*
     * @function Insert new group into the database 
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return array 
     */
    public function insert($data)
    {
        
        return ( $this->db->insert('user_group', $data) ) ? TRUE   :   FALSE;
        
    }
    
    
    /*
     * @function Insert new group into the database 
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @return array 
     */
    public function parent_child()
    {
        
        $this->db->select('a.id as cid, a.groupname as child, b.id as pid, b.groupname as parent');
        $this->db->from('user_group a');
        $this->db->join('user_group b','a.parent=b.id', 'left join');
        $query  =   $this->db->get();

        return $query->result_array();
        
        
    }
    
}