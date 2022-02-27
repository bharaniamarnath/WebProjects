<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = "Medsilo Pharmaceuticals Private Limited";
		$data['description'] = "Welcome to Medsilo Pharmaceuticals Private Limited. Medsilo pharmaceuticals was started with a mission to thrive in pharmaceutical trade. Our precedence is to deal out reasonable and world class medication with reasonable fee to aid people better.";
		$data['keywords'] = "Medsilo, Pharmaceuticals, Chennai, India, Pharmacy, Pharma, Medicines, Medical, Healthcare";
		$data['copyright'] = "&copy; Copyrights ". date('Y') .". Medsilo Pharmaceuticals Pvt Ltd. All rights reserved.";
		$data['current'] = "home";
		$this->load->view('mdo_home.php',$data);
	}
}
?>