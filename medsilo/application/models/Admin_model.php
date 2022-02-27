<?php
Class Admin_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function checklogin($auth){
		$usrname = $auth['uname'];
		$psswd = md5($auth['pswd']);
		$query = $this->db->get_where('admins',array('username'=>$usrname,'password'=>$psswd));
		if($query->num_rows() > 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function checkpassword($pswd){
		$usrname = 'medsilo';
		$psswd = md5($pswd);
		$query = $this->db->get_where('admins',array('username'=>$usrname));
		$res = $query->row_array();
		if($res['password'] === $psswd){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function lastlogin(){
		$usrname = 'medsilo';
		$this->db->select('lastlog');
		$query = $this->db->get_where('admins',array('username'=>$usrname));
		return $query->row_array();
	}

	public function updatepassword($adata){
		$npswd = $adata['npswd'];
		$enpswd = md5($npswd);
		$usrname = 'medsilo';
		$data = array(
				'password'=>$enpswd
				);
		$this->db->where('username', $usrname);
		if($this->db->update('admins',$data) == true){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>