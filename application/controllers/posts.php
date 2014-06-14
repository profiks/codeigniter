<?php
class Posts extends CI_Controller {

	function __construct(){        
		parent::__construct();
		$this->load->model('post');
	}
	
	
	function index($start=0){
		
		$data['post']=$this->post->get_posts($start,4);
		$this->load->library('pagination');
		$config['base_url']=base_url()."posts/index/";
		$config['total_rows']=$this->post->get_posts_count();
		$config['per_page'] =4;
		$this->pagination->initialize($config);
		$data['pages']=$this->pagination->create_links();
		$this->load->view('header');
		$this->load->view('post',$data);
		$this->load->view('footer');
	}
	
	
	
	function correct_permissions ($required){
		$user_type = $this->session->userdata('user_type');
		if ($required == 'user'){
			if($user_type){
				return true;
			}
		}elseif ($required == 'author'){
			if($user_type=='admin' || $user_type=='author'){
				return true;
			}
		}elseif($required == 'admin'){
			if($user_type=='admin'){
				return true;
			}
		}
		
	}
	
	function single($postID){
		
		$this->load->model('comment');
		$data['comment']=$this->comment->get_comments($postID);
		$data['post']=$this->post->single($postID);
		$this->load->helper('captcha');
		
		$vals = array(
			 'img_path'=>'./captcha/',
			 'img_url'=>base_url().'captcha/',
			 'img_width'=>150,
			 'img_height'=>50			      
			);
		$cap = create_captcha($vals);
		$this->session->set_userdata('captcha',$cap['word']);
		$data['captcha'] = $cap['image'];
		
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('single',$data);
		$this->load->view('footer');
	}
	
	function new_post(){
		
		if (!$this->correct_permissions('author')){
				redirect(base_url().'users/login');
		}
		if($_POST){
			$data = array(
			'title' =>$_POST['title'],
			'post' => $_POST['post'],
			'active' => 1
			);
		$this->post->insert_post($data);
		redirect(base_url().'posts/');
		}else{
			$this->load->view('header');
			$this->load->view('new_post');
			$this->load->view('footer');
		}
	}
	
	
	
	function editpost($postID){
		
		if (!$this->correct_permissions('author')){
				redirect(base_url().'users/login');
		}
		$data['success'] = 0;
		if($_POST){
			$data = array(
			'title' =>$_POST['title'],
			'post' =>$_POST['post'],
			'active' => 1
			);
		$this->post->update_post($postID,$data);
		$data['success'] = 1;
		}
		$data['post']=$this->post->single($postID);
		$this->load->view('header');
		$this->load->view('editpost',$data);
		$this->load->view('footer');
	}
	
	function deletepost ($postID){
		
		if (!$this->correct_permissions('author')){
				redirect(base_url().'users/login');
		}
		$this->post->delete_post($postID);
		redirect(base_url().'posts'); 
	}
	
}
