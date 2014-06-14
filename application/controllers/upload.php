<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/posts.php");
class Upload extends Posts {
    
    function __construct(){        
		parent::__construct();
		$this->load->helper('form');
    }
    
    function index(){
        $this->load->view('header');
        $this->load->view('upload_form',array('error'=>''));
        $this->load->view('footer');
        
    }
    
    
    function do_upload(){
	
	if (!$this->correct_permissions('author')){
		redirect(base_url().'users/login');
	}
	
        $config['upload_path']    = './uploads';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['max_size']       = '100';
        $config['max_width']      = '1024';
        $config['max_height']     = '768';
        
        $this->load->library('upload',$config);
        
        if(!$this->upload->do_upload()){
            $error = array ('error'=>$this->upload->display_errors());
            $this->load->view('header');
            $this->load->view('upload_form',$error);
            $this->load->view('footer');
        }else{
	    $data = array('upload_data'=>$this->upload->data());
	    //RESIZE THE IMAGE
	    $this->resize($data['upload_data']['full_path'],
			  $data['upload_data']['file_name']);
	    
            $this->load->view('header');
            $this->load->view('upload_success',$data);
            $this->load->view('footer');
        }
    }// end do_upload    
	
    function resize($path,$file){
	    $config['image_library']	= 'gd2';
	    $config['source_image']	= $path;
	    $config['create_thumb']	= TRUE;
	    $config['maintain_ratio']	= TRUE;
	    $config['width']		= '150';
	    $config['height']		= '75';
	    $config['new_image']	= './uploads/'.$file;
	    
	    $this->load->library('image_lib',$config);
	    $this->image_lib->resize();
    }// end resize
        
        
    
    
}//end class Upload