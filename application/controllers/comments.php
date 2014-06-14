<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends CI_Controller {
    
    
         
    
    function add_comment($postID){
      
        
        if(!$_POST){
            redirect(base_url().'posts/single/'.$postID);
        }
        
        // try permitions
        $user_type= $this->session->userdata('user_type');
        if(!$user_type){
            redirect(base_url().'users/login');
        }
        
        //try captcha
        
        if(strtolower($this->session->userdata('captcha')) != strtolower($_POST['captcha'])){
            echo "captcha error";            
        }
        
        else {
            $this->load->model('comment');
        $data = array (
                'postID'=>$postID,
                'userID'=>$this->session->userdata('userID'),
                'comment'=>$_POST['comment']
                );
        $this->comment->add_comment($data);
            redirect(base_url().'posts/single/'.$postID);
        }
        
        
        
    }
    
    
    
    
}// end class Comments