<?php

class Admin extends CI_Controller{
	
	function Admin(){
		parent::__construct();
	}
	
	
	function index(){
		$data['username'] = "";
		$data['password'] = "";
		$data['errorinfo'] = "";
		$this->load->view("Login",$data);
	}
	
	function login(){
		
	    echo "11111";
	    
// 		// get user name and password from form
// 		$username = Request::GetFormString ( "username" );
// 		$password = Request::GetFormString ( "password" );
		
// 		$this->load->model('Admin_model');
//         $admin = $this->Admin_model->select($username, $password);
		
//         // if username or password is wrong
//         if($admin==null){
//         	$data['errorinfo'] = "username or password is incorrect!";
//         	$data['username'] = $username;
//         	$this->load->view("Login",$data);
//         }else{
//         	// add the user to session
//         	$arr = array();
//         	$arr['username'] = $username;
//         	$this->session->set_userdata($arr);
//         	redirect('/comment/index');
//         }
        
	}
	
}

?>