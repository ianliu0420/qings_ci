<?php

class Myrequest extends CI_Controller{
	
	function Myrequest(){
		parent::__construct();
	}
	
	
	function index(){
		$this->query_detail(10, 1, "2014-01-01", "2014-12-12");
	}
	
	
	function chart(){
		$data["startdate"] = "2014-10-10";
		$data["enddate"] = "2014-12-12";
		$this->load->view("Request_List_Chart.php",$data);		
	}
	
	function query_chart(){
		// get the query parameter
		$startdate = Request::GetFormString( "startdate");
		$enddate = Request::GetFormString ( "enddate" );
	
		if ($startdate == null) {
			$starttime = @date ( "Y-m-d" );
		}
		if ($enddate == null) {
			$endtime = @date ( "Y-m-d" );
		}
	
		// get the data
		$sql = "select request_date, count(*) from user_request group by request_date having request_date>='$startdate' and request_date<='$enddate' order by request_date";
		
		$query = $this->db->query($sql);
		$result =$query->result_array();
	
		// response the json data
		response($result,200);
	
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
		
		// get total number
		$sql = "select  count(*) from user_request where request_date>='$startdate' and request_date<='$enddate'";
		$query = $this->db->query($sql);
		$row =$query->result_array();
		$totalitem = $row[0]["count(*)"];
		
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
		$sql = "select * from user_request where request_date>='$startdate' and request_date<='$enddate' limit $startNum, $pagesize";
		$query = $this->db->query($sql);
		$items =$query->result_array();
		
		$data['currentpage'] = $currentpage;
		$data['totalpage'] =$totalpage;
		$data['duan'] = $duan;
		$data['items'] = $items;
		$data['startdate'] = $startdate;
		$data['enddate'] = $enddate;
		
		$this->load->view("Request_List.php",$data);
		
	}
	
}

?>