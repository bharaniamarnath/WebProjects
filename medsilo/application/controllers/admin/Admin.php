<?php
class Admin extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}
	public function params(){
		$this->data['title'] = "Admin | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "To incessantly elevating people's life by delivering quality healthcare products. Marketing the best products on demand in the pharmaceuticals industry. Providing affordable and superior healthcare products to serve people better.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Antibiotics, Anti-Allergic, Anti-Cough, Nutritional, Supplements, G.I.T, Antihelmintics, Analgesic, Anti-Inflammatory";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "admin";
		$this->data['error'] = "";
	}
	public function index(){
		$this->params();
		$this->load->view('admin/mdoa_home',$this->data);
	}
	public function login(){
		$rules = array(
					"adminuid"=>array(
						"field"=>"adminuid",
						"label"=>"Username",
						"rules"=>"required"
					),
					"adminpwd"=>array(
						"field"=>"adminpwd",
						"label"=>"Password",
						"rules"=>"required"
					)
				);
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == FALSE){
			$this->params();
			$this->data['error'] = "Invalid login";
			$this->load->view('admin/mdoa_home',$this->data);
		}
		else{
			$udata = array(
				'uname' => $this->input->post("adminuid"),
				'pswd' => $this->input->post("adminpwd")
			);
			$res = $this->admin_model->checklogin($udata);
			if($res == true){
				$sessiondata = array("user"=>$udata['uname'],"logged"=>TRUE);
				$this->session->set_userdata($sessiondata);
				$this->data['session'] = $sessiondata;
				redirect('admin/dashboard','refresh');
			}
			else{
				$this->params();
				$this->data['error'] = "Incorrect username and password";
				$this->load->view('admin/mdoa_home',$this->data);
			}
		}
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('admin/admin','refresh');
	}
}
?>