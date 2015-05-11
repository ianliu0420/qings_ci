<?php
class Pronewcode_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
// 	public function select($username,$password){
		
// 		// query condition 
// 		$whereArray = array(); 
// 		$whereArray['admin_name'] = $username;
// 		$whereArray['admin_password'] = $password;
		
// 		// query from table "admin"
// 		$res = $this -> db ->select()
// 		->from ('admin')
// 		->where ($whereArray)
// 		->get();
		
// 		return $res->result_array();
// 	}
	
	
	function selectById($np_id){
		 $res = $this -> db ->select()->from ('newpromotion')->where ('np_id',$np_id)->get();
	     return $res->result_array();
	}
	
	
	function add($array){
		$result = $this->db->insert('newpromotion',$array);
		return $result;
	}
	
	
	function update($array){
		$this -> db -> where('np_id', $array['np_id']); 
        unset($array['np_id']);
		$result = $this -> db -> update('newpromotion', $array);
		return $result;
	}
	
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