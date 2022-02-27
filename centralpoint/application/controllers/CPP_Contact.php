<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CPP_Contact extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
	}
	public function params(){
		$this->data['title'] = "Contact Central Point Pharmacy. Get connected to our pharmacy service anytime from anywhere.";
		$this->data['description'] = "The Central Point Pharmacy connects to the people in Seychelles and around the world to provide quality pharmacy and healthcare services anytime. Direct contacts are available regular weekdays during working hours. We also connect via phone, email and facebook.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Contact, Central Point Facebook, Central Point Pharmacy Address";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "contact";
		$this->data['address'] = simplexml_load_file(base_url()."assets/xml/contact.xml");
	}
	public function index(){
		$this->params();
		$this->load->view('cpp_contact.php',$this->data);
	}
}
?>