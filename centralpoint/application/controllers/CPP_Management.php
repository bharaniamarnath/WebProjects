<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CPP_Management extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = "Management of Central Point Pharmacy. Directors, Managers, Pharmacist and Executives.";
		$data['description'] = "The Central Point Pharmacy has a modernized management system with high flexibility. It has an effective and efficient organization structure with strong research and development capability and sound human resource management.";
		$data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Management, Health-Care Organisation";
		$data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$data['current'] = "management";
		$data['management'] = simplexml_load_file(base_url()."assets/xml/management.xml");
		$this->load->view('cpp_management.php',$data);
	}
}
?>