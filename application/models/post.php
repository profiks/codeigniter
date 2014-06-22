<?php

/**
 *
 * @author Arkan Denys  <arkan.denys@gmail.com>
 * @copyright 2014 
 * @license http://codeigniter/license.txt GPL2
 * @package modles
 * 
 */
class Post extends CI_Model{
    
    
    
    /**
     * Get a total count of posts from database
     * 
     * @return int
     */
    function get_posts_count(){
        $this->db->select('postID')->from('posts')->where('active',1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /**
     * 
     * @param int $start initial post id
     * @param int $num the last post id
     * @return array posts in assoc array
     */
    function get_posts($start=0,$num=20){
        
        $this->db->select()->from('posts')->where('active',1)->order_by('date_added','desc')->limit($num,$start);
        $query = $this->db->get();
        return $query->result_array();    
    }
    
    /**
     * 
     * @param int $postID
     * @return array
     */
    
    function single($postID){
        $this->db->select('*')->from('posts')->where('postID',$postID);
        $query = $this->db->get();
        
        return $query->first_row('array');    
    }

    /**
     * New post
     * 
     * @param int $data
     * @return bool
     */
    function insert_post($data){
        $this->db->insert('posts',$data);
        return $this->db->insert_id();
    }
    
    /**
     *update post in DB
     *
     *@param int $postID
     *@param array() $data
     */
    function update_post($postID,$data){
        $this->db->where('postID',$postID);
        $this->db->update('posts',$data);
        
    }
    
    /**
     *Delete post
     *
     *@param int $postID  ID of post witch must be deleted
     */
    function delete_post($postID) {
        $this->db->where('postID', $postID);
        $this->db->delete('posts'); 
    }

}//end class

