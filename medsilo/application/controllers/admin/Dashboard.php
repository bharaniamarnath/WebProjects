<?php
class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function params(){
		$this->data['title'] = "Admin | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "To incessantly elevating people's life by delivering quality healthcare products. Marketing the best products on demand in the pharmaceuticals industry. Providing affordable and superior healthcare products to serve people better.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Antibiotics, Anti-Allergic, Anti-Cough, Nutritional, Supplements, G.I.T, Antihelmintics, Analgesic, Anti-Inflammatory";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "dashboard";
		$this->data['error'] = '';
	}
	public function index(){
		if($this->session->userdata('user') == 'medsilo' && $this->session->userdata('logged')){
			$this->params();
			$this->load->view('admin/mdoa_dashboard',$this->data);
		}
		else{
			redirect('admin/admin','refresh');
		}
	}
}
?>