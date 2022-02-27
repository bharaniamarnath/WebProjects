<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('search_model');
	}
	public function params(){
		$this->data['title'] = "Search | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "To incessantly elevating people's life by delivering quality healthcare products. Marketing the best products on demand in the pharmaceuticals industry. Providing affordable and superior healthcare products to serve people better.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Antibiotics, Anti-Allergic, Anti-Cough, Nutritional, Supplements, G.I.T, Antihelmintics, Analgesic, Anti-Inflammatory";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "products";
		$this->data['error'] = '';
	}
	public function index(){
		$this->data['search'] = $this->input->post("searchkey");
		$this->search($this->data['search']);
		$this->params();
		$this->load->view('mdo_search.php',$this->data);
	}
	public function search($search){
		$this->data['products'] = $this->search_model->get_search($search);
	}
}
?>