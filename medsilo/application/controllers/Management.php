<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Management extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = "Management | Medsilo Pharmaceuticals Pvt Ltd";
		$data['description'] = "Medsilo Pharmaceuticals is distinguishing that the pharmacy staff is our key reserve employing and holding very skilled pharmacists and supportive personnel. Instructing patients on the safe use of medications. Providing health training programs to the community to avert disease and support public health.";
		$data['keywords'] = "Medsilo, Pharmaceuticals, Chennai, India, Pharmacy, Pharma, Medicines, Medical, Healthcare, Management";
		$data['copyright'] = "&copy; Copyrights ". date('Y') .". Medsilo Pharmaceuticals Pvt Ltd. All rights reserved.";
		$data['current'] = "management";
		$data['management'] = simplexml_load_file(base_url()."assets/xml/management.xml");
		$this->load->view('mdo_management.php',$data);
	}
}
?>