<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *@author Arkan Denys  <arkan.denys@gmail.com>
 * @copyright 2014 
 * @license http://codeigniter/license.txt GPL2
 *
 *@package controller
 *
 */ 
class Posts extends CI_Controller {


	/**
	 *initialize connect to database
	 */	
	function __construct(){        
		parent::__construct();		
		$this->load->model('post'); //@see models/post.php
	}
	
	/*
	 *function for default when page is loaded
	 *
	 *@param int $start get all posts from BD
	 */
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
	
	
	/**
	 *try if user is loged in or NOT
	 *
	 */
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
	
	
	/**
	 *query for one post, for diplay on single page
	 *
	 *display a comments witch ar belong for this post, and show a comment form for add new comment
	 *
	 *@param int $postID ID of post
	 *
	 */
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
	
	/**
	 *insert new post in DB
	 *
	 *
	 */
	function new_post(){
		
		//try permissions
		if (!$this->correct_permissions('author')){
				redirect(base_url().'users/login');
		}
		if($_POST){
			$data = array(
			'title' =>$_POST['title'],
			'post' => $_POST['post'],
			'active' => 1
			);
		//@see modules/Post::insert_post()		
		$this->post->insert_post($data);
		redirect(base_url().'posts/');
		}else{
			$this->load->view('header'); //@see views/header.php
			$this->load->view('new_post');//@see views/new_post.php
			$this->load->view('footer'); //@see views/footer.php
		}
	}
	
	
	/**
	 *update certain post in DB by him ID
	 *
	 *@param int  $postID
	 *@return bool 	 
	 */
	
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
	
	/**
	 *delete post from DB
	 *
	 *@param int $postID
	 */
	
	function deletepost ($postID){
		
		if (!$this->correct_permissions('author')){
				redirect(base_url().'users/login');
		}
		$this->post->delete_post($postID);
		redirect(base_url().'posts'); 
	}
	
}
