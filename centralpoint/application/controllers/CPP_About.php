<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CPP_About extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = "About Central Point Pharmacy. Seven Major Structures.";
		$data['description'] = "The Central Point Pharmacy is one of the leading pharmacies in Seychelles. Not only the Group has achieved encouraging economic results, has been continuously formulating and strengthening its seven major structures.";
		$data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, About";
		$data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$data['current'] = "about";
		$this->load->view('cpp_about.php',$data);
	}
}
?>