<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CPP_Terms extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = "Terms and Conditions | Central Point Pharmacy";
		$data['description'] = "The Central Point Pharmacy website at www.website.com is owned and operated by Central Point Pharmacy, a company registered in the Seychelles, under company registration number xxxx/xxxxxx/xx, which has its head office at PO Box 1448, Le-Chantier Mall, Francis-Rachel Street, Victoria, Mahe.";
		$data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Terms, Conditions";
		$data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$data['current'] = "about";
		$data['terms'] = simplexml_load_file(base_url()."assets/xml/terms.xml");
		$this->load->view('cpp_terms.php',$data);
	}
}
?>