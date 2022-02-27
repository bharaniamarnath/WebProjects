<?php
Class Search_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function get_search($slug){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->like('pname',$slug);
		$this->db->or_like('pcategory',$slug);
		$this->db->or_like('pcombination',$slug);
		$this->db->or_like('pindication',$slug);
		$this->db->or_like('pdescription',$slug);
		$this->db->order_by('pname','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>