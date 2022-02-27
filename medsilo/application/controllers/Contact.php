<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
	}
	public function params(){
		$this->data['title'] = "Contact | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "Medsilo Pharmaceuticals ensure a reliable connection to its customers and business deals. Connect to us now via email, phone and your favorite social networks.";
		$this->data['keywords'] = "Medsilo, Pharmaceuticals, Chennai, India, Pharmacy, Pharma, Medicines, Medical, Healthcare, Pharmaceuticals Chennai";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Medsilo Pharmaceuticals Pvt Ltd. All rights reserved.";
		$this->data['current'] = "contact";
		$this->data['address'] = simplexml_load_file(base_url()."assets/xml/contact.xml");
	}
	public function index(){
		$this->params();
		$this->load->view('mdo_contact.php',$this->data);
	}
}
?>