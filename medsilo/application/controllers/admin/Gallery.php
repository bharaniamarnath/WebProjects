<?php
class Gallery extends CI_Controller{
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
	
	public function view($pid = NULL){
		if($this->session->userdata('user') == 'medsilo' && $this->session->userdata('logged')){
			$this->params();
			$this->data['gallery_data'] = $this->products_model->get_gallery($pid);
			$this->data['product_data'] = $this->products_model->product_data($pid);
			$this->load->view('admin/mdoa_product_gallery',$this->data);
		}
		else{
			redirect('admin/admin','refresh');
		}
	}
	
	public function delete($imgid = NULL){
		$image_data = $this->products_model->gallery_data($imgid);
		$image_link = './uploads/'.$image_data['link'];
		$image_pid = $image_data['pid'];
		if(file_exists($image_link)){
			unlink($image_link);
			$del_img_rec = $this->products_model->del_gallery($imgid);
			if($del_img_rec == TRUE){
				redirect('admin/product/gallery/'.$image_pid,'refresh');
			}
			else{
				redirect('admin/product/gallery/'.$image_pid,'refresh');
			}
		}
	}
	
	public function add(){
		$form = array();
		$form['product_id'] = $this->input->post("pid");
		$form['id'] = sprintf("%06d", mt_rand(100000,999999));
		//File Upload
		$fileconf['upload_path'] = './uploads/images/gallery/';
		$fileconf['allowed_types'] = 'jpg';
		$fileconf['max_size'] = '2048';
		$fileconf['file_name'] = $form['id'];
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
			//fetch file name
			$data = array("upload_data"=>$this->upload->data());
			$form['filename'] = 'images/gallery/'.$data['upload_data']['file_name'];
			if(self::insert($form['id'],$form['product_id'],self::protect($form['filename'])) == TRUE){
				$success = '<h1 class="display-4 text-strike"><i class="fa fa-image"></i></h1><h1 class="text-strobe">Image uploaded.</h1><p class="lead">Image has been added to the product gallery.</p>';
				echo $success;
			}
			else{
				$failed = '<h1 class="display-4 text-strike"><i class="fa fa-image"></i></h1><h1 class="text-strobe">Error occurred!</h1><p class="lead">Unable to add image to the product gallery.</p>';
				echo $failed;
			}
		}
	}
	
	private function protect($str){
		return mysql_real_escape_string($str);
	}
	
	private function insert($id,$pid,$imagepath){
		$status = $this->products_model->insert_gallery($id,$pid,$imagepath);
		return $status;
	}
}
?>