<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Services extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['title'] = "Services | Medsilo Pharmaceuticals Pvt Ltd";
		$data['description'] = "The Central Point Pharmacy provides support to local programs that address community needs with a focus on hunger relief, education, social services, workforce development and fine arts. Central Point Pharmacy is committed to maintaining and inclusive work environment for people of all backgrounds.";
		$data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Services";
		$data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$data['current'] = "services";
		$data['services'] = simplexml_load_file(base_url()."assets/xml/services.xml");
		$this->load->view('mdo_services.php',$data);
	}
}
?>