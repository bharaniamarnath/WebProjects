<?php
class Category extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('categories_model');
	}
	public function params(){
		$this->data['title'] = "Admin | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "To incessantly elevating people's life by delivering quality healthcare products. Marketing the best products on demand in the pharmaceuticals industry. Providing affordable and superior healthcare products to serve people better.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Antibiotics, Anti-Allergic, Anti-Cough, Nutritional, Supplements, G.I.T, Antihelmintics, Analgesic, Anti-Inflammatory";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "categories";
		$this->data['error'] = '';
	}
	
	public function view(){
		if($this->session->userdata('user') == 'medsilo' && $this->session->userdata('logged')){
			$this->params();
			$this->data['categories_list'] = $this->categories_model->categories_list();
			$this->load->view('admin/mdoa_categories',$this->data);
		}
		else{
			redirect('admin/admin','refresh');
		}
	}
	
	public function add(){
		$form = array();
		$form['category_name'] = $this->input->post("ncname");
		$form['id'] = sprintf("%06d", mt_rand(100000,999999));
		if(self::insert($form['id'],$form['category_name']) == TRUE){
			$success = '<h1 class="display-4 text-strike"><i class="fa fa-image"></i></h1><h1 class="text-strobe">Category added.</h1><p class="lead">Category '.$form['category_name'].' has been added to the database.</p>';
			echo $success;
		}
		else{
			$failed = '<h1 class="display-4 text-strike"><i class="fa fa-image"></i></h1><h1 class="text-strobe">Error occurred!</h1><p class="lead">Unable to add the category to the database.</p>';
			echo $failed;
		}
	}
	
	private function protect($str){
		return mysql_real_escape_string($str);
	}
	
	private function insert($id,$category){
		$status = $this->categories_model->insert_category($id,$category);
		return $status;
	}
}
?>