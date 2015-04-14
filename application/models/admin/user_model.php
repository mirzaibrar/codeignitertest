<?php
if(!defined('BASEPATH')) die('Direct access to this file is not allowed');
/* 
 * All user management function to get and set into database.
 * @author      Muhammad Ibrar
 * @version     1.0.0
 * @created     02-04-2015
 */
class User_model extends CI_Model
{
    /*
     * @function default construction to initialize and load classes
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @created 02-04-2015
     * @return  void
     */
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
    /*
     * @function retrieve the users and return an array
     * if user filteration variables are present result will be filterd users
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @created 02-04-2015
     * @return array
     */
    public function get_users($filter)
    {
        if(!empty($filter))
        {
            
            $filter['user.status']  =   $filter['status'];
            unset($filter['status']);
            $this->db->select('user.id as uid, user.username, user.firstname, user.lastname, user.email, user.status, user_group.id, user_group.groupname');
            $this->db->from('user');
            $this->db->where($filter);
            $this->db->join('user_group', 'user.group=user_group.id', 'left');
            $user_list  =   $this->db->get();
            return $user_list->result_array();
        }
        $this->db->select('user.id as uid, user.username, user.firstname, user.lastname, user.email, user.status, user_group.id, user_group.groupname');
        $this->db->from('user');
        $this->db->join('user_group', 'user.group=user_group.id', 'left');
        
        
        $user_list  =   $this->db->get();
        return $user_list->result_array();
    }
    
    /*
     * @function retrieve the single user data
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @created 02-04-2015
     * @return array
     */
    public function get_single_user($usercond)
    {
        if(!empty($usercond) )
        {
            $user_list  =   $this->db->get_where('user', $usercond);
            return $user_list->row_array();
        }
        else
        {
            return FALSE;
        }
        
    }
    
    /*
     * @function retrive user groups from the database
     * @author  Muhammad Ibrar
     * @version 1.0.0
     * @created 03-04-2015
     * @return  boolean
     */
    public function get_groups()
    {
        $query  =   $this->db->get_where('user_group', array('status' => 1));
        return $query->result_array();
    }
    
    
     /**
     * @function 
     * @author      Muhammad Ibrar
     * @version     1.0.0
     * @return      void
     **/
     public function get_user_group($id)
     {
         $where =   array('id'   =>  $id, 'status'   =>  1);
         $this->db->select('groupname');
         $this->db->from('user_group');
         $this->db->where($where);
         $query =   $this->db->get();
         return $query->row_array();
     }
     
     
    /*
     * @function insert user into database
     * @author Muhammad Ibrar
     * @version 1.0.0
     * @return boolean
     */
    
    public function insert($data)
    {
       
         $status =    ( $this->db->insert( 'user', $data ) ) ? TRUE : FALSE;
        return $status;
    }
    
    /*
     * @function update user into database
     * @author Muhammad Ibrar
     * @version 1.0.0
     * @return boolean
     */
    
    public function update($data, $id)
    {
        $this->db->where('id', $id);
         $status =    ( $this->db->update( 'user', $data ) ) ? TRUE : FALSE;
        return $status;
    }
    
    /*
     * @function delete user from database
     * @author Muhammad Ibrar
     * @version 1.0.0
     * @return boolean
     */
    public function delete($id)
    {
        $status =    ( $this->db->delete( 'user', array('id' => $id)) ) ? TRUE : FALSE;
        return $status;
    }
}
