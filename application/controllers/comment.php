<?php

class Comment extends CI_Controller{
	
	function Comment(){
		parent::__construct();
	}
	
	
	function index(){
		$this->load->view("Comment_List");
	}
	
	function query(){
		
		// get the query parameter
		$startdate = Request::GetFormString( "startdate");
		$enddate = Request::GetFormString ( "enddate" );
		$survey_id = Request::GetFormString ( "serveyId" );
		
		if ($startdate == null) {
			$starttime = @date ( "Y-m-d" );
		}
		if ($enddate == null) {
			$endtime = @date ( "Y-m-d" );
		}
		
		// get the data 
		$sql = "select  * from comment where date>= '$startdate' and date<='$enddate' and survey_id=$survey_id";
		$query = $this->db->query($sql);
		$result =$query->result_array();

		// response the json data
		response($result,200);
        
	}
	
}

?>