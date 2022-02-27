<?php
class Statistics extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('products_model');
		$this->load->model('categories_model');
	}
	public function params(){
		$this->data['title'] = "Admin | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "To incessantly elevating people's life by delivering quality healthcare products. Marketing the best products on demand in the pharmaceuticals industry. Providing affordable and superior healthcare products to serve people better.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Antibiotics, Anti-Allergic, Anti-Cough, Nutritional, Supplements, G.I.T, Antihelmintics, Analgesic, Anti-Inflammatory";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "statistics";
		$this->data['error'] = '';
	}
	public function index(){
		if($this->session->userdata('user') == 'medsilo' && $this->session->userdata('logged')){
			$this->params();
			$this->data['products_data'] = $this->products_model->product_list();
			$this->data['categories_data'] = $this->categories_model->categories_list();
			$this->load->view('admin/mdoa_statistics',$this->data);
		}
		else{
			redirect('admin/admin','refresh');
		}
	}
}
?>