<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Supplier extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
	}
	public function params(){
		$this->data['title'] = "Supplier | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "Medsilo pharmaceuticals was started with a mission to thrive in pharmaceutical trade. Our precedence is to deal out reasonable and world class medication with reasonable fee to aid people better.";
		$this->data['keywords'] = "Medsilo, Pharmaceuticals, Chennai, India, Pharmacy, Pharma, Medicines, Medical, Healthcare, About Medsilo";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Medsilo Pharmaceuticals Pvt Ltd. All rights reserved.";
		$this->data['current'] = "contact";
		$this->data['error'] = '';
	}
	public function index(){
		$this->params();
		$this->load->view('mdo_supplier.php',$this->data);
	}

	public function send(){
			$form = array();
			$form['name'] = $this->input->post("suname");
			$form['licno'] = $this->input->post("sulicno");
			$form['lictype'] = $this->input->post("lictype");
			$form['licstatus'] = $this->input->post("licstatus");
			$form['subizact'] = $this->input->post("subizact");
			$form['email'] = $this->input->post("suemail");
			$form['phone'] = $this->input->post("suphone");
			$form['address'] = $this->input->post("suaddress");
			$form['id'] = sprintf("%06d", mt_rand(100000,999999));
			if(self::mailer($form['id'],self::protect($form['name']),self::protect($form['licno']),self::protect($form['lictype']),self::protect($form['licstatus']),self::protect($form['subizact']),self::protect($form['email']),self::protect($form['phone']),self::protect($form['address']))){
				$success = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Enquiry sent successfully.</h1><p class="lead">Thank you, '.self::protect($form['name']).'.<br>We will verify the enquiry and respond back soon.</p>';
				echo $success;
			}
			else{
				$failed = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Error occurred!</h1><p class="lead">Sorry, '.self::protect($form['name']).'.<br>There was a problem sending your enquiry.<br><span class="text-fuschia">Try again later, or contact us.</span></p>';
				echo $failed;
			}
	}
	
	private function protect($str){
		return mysql_real_escape_string($str);
	}
	private function mailer($mailid,$mname,$mlicno,$mlictype,$mlicstatus,$msubizact,$memail,$mphone,$maddress){
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
		$subject = "Supplier Enquiry - Central Point Pharmacy";
		$message = "<html><body style=\"background-color: #ffffff;color: #ff3c64;\"><table cellpadding=\"10\" cellspacing=\"0\" style=\background-color: #ffffff; color: #a05064\"><tr><th colspan=\"2\" style=\"background-color: #ffffff;\"><img src=\"http://www.centralpointpharmacy.com/assets/logos/cpp-logo.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #ff3c64; color: #ffffff;\">Enquiry ID: CPSE$mailid</th></tr><tr><td><b>Business Name:</b></td><td>$mname</td></tr><tr><td><b>License Number:</b></td><td>$mlicno</td></tr><tr><td><b>License Type:</b></td><td>$mlictype</td></tr><tr><td><b>License Status:</b></td><td>$mlicstatus</td></tr><tr><td><b>Business Activity:</b></td><td>$msubizact</td></tr><tr><td><b>Phone:</b></td><td>$mphone</td></tr><tr><td><b>Email:</b></td><td>$memail</td></tr><tr><td><b>Enquiry Message:</b></td><td>$maddress</td></tr><tr><td colspan=\"2\" style=\"background-color: #ffffff; color: #999999;\"><center>This email is sent by the enquirer via Central Point Pharmacy website <a href=\"http://www.centralpointpharmacy.com\">www.centralpointpharmacy.com</a><br/>PO Box 1448, Le-Chantier Mall, Francis-Rachel Street, Victoria, Mahe, Seychelles.<br/>+248 4225574<br/><span style=\"text-decoration: none; color: #a05064;\">cppharmacy@live.com, cppharmacy@seychelles.net</span></center></td></tr></table></body></html>";
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