<?php

class Pronewcode extends CI_Controller{
	
	function Pronewcode(){
		parent::__construct();
	}
	
	
	function index(){
		$data['startdate'] = "";
		$data['enddate'] = "";
		$data['items'] = array();
		$this->load->view("Pro_NewCode_List.php",$data);
	}
	
	
	
	function query(){
		$pagesize = Request::GetQueryString( "pagesize");
		$pageno = Request::GetQueryString( "pageno");
		$startdate = Request::GetQueryString( "startdate");
		$enddate = Request::GetQueryString( "enddate");
		
		$this->query_detail($pagesize, $pageno, $startdate, $enddate);
	}
	
	
	
	function query_detail($pagesize, $pageno, $startdate, $enddate){
		
		$currentpage = $pageno;
		
		if ($currentpage == null) {
			$currentpage = 1;
		}
		
		if ($pagesize == null) {
			$pagesize = 10;
		}
		
		
		if ($startdate == null) {
			$startdate = @date ( "Y-m-d" );
		}
		if ($enddate == null) {
			$enddate = @date ( "Y-m-d" );
		}
		
		$startNum = ($currentpage - 1) * $pagesize;
		$sql = $sql = " select * from newpromotion where np_startdate>='$startdate' and  np_enddate<='$enddate'";
		
		$query = $this->db->query($sql);
		$items =$query->result_array();
		
		$data['currentpage'] = $currentpage;
		$data['items'] = $items;
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
		
		$this->load->view("Pro_NewCode_List.php",$data);
		
	}
	
	
	function dispadd(){
		$this->load->view("Pro_NewCode_Add.php");
	}
	
	function add(){
		$params = $this->get_params();
		$params["np_createDate"] = @date('Y-m-d');
		$params["np_status"] = 1;
		if(isset($params["np_id"]) && $params["np_id"]!=null && $params["np_id"]!=0&&$params["np_id"]!=""){
			
			$this->load->model('Pronewcode_model');
			$result = $this->Pronewcode_model->update($params);
			// response the json data
			response($result,200);
			
		}else{
			$this->load->model('Pronewcode_model');
			$result = $this->Pronewcode_model->add($params);
			// response the json data
			response($result,200);
		}
		
		
		
// 		$np_id = Request::GetQueryString('np_id');
// 		$np_code = Request::GetQueryString('np_code');
// 		$np_startdate = Request::GetQueryString('np_startdate');
// 		$np_enddate = Request::GetQueryString('np_enddate');
// 		$np_type = Request::GetQueryString('np_type');
// 		$np_percent = Request::GetQueryString('np_percent');
// 		$np_amount = Request::GetQueryString('np_amount');
// 		$np_notes = Request::GetQueryString('np_notes');
// 		$np_lower = Request::GetQueryString('np_lower');
// 		$np_upper = Request::GetQueryString('np_upper');
		
// 	     if($np_lower==null||$np_lower==""){
// 			$np_lower='null';
// 		}
// 		if($np_upper==null||$np_upper==null){
// 			$np_upper='null';
// 		}
// 		$np_status = 1;
// 		$np_createDate = @date('Y-m-d');
		
// 		$Connection = new Tool_Connection ();
// 		$conn = $Connection->connectToDatabase ();
// 		$Connection->selectDatabase ();
		
		
// 		//******************check whether the procode is repeat*********************
		
// 		if($np_id!=null && $np_id!=0&&$np_id!=""){
// 			if($np_type==1){
// 				$sql = "update newpromotion set np_code='$np_code',np_startdate='$np_startdate',
// 				np_enddate='$np_enddate',np_type=$np_type,np_percent=$np_percent,
// 				np_notes='$np_notes', np_lower='$np_lower',np_upper='$np_upper', where np_id=$np_id";
		
// 			}else{
// 				$sql = "update newpromotion set np_code='$np_code',np_startdate='$np_startdate',
// 				np_enddate='$np_enddate',np_type=$np_type,np_amount=$np_amount,
// 				np_notes='$np_notes', np_lower='$np_lower',np_upper='$np_upper' where np_id=$np_id";
// 			}
// 		}else{
		
// 			//******************check whether the procode is repeat*********************
// 			$sql = "select * from newpromotion where np_code=".$np_code;
// 			$result = $Connection->executeQuery ( $sql, $conn );
// 			$row = null;
// 			if ($result != null && mysql_num_rows ( $result ) > 0) {
// 				$row = array (
// 						'errono' => -1
// 				);
// 				$jsonResult = json_encode ( $row );
// 				echo $jsonResult;
// 				$Connection->closeConnection();
// 				die;
// 			}
		
		
// 			if($np_type==1){
// 				$sql = "insert into newpromotion (np_id,np_code,np_startdate,np_enddate,np_type,np_percent,np_notes,np_lower,np_upper,np_status,np_createDate)
// 				values (null,'$np_code','$np_startdate','$np_enddate',$np_type,$np_percent,'$np_notes',$np_lower,$np_upper,'$np_status','$np_createDate')";
// 			}else{
// 				$sql = "insert into newpromotion (np_id,np_code,np_startdate,np_enddate,np_type,np_amount,np_notes,np_lower,np_upper,np_status,np_createDate)
// 				values (null,'$np_code','$np_startdate','$np_enddate',$np_type,$np_amount,'$np_notes',$np_lower,$np_upper,'$np_status','$np_createDate')";
// 			}
// 		}
		
		
// 		$result = $Connection->executeAdd ( $sql, $conn );
		
// 		if ($result != null) {
// 			$row = array (
// 					'errono' => 0
// 			);
// 			$jsonResult = json_encode ( $row );
// 			echo $jsonResult;
// 		} else {
// 			$row = array (
// 					'errono' => 1
// 			);
// 			$jsonResult = json_encode ( $row );
// 			echo $jsonResult;
// 		}
		
// 		$Connection->closeConnection();
		
	}
	
	
	function getById(){
		$np_id = Request::GetQueryString('np_id');
		$this->load->model('Pronewcode_model');
		$result = $this->Pronewcode_model->selectById($np_id);
		if(count($result)==1){
			$data['row'] = $result[0];
			$this->load->view("Pro_NewCode_Edit.php",$data);
		}else{
			echo "error";
		}
	}
	
	
	
	
	private function get_params() {
		$info = array();
		$np_id = Request::GetFormString('np_id');
		$np_code = Request::GetFormString('np_code');
		$np_startdate = Request::GetFormString('np_startdate');
		$np_enddate = Request::GetFormString('np_enddate');
		$np_type = Request::GetFormString('np_type');
		$np_percent = Request::GetFormString('np_percent');
		$np_amount = Request::GetFormString('np_amount');
		$np_notes = Request::GetFormString('np_notes');
		$np_lower = Request::GetFormString('np_lower');
		$np_upper = Request::GetFormString('np_upper');
		
		if(isset($np_id)) {
			$info ['np_id'] = $np_id;
		}
		if(isset($np_code)) {
			$info ['np_code'] = $np_code;
		}
		if(isset($np_startdate)) {
			$info ['np_startdate'] = $np_startdate;
		}
		if(isset($np_enddate)) {
			$info ['np_enddate'] = $np_enddate;
		}
		if(isset($np_type)) {
			$info ['np_type'] = $np_type;
		}
		if(isset($np_percent)) {
			$info ['np_percent'] = $np_percent;
		}
		if(isset($np_amount)) {
			$info ['np_amount'] = $np_amount;
		}
		if(isset($np_notes)) {
			$info ['np_notes'] = $np_notes;
		}
		if(isset($np_lower)) {
			$info ['np_lower'] = $np_lower;
		}
		if(isset($np_upper)) {
			$info ['np_upper'] = $np_upper;
		}
	
		return $info;
	
	}
	
	
	
}

?>