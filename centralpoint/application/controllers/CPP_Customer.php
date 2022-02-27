<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CPP_Customer extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
	}
	public function params(){
		$this->data['title'] = "Customer Enquiry section in Central Point Pharmacy. An easy way to serve customer requirements.";
		$this->data['description'] = "The Central Point Pharmacy Customer Enquiry allows its customers in categories either in general, patient or hospital to request required products by providing a list via enquiry form or upload a prescription.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Contact, Customer Enquiry, Prescription, Product List";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "contact";
		$this->data['error'] = '';
	}
	public function index(){
		$this->params();
		$this->load->view('cpp_customer.php',$this->data);
	}

	public function sendlist(){
			$form = array();
			$form['name'] = $this->input->post("plname");
			$form['email'] = $this->input->post("plemail");
			$form['phone'] = $this->input->post("plphone");
			$form['category'] = $this->input->post("plcategory");
			$plname = $this->input->post("product");
			$plqty = $this->input->post("quantity");
			$plcount = count($plname);
			$form['list'] = "";
			for($i=1;$i<=$plcount;$i++){
				$form['list'] .= ucwords($plname[$i]) . " - " . $plqty[$i] . "<br>";
			}
			$form['id'] = sprintf("%06d", mt_rand(100000,999999));
			if(self::listmailer($form['id'],self::protect($form['name']),self::protect($form['email']),self::protect($form['phone']),self::protect($form['category']),self::protect($form['list']))){
				$success = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Enquiry sent successfully.</h1><p class="lead">Thank you, '.self::protect($form['name']).'.<br>We will verify the enquiry and respond back soon.</p>';
				echo $success;
			}
			else{
				$failed = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Error occurred!</h1><p class="lead">Sorry, '.self::protect($form['name']).'.<br>There was a problem sending your enquiry.<br><span class="text-fuschia">Try again later, or contact us.</span></p>';
				echo $failed;
			}
	}
	
	public function prescription(){
			$form = array();
			$form['name'] = $this->input->post("prname");
			$form['email'] = $this->input->post("premail");
			$form['phone'] = $this->input->post("prphone");
			$form['category'] = $this->input->post("prcategory");
			$form['id'] = sprintf("%06d", mt_rand(100000,999999));
			//File Upload
			$fileconf['upload_path'] = './uploads/prescriptions/';
			$fileconf['allowed_types'] = 'pdf|jpg';
			$fileconf['max_size'] = '2048';
			$fileconf['file_name'] = 'prescription_'.$form['name'].'_'.$form['id'];
			$this->load->library('upload',$fileconf);
			if(!$this->upload->do_upload("prfile")){
				$error = array("error"=>$this->upload->display_errors());
				$this->params();
				$this->data['error'] = $error;
				$this->load->view('cpp_customer',$this->data);
			}
			else{
				//fetch file name
				$data = array("upload_data"=>$this->upload->data());
				$form['filename'] = $data['upload_data']['full_path'];
				if(self::presmailer($form['id'],self::protect($form['name']),self::protect($form['email']),self::protect($form['phone']),self::protect($form['category']),$form['filename']) == TRUE){
					$success = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Application sent successfully.</h1><p class="lead">Thank you, '.self::protect($form['name']).'.<br>We will verify the prescription and respond back soon.</p>';
					echo $success;
				}
				else{
					$failed = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Error occurred!</h1><p class="lead">Sorry, '.self::protect($form['name']).'.<br>There was a problem sending your application.<br><span class="text-fuschia">Try again later.</span></p>';
					echo $failed;
				}
			}
	}
	
	private function protect($str){
		return mysql_real_escape_string($str);
	}
	
	private function listmailer($mailid,$mname,$memail,$mphone,$mcategory,$mlist){
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
		$subject = "Customer Enquiry - Central Point Pharmacy";
		$message = "<html><body style=\"background-color: #ffffff;color: #ff3c64;\"><table cellpadding=\"10\" cellspacing=\"0\" style=\background-color: #ffffff; color: #a05064\"><tr><th colspan=\"2\" style=\"background-color: #ffffff;\"><img src=\"http://www.centralpointpharmacy.com/assets/logos/cpp-logo.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #ff3c64; color: #ffffff;\">Enquiry ID: CPE$mailid</th></tr><tr><td><b>Name:</b></td><td>$mname</td></tr><tr><td><b>Phone:</b></td><td>$mphone</td></tr><tr><td><b>Email:</b></td><td>$memail</td></tr><tr><td><b>Category:</b></td><td>$mcategory</td></tr><tr><td valign=\"top\"><b>Products required:</b></td><td>$mlist</td></tr><tr><td colspan=\"2\" style=\"background-color: #ffffff; color: #999999;\"><center>This email is sent by the enquirer via Central Point Pharmacy website <a href=\"http://www.centralpointpharmacy.com\">www.centralpointpharmacy.com</a><br/>PO Box 1448, Le-Chantier Mall, Francis-Rachel Street, Victoria, Mahe, Seychelles.<br/>+248 4225574<br/><span style=\"text-decoration: none; color: #a05064;\">cppharmacy@live.com, cppharmacy@seychelles.net</span></center></td></tr></table></body></html>";
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
	
	private function presmailer($mailid,$mname,$memail,$mphone,$mcategory,$mfile){
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
		$subject = "Customer Enquiry - Central Point Pharmacy";
		$message = "<html><body style=\"background-color: #ffffff;color: #ff3c64;\"><table cellpadding=\"10\" cellspacing=\"0\" style=\background-color: #ffffff; color: #a05064\"><tr><th colspan=\"2\" style=\"background-color: #ffffff;\"><img src=\"http://www.centralpointpharmacy.com/assets/logos/cpp-logo.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #ff3c64; color: #ffffff;\">Applicant ID: CPA$mailid</th></tr><tr><td><b>Name:</b></td><td>$mname</td></tr><tr><td><b>Phone:</b></td><td>$mphone</td></tr><tr><td><b>Email:</b></td><td>$memail</td></tr><tr><td><b>Category:</b></td><td>$mcategory</td></tr><tr><td colspan=\"2\" style=\"background-color: #ffffff; color: #999999;\"><center>This email is sent by the applicant via Central Point Pharmacy website <a href=\"http://www.centralpointpharmacy.com\">www.centralpointpharmacy.com</a><br/>PO Box 1448, Le-Chantier Mall, Francis-Rachel Street, Victoria, Mahe, Seychelles.<br/>+248 4225574<br/><span style=\"text-decoration: none; color: #a05064;\">cppharmacy@live.com, cppharmacy@seychelles.net</span></center></td></tr></table></body></html>";
		$upload_file = $mfile;
		$this->email->from($memail,$mname);
		$this->email->to($to_mail);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->attach($upload_file);
		if($this->email->send()){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>