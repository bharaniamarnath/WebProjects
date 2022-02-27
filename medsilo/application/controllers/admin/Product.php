<?php
class Product extends CI_Controller{
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
		$this->data['current'] = "newproduct";
		$this->data['error'] = '';
	}
	
	public function listproduct(){
		if($this->session->userdata('user') == 'medsilo' && $this->session->userdata('logged')){
			$this->params();
			$this->data['list'] = $this->products_model->product_list();
			$this->load->view('admin/mdoa_product_list',$this->data);
		}
		else{
			redirect('admin/admin','refresh');
		}
	}
	
	public function edit($pid = NULL){
		if($this->session->userdata('user') == 'medsilo' && $this->session->userdata('logged')){
			$this->params();
			$this->data['product_data'] = $this->products_model->product_data($pid);
			$this->data['categories'] = $this->categories_model->categories_list();
			$this->load->view('admin/mdoa_product_edit',$this->data);
		}
		else{
			redirect('admin/admin','refresh');
		}
	}
	
	public function newproduct(){
		if($this->session->userdata('user') == 'medsilo' && $this->session->userdata('logged')){
			$this->params();
			$this->data['categories'] = $this->categories_model->categories_list();
			$this->load->view('admin/mdoa_product_new',$this->data);
		}
		else{
			redirect('admin/admin','refresh');
		}
	}
	
	public function add(){
		$form = array();
		$form['name'] = $this->input->post("npname");
		$form['category'] = $this->input->post("npcategory");
		$form['type'] = $this->input->post("nptype");
		$form['combination'] = $this->input->post("npcombination");
		$form['description'] = $this->input->post("npdescription");
		$form['indications'] = $this->input->post("npindications");
		$form['id'] = sprintf("%06d", mt_rand(100000,999999));
		//File Upload
		$fileconf['upload_path'] = './uploads/images/products/';
		$fileconf['allowed_types'] = 'jpg';
		$fileconf['max_size'] = '2048';
		$fileconf['file_name'] = $form['id'];
		$this->load->library('upload',$fileconf);
		if(!$this->upload->do_upload('npimage')){
			$error = array("error"=>$this->upload->display_errors());
			$this->params();
			$this->data['error'] = $error;
			foreach($error as $err){
				echo $err;
			}
		}
		else{
			//fetch file name
			$data = array("upload_data"=>$this->upload->data());
			$form['filename'] = 'images/products/'.$data['upload_data']['file_name'];
			if(self::insert($form['id'],self::protect($form['name']),self::protect($form['category']),self::protect($form['type']),self::protect($form['combination']),self::protect($form['description']),self::protect($form['indications']),self::protect($form['filename'])) == TRUE){
				$success = '<h1 class="display-4 text-strike"><i class="fa fa-plus-circle"></i></h1><h1 class="text-strobe">Product added.</h1><p class="lead">Product '.self::protect($form['name']).' has been added to the database.</p>';
				echo $success;
			}
			else{
				$failed = '<h1 class="display-4 text-strike"><i class="fa fa-plus-circle"></i></h1><h1 class="text-strobe">Error occurred!</h1><p class="lead">Unable to add product '.self::protect($form['name']).' to the database.</p>';
				echo $failed;
			}
		}
	}
	
	public function modify(){
		$form = array();
		$form['name'] = $this->input->post("epname");
		$form['category'] = $this->input->post("epcategory");
		$form['type'] = $this->input->post("eptype");
		$form['combination'] = $this->input->post("epcombination");
		$form['description'] = $this->input->post("epdescription");
		$form['indications'] = $this->input->post("epindications");
		$form['id'] = $this->input->post("epid");
		if(self::update($form['id'],self::protect($form['name']),self::protect($form['category']),self::protect($form['type']),self::protect($form['combination']),self::protect($form['description']),self::protect($form['indications'])) == TRUE){
			$success = '<h1 class="display-4 text-strike"><i class="fa fa-plus-circle"></i></h1><h1 class="text-strobe">Product updated.</h1><p class="lead">Product '.self::protect($form['name']).' has been updated.</p>';
			echo $success;
		}
		else{
			$failed = '<h1 class="display-4 text-strike"><i class="fa fa-plus-circle"></i></h1><h1 class="text-strobe">Error occurred!</h1><p class="lead">Unable to update product '.self::protect($form['name']).'</p>';
			echo $failed;
		}
	}
	
	public function delete($pid = NULL){
		$product_data = $this->products_model->product_data($pid);
		if(self::remove($pid) == TRUE){
			$status = 'Product ' . $product_data['pname'] . ' has been removed from the database.';
			$this->session->set_flashdata('status',$status);
			redirect('admin/product/list','refresh');
		}
		else{
			$status = 'Error occurred. Product ' . $product_data['pname'] . ' could not be removed from database.';
			$this->session->set_flashdata('status',$status);
			redirect('admin/product/list','refresh');
		}
	}
	
	private function protect($str){
		return mysql_real_escape_string($str);
	}
	
	private function insert($id,$name,$category,$type,$combination,$description,$indications,$imagepath){
		$status = $this->products_model->insert_product($id,$name,$category,$type,$combination,$description,$indications,$imagepath);
		return $status;
	}
	
	private function update($id,$name,$category,$type,$combination,$description,$indications){
		$status = $this->products_model->update_product($id,$name,$category,$type,$combination,$description,$indications);
		return $status;
	}
	
	private function remove($id){
		$status = $this->products_model->delete_product($id);
		return $status;
	}
}
?>