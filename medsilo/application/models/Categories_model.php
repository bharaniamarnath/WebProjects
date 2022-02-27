<?php
Class Categories_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function categories_list(){
		$this->db->order_by('category','ASC');
		$query = $this->db->get('categories');
		return $query->result_array();
	}
	
	public function insert_category($id,$category){
		$data = array(
				'catid'=>$id,
				'category'=>htmlentities($category)
				);
		if($this->db->insert('categories',$data) == true){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
}
?>