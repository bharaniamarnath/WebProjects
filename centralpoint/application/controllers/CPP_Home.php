<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CPP_Home extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = "Central Point Pharmacy";
		$data['description'] = "Welcome to Central Point Pharmacy. Central Point Pharmacy is located in Seychelles. When it comes to number one pharmacy here, it is Central Point Pharmacy. Central Point Pharmacy provides the best healthcare and medicines.";
		$data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare";
		$data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$data['current'] = "home";
		$this->load->view('cpp_home.php',$data);
	}
}
?>