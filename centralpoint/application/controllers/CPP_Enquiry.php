<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CPP_Enquiry extends CI_Controller{
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
		$this->data['error'] = '';
	}
	public function index(){
		$this->params();
		$this->load->view('cpp_enquiry.php',$this->data);
	}

	public function send(){
		$rules = array(
			"ename" => array(
				"field" => "ename",
				"label" => "Name",
				"rules" => "required|max_length[20]|min_length[5]"
			),
			"eemail" => array(
				"field" => "eemail",
				"label" => "Email",
				"rules" => "required|max_length[50]|min_length[5]|valid_email"
			),
			"ephone" => array(
				"field" => "ephone",
				"label" => "Phone",
				"rules" => "required|numeric|max_length[10]|min_length[5]"
			),
			"emessage" => array(
				"field" => "emessage",
				"label" => "Message",
				"rules" => "required|max_length[512]|min_length[5]"
			)
		);
		if(!$this->input->post('eterms')){
			$this->form_validation->set_rules('eterms','Terms and Conditions','required');
		}
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == FALSE){
			$this->params();
			$this->load->view('cpp_enquiry.php',$this->data);
		}
		else{
			$form = array();
			$form['name'] = $this->input->post("ename");
			$form['email'] = $this->input->post("eemail");
			$form['phone'] = $this->input->post("ephone");
			$form['message'] = $this->input->post("emessage");
			$form['id'] = sprintf("%06d", mt_rand(100000,999999));
			if(self::mailer($form['id'],self::protect($form['name']),self::protect($form['email']),self::protect($form['phone']),self::protect($form['message']))){
				$success = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Enquiry sent successfully.</h1><p class="lead">Thank you, '.self::protect($form['name']).'.<br>We will verify the enquiry and respond back soon.</p>';
				echo $success;
			}
			else{
				$failed = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Error occurred!</h1><p class="lead">Sorry, '.self::protect($form['name']).'.<br>There was a problem sending your enquiry.<br><span class="text-fuschia">Try again later, or contact us.</span></p>';
				echo $failed;
			}
		}
	}
	
	private function protect($str){
		return mysql_real_escape_string($str);
	}
	private function mailer($mailid,$mname,$memail,$mphone,$mmessage){
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'mailer.centralpoint@gmail.com';
		$config['smtp_pass'] = 'central.p0int';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$config['charset'] = 'iso-8859-1';
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$to_mail = "cephilo@gmail.com";
		$subject = "Enquiry - Central Point Pharmacy";
		$message = "<html><body style=\"background-color: #ffffff;color: #ff3c64;\"><table cellpadding=\"10\" cellspacing=\"0\" style=\background-color: #ffffff; color: #a05064\"><tr><th colspan=\"2\" style=\"background-color: #ffffff;\"><img src=\"http://www.centralpointpharmacy.com/assets/logos/cpp-logo.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #ff3c64; color: #ffffff;\">Enquiry ID: CPE$mailid</th></tr><tr><td><b>Name:</b></td><td>$mname</td></tr><tr><td><b>Phone:</b></td><td>$mphone</td></tr><tr><td><b>Email:</b></td><td>$memail</td></tr><tr><td><b>Enquiry Message:</b></td><td>$mmessage</td></tr><tr><td colspan=\"2\" style=\"background-color: #ffffff; color: #999999;\"><center>This email is sent by the enquirer via Central Point Pharmacy website <a href=\"http://www.centralpointpharmacy.com\">www.centralpointpharmacy.com</a><br/>PO Box 1448, Le-Chantier Mall, Francis-Rachel Street, Victoria, Mahe, Seychelles.<br/>+248 4225574<br/><span style=\"text-decoration: none; color: #a05064;\">cppharmacy@live.com, cppharmacy@seychelles.net</span></center></td></tr></table></body></html>";
		$this->email->from($memail,$mname);
		$this->email->to($to_mail);
		$this->email->subject($subject);
		$this->email->message($message);
		if($this->email->send()){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>