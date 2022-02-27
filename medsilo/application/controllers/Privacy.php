<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Privacy extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = "Privacy Policy | Medsilo Pharmaceuticals Pvt Ltd";
		$data['description'] = "Medsilo pharmaceuticals was started with a mission to thrive in pharmaceutical trade. Our precedence is to deal out reasonable and world class medication with reasonable fee to aid people better.";
		$data['keywords'] = "Medsilo, Pharmaceuticals, Chennai, India, Pharmacy, Pharma, Medicines, Medical, Healthcare, About Medsilo";
		$data['copyright'] = "&copy; Copyrights ". date('Y') .". Medsilo Pharmaceuticals Pvt Ltd. All rights reserved.";
		$data['current'] = "about";
		$data['privacy'] = simplexml_load_file(base_url()."assets/xml/privacy.xml");
		$this->load->view('mdo_privacy.php',$data);
	}
}
?>