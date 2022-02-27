<?php
class Image extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('products_model');
	}
	public function params(){
		$this->data['title'] = "Admin | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "To incessantly elevating people's life by delivering quality healthcare products. Marketing the best products on demand in the pharmaceuticals industry. Providing affordable and superior healthcare products to serve people better.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Antibiotics, Anti-Allergic, Anti-Cough, Nutritional, Supplements, G.I.T, Antihelmintics, Analgesic, Anti-Inflammatory";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "editproduct";
		$this->data['error'] = '';
	}
	
	public function edit($pid = NULL){
		if($this->session->userdata('user') == 'medsilo' && $this->session->userdata('logged')){
			$this->params();
			$this->data['image_data'] = $this->products_model->product_data($pid);
			$this->load->view('admin/mdoa_product_image',$this->data);
		}
		else{
			redirect('admin/admin','refresh');
		}
	}
	
	public function update(){
		$form = array();
		$form['imagepath'] = $this->input->post("imgpath");
		$form['id'] = $this->input->post("imgid");
		//File Delete
		$imgloc = base_url().'/uploads/'.$form['imagepath'];
		if(file_exists($imgloc)){
			unlink($imgloc);
		}
		//File Upload
		$fileconf['upload_path'] = './uploads/images/products/';
		$fileconf['allowed_types'] = 'jpg';
		$fileconf['max_size'] = '2048';
		$fileconf['file_name'] = $form['id'];
		$fileconf['overwrite'] = TRUE;
		$this->load->library('upload',$fileconf);
		if(!$this->upload->do_upload('upimage')){
			$error = array("error"=>$this->upload->display_errors());
			$this->params();
			$this->data['error'] = $error;
			foreach($error as $err){
				echo $err;
			}
		}
		else{
				$success = '<h1 class="display-4 text-strike"><i class="fa fa-plus-circle"></i></h1><h1 class="text-strobe">Image updated.</h1><p class="lead">Product image has been updated.</p>';
				echo $success;
		}
	}
}
?>