<?php
class Comment_model extends CI_Model{
	
	var $username = '';
	var $password = '';
	
	function __construct(){
		parent::__construct();
	}
	
	
	public function select($startdate,$enddate,$survey_id){
		
		// query condition 
		$whereArray = array(); 
		$whereArray['survey_id'] = $survey_id;
		
		// query from table "admin"
		$res = $this -> db ->select()
		->from ('admin')
		->where ($whereArray)
		->get();
		
		return $res->result_array();
	}
	
	
	
// 	function insert($array){
// 		$this->db->insert('blog',$array);
// 	}
	
// 	function update($id, $array){
// 		$this -> db -> where('id', $id); 
// 		$this -> db -> update('blog', $array);
// 	}
	
// 	function delete($id){
// // 		$this -> db -> where('id', $id);
// 		$this -> db -> delete('blog', array('id'=>$id));
// 	}
	
// 	public function select(){
// 		$res = $this -> db ->select('id, content')
// 		->from ('blog')
// 		->where ('id >=',3)
// 		// equals limit 2, 3
// 		->limit(3,2)
// 		->order_by('id desc')
// 		->get();
		
// 		echo $this->db->last_query();
// 		return $res->result();
// // 		return $res;
// 	}
	
// 	public function getAll(){
// 		$res = $this->db->get('blog');
// 		return $res->result();
		
// 	}
	
}

?>