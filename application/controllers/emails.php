<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/posts.php");

class Emails extends Posts {
    
    
        
    function email(){
        
        if (!$this->correct_permissions('author')){
				redirect(base_url().'users/login');
	}
        
        $this->load->model('user');
        $emails = $this->user->get_emails();
        $this->load->library('email');
        $config['mailtype']='html';
        $this->email->initialize($config);
        
        foreach($emails as $row){
            if($row['email']){
                $this->email->from('denys.ark@gmail.com','Arkan Denys');
                $this->email->to($row['email']);
                $this->email->subject('Test Newsletter');
                $this->email->message('Tour email message goes <bold> here </bold>');
                $this->email->send();
                $this->email->clear();
            }
            
        }//end foreach
    
    
    }//end function email()
    
    
    
    
    
    
}//end class Emails