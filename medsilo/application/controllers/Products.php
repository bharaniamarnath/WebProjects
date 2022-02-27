<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Products extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('products_model');
	}
	public function params(){
		$this->data['title'] = "Products | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "To incessantly elevating people's life by delivering quality healthcare products. Marketing the best products on demand in the pharmaceuticals industry. Providing affordable and superior healthcare products to serve people better.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Antibiotics, Anti-Allergic, Anti-Cough, Nutritional, Supplements, G.I.T, Antihelmintics, Analgesic, Anti-Inflammatory";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "products";
		$this->data['error'] = '';
		$this->data['products'] = $this->products_model->get_products();
	}
	public function index(){
		$this->params();
		$this->load->view('mdo_products.php',$this->data);
	}
	public function view($slug = NULL){
		$this->data['products_item'] = $this->products_model->get_products($slug);
		if(empty($this->data['products_item'])){
			show_404();
		}
		$pid = $this->data['products_item']['pid'];
		$this->data['products_gallery'] = $this->products_model->get_gallery($pid);
		$this->params();
		echo $this->load->view('products/mdo_view_product_item',$this->data,true);
	}
}
?>