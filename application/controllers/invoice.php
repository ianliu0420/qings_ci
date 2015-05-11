<?php

class Invoice extends CI_Controller{
	
	function Invoice(){
		parent::__construct();
	}
	
	
	function index(){
		$data['pagesize'] = "";
		$data ['pageno'] = "";
		$data ["starttime"] = "";
		$data ["endtime"] = "";
		$data ["username"] = "";
		$data ["invoiceno"] = "";
		$data["procode"] = "";
		$data["totalPay"] = "";
		$data["totalitem"] = "";
		
		$data['currentpage'] = 0;
		$data['totalpage'] =0;
		$data['duan'] = 0;
		$data['items'] = array();
		
		$this->load->view("Invoice_List.php",$data);
	}
	
	function query(){
		$params = $this->get_params();
		$this->query_detail($params);
	}
	function graph(){
		$data["starttime"] = "";
		$data["endtime"] = "";
		$this->load->view("Invoice_Graph.php",$data);
	}
	
	
	function query_graph(){
		
		$type = Request::GetFormString('type');
		$starttime = Request::GetFormString('starttime');
		$endtime = Request::GetFormString('endtime');
		
		if ($starttime == null) {
			$starttime = @date ( "Y-m-d" );
		}
		if ($endtime == null) {
			$endtime = @date ( "Y-m-d" );
		}
		
		$starttime = $starttime." 00:00:01";
		$endtime = $endtime." 23:59:59";
		
		if(isset($type) && $type!="-1"){
			$sql = "select  * from invoice where paydate>= '$starttime' and paydate<='$endtime' and paymethod=$type";
		}else{
			$sql = "select  * from invoice where paydate>= '$starttime' and paydate<='$endtime'";
		}
		$query = $this->db->query($sql);
		$row =$query->result_array();
		response($row);
	}
	
	
	function query_detail($params){
		
		$pagesize = $params ['pagesize'];
		$currentpage = $params ['pageno'];

		$sql = "select count(*),sum(i.realpay) from invoice i, payment p where i.event_id=p.event_id ";
		if (!isset($params ["starttime"])) {
			$starttime = "2014-11-01";
		}else{
			$starttime = $params ["starttime"];
		}
		$startdate = $starttime;
		$starttime = $starttime." 00:00:01";
		
		if (!isset($params ["endtime"])) {
			$endtime = @date ( "Y-m-d" );
		}else{
			$endtime = $params ["endtime"];
		}
		
		$enddate = $endtime;
		$endtime = $endtime." 23:59:59";
		
		$sql = $sql . " and i.paydate>='$starttime' and i.paydate<='$endtime' ";
		if (isset($params ["username"]) && $params ["username"] != "") {
			$username = $params ["username"];
			$sql = $sql . " and (p.firstname='$username' or p.lastname='$username')";
		}
		if (isset($params ["invoiceno"]) && $params ["invoiceno"] != "") {
			$invoiceno = $params ["invoiceno"];
			$sql = $sql . " and i.invoiceno='$invoiceno' ";
		}
		if (isset($params ["procode"]) && $params ["procode"] != "") {
			$procode = $params ["procode"];
			$sql = $sql . " and i.procode='$procode' ";
		}
		
		$query = $this->db->query($sql);
		$row =$query->result_array();
		$totalitem = $row[0]["count(*)"];
		$totalPay = $row[0]["sum(i.realpay)"];
		
		
		// get the total page
		$temp = $totalitem % $pagesize;
		if ($temp == 0) {
			$totalpage = floor ( $totalitem / $pagesize );
		} else {
			$totalpage = floor ( $totalitem / $pagesize ) + 1;
		}
		
		if ($currentpage % 4 == 0) {
			$duan = $currentpage / 4 - 1;
		} else {
			$duan = floor ( $currentpage / 4 );
		}
		
		$startNum = ($currentpage - 1) * $pagesize;
		
		$sql = "select  * from invoice i, payment p where i.event_id=p.event_id  ";
		
		$sql = $sql . " and i.paydate>='$starttime' and i.paydate<='$endtime' ";
		
		if (isset($params ["username"]) && $params ["username"] != "") {
			$username = $params ["username"];
			$sql = $sql . " and (firstname='$username' or lastname='$username')";
		}
		if (isset($params ["invoiceno"]) && $params ["invoiceno"] != "") {
			$invoiceno = $params ["invoiceno"];
			$sql = $sql . " and invoiceno='$invoiceno' ";
		}
		if (isset($params ["procode"]) && $params ["procode"] != "") {
			$procode = $params ["procode"];
			$sql = $sql . " and i.procode='$procode' ";
		}
		$sql = $sql . " order by i.id desc limit $startNum, $pagesize ";
		
		$query = $this->db->query($sql);
		$items =$query->result_array();

		$data['currentpage'] = $currentpage;
		$data['totalpage'] =$totalpage;
		$data['duan'] = $duan;
		$data['items'] = $items;
		$data['starttime'] = $startdate;
		$data['endtime'] = $enddate;
		$data['totalPay'] = $totalPay;
		$data['totalitem'] = $totalitem;
		$data ["username"] = "";
		$data ["invoiceno"] = "";
		$data["procode"] = "";
				
		$this->load->view("Invoice_List.php",$data);
		
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
	}
	
	
	private function get_params() {
		$info = array();
		
		$pagesize = Request::GetQueryString('pagesize');
		$pageno = Request::GetQueryString('pageno');
		$starttime = Request::GetQueryString('starttime');
		$endtime = Request::GetQueryString('endtime');
		$username = Request::GetQueryString('username');
		$invoiceno = Request::GetQueryString('invoiceno');
		$procode = Request::GetQueryString('procode');
		
		if(isset($pagesize)) {
			$info ['pagesize'] = $pagesize;
		}
		if(isset($pageno)) {
			$info ['pageno'] = $pageno;
		}
		if(isset($starttime)) {
			$info ['starttime'] = $starttime;
		}
		if(isset($endtime)) {
			$info ['endtime'] = $endtime;
		}
		if(isset($username)) {
			$info ['username'] = $username;
		}
		if(isset($invoiceno)) {
			$info ['invoiceno'] = $invoiceno;
		}
		if(isset($procode)) {
			$info ['procode'] = $procode;
		}
	
		return $info;
	
	}
	
	
	
}

?>