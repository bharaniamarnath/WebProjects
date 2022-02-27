<?php
Class Enquiry_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function enquiries_list(){
		$this->db->order_by('added','DESC');
		$query = $this->db->get('enquiries');
		return $query->result_array();
	}
	
	public function insert_enquiry($id,$name,$email,$phone,$message){
		$data = array(
				'eid'=>$id,
				'ename'=>$name,
				'email'=>$email,
				'ephone'=>$phone,
				'enquiry'=>$message
				);
		if($this->db->insert('enquiries',$data) == true){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
}
?>