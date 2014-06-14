<?php
class Users extends CI_Controller {
    
    function login(){
        $data['error']=0;
        if($_POST){
            $this->load->model('user');
            $username = $this->input->post('username',true);
            $password = $this->input->post('password',true);
            $type = $this->input->post('user_type',true);
            $user     = $this->user->login($username,$password,$type);
                if(!$user){
                    $data['error']=1;
                }else {
                    $this->session->set_userdata('userID',   $user['userID']);
                    $this->session->set_userdata('username', $user['username']);
                    $this->session->set_userdata('user_type',$user['user_type']);
                    redirect(base_url().'posts');
                    
            }
            
        }
        $this->load->view('header');
            $this->load->view('login',$data);
            $this->load->view('footer'); 
               
    }//end login()
    
    
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'posts');
        
    }//end logout()
    
    
    
    function register(){
        
        $data['errors'] = "";
        if($_POST){
            
            $config=array(
            //username input
            array(
                'field'=>'username',
                'rules'=>'trim|required|min_length[3]|is_unique[users.username]'
                ),
            //password input
            array(
                'field'=>'password',
                'rules'=>'trim|required|min_length[5]|max_length[15]'
                ),
            // confirm password input
            array(
                'field'=>'password2',
                'rules'=>'trim|required|max_length[50]|matches[password]'
                ),
            //select user_type [admin,user,author]
            array(
                'field'=>'user_type',
                'rules'=>'required'
                ),
            //email validation
            array(
                'field'=>'email',
                'rules'=>'trim|required|is_unique[users.email]|valid_email'
                )
            );
            $this->load->library('form_validation');
            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){
                    $data['errors'] = validation_errors();
            }else{
                $data=array(
                'username'  => $_POST['username'],
                'password'  => sha1($_POST['password']), //sha1
                'email' => $_POST['email'],
                'user_type' => $_POST['user_type']
                );
            $this->load->model('user');
            $userid=$this->user->create_user($data);
            $this->session->set_userdata('userID',$userid);
            $this->session->set_userdata('username', $_POST['username']);
            $this->session->set_userdata('user_type',$_POST['user_type']);
            redirect(base_url().'users/login');
            }
            
            
        }
        $this->load->helper('form');
        $this->load->view('header');
        $this->load->view('register',$data);
        $this->load->view('footer');
        
    }//end registr
    
    
    
}