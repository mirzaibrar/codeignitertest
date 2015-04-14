<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if( !defined('BASEPATH') ) exit('Restricted access');

class News_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news($slug = FALSE)
    {
       if( $slug    ==   FALSE)
       { 
        $query   =   $this->db->get('news');
        return $query->result_array();
       } 
       $query   =  $this->db->get_where( 'news', array('slug'   =>   $slug ) );
       return $query->row_array();
    }
    
    public function insert_news( $data )
    {
        $status =    ( $this->db->insert( 'news', $data ) ) ? TRUE : FALSE;
        return $status;
    }        
    
    public function delete_news( $id )
    {
        $status = ( $this->db->delete( 'news' , array('id' => $id) ) ) ?  TRUE : FALSE;
        return $status;
                
    }
    
    public function get_news_item($id = '')
    {
        $query  =   $this->db->get_where( 'news', array( 'id' =>  $id ) );
        return $query->row_array();
    }
    
    public function update_news_item( $data, $id )
    {
        $this->db->where( 'id', $id );
        if( $this->db->update( 'news', $data ) )
            return TRUE;
        else
            return FALSE;
    }        
}
