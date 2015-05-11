<?php

class Redirector extends CI_Controller{
	
	function Redirector(){
		parent::__construct();
	}
	
	
	function index(){
		
	}
	
	
	function redirect(){
		$redadd = Request::GetQueryString( "redadd");
		redirect(redadd);
	}
	
	
}

?>