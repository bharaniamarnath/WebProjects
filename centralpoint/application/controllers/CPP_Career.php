<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CPP_Career extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
	}
	public function params(){
		$this->data['title'] = "Careers at Central Point Pharmacy. Opportunity to work with Central Point Pharmacy.";
		$this->data['description'] = "The Central Point Pharmacy has a modernized management system with high flexibility. It has an effective and efficient organization structure with strong research and development capability and sound human resource management.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Management, Health-Care Organisation";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "career";
		$this->data['error'] = '';
	}
	public function index(){
		$this->params();
		$this->load->view('cpp_career.php',$this->data);
	}
	public function send(){
		$rules = array(
			"cname" => array(
				"field" => "cname",
				"label" => "Name",
				"rules" => "required|max_length[20]|min_length[5]"
			),
			"cemail" => array(
				"field" => "cemail",
				"label" => "Email",
				"rules" => "required|max_length[50]|min_length[5]|valid_email"
			),
			"cphone" => array(
				"field" => "cphone",
				"label" => "Phone",
				"rules" => "required|numeric|max_length[10]|min_length[5]"
			),
			"cgender" => array(
				"field" => "cgender",
				"label" => "Gender",
				"rules" => "required"
			),
			"cdob" => array(
				"field" => "cdob",
				"label" => "Date of Birth",
				"rules" => "required"
			),
			"cqualification" => array(
				"field" => "cqualification",
				"label" => "Qualification",
				"rules" => "required"
			),
			"cexperience" => array(
				"field" => "cexperience",
				"label" => "Work Experience",
				"rules" => "required"
			),
			"caddress" => array(
				"field" => "caddress",
				"label" => "Message",
				"rules" => "required|max_length[512]|min_length[5]"
			)
		);
		if (empty($_FILES['cfile']['size'])){
			$this->form_validation->set_rules('cfile', 'File', 'required');
		}
		if(!$this->input->post('cterms')){
			$this->form_validation->set_rules('cterms','Terms and Conditions','required');
		}
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == FALSE){
			$this->params();
			$this->load->view('cpp_career.php',$this->data);
		}
		else{
			$form = array();
			$form['name'] = $this->input->post("cname");
			$form['email'] = $this->input->post("cemail");
			$form['phone'] = $this->input->post("cphone");
			$form['gender'] = $this->input->post("cgender");
			$form['dob'] = $this->input->post("cdob");
			$form['qualification'] = $this->input->post("cqualification");
			$form['experience'] = $this->input->post("cexperience");
			$form['address'] = $this->input->post("caddress");
			$form['id'] = sprintf("%06d", mt_rand(100000,999999));
			//File Upload
			$fileconf['upload_path'] = './uploads/resumes/';
			$fileconf['allowed_types'] = 'pdf';
			$fileconf['max_size'] = '2048';
			$fileconf['file_name'] = 'resume_'.$form['name'].'_'.$form['id'];
			$this->load->library('upload',$fileconf);
			if(!$this->upload->do_upload("cfile")){
				$error = array("error"=>$this->upload->display_errors());
				$this->params();
				$this->data['error'] = $error;
				$this->load->view('cpp_career',$this->data);
			}
			else{
				//fetch file name
				$data = array("upload_data"=>$this->upload->data());
				$form['filename'] = $data['upload_data']['full_path'];
				if(self::mailer($form['id'],self::protect($form['name']),self::protect($form['email']),self::protect($form['phone']),self::protect($form['gender']),self::protect($form['dob']),self::protect($form['qualification']),self::protect($form['experience']),self::protect($form['address']),$form['filename']) == TRUE){
					$success = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Application sent successfully.</h1><p class="lead">Thank you, '.self::protect($form['name']).'.<br>We will verify the application and respond back soon.</p>';
					echo $success;
				}
				else{
					$failed = '<h1 class="display-4 text-fuschia"><i class="fa fa-envelope-o"></i></h1><h1 class="text-fuschia">Error occurred!</h1><p class="lead">Sorry, '.self::protect($form['name']).'.<br>There was a problem sending your application.<br><span class="text-fuschia">Try again later.</span></p>';
					echo $failed;
				}
			}
		}
	}
	private function protect($str){
		$str = trim($str);
		return mysql_real_escape_string($str);
	}
	private function mailer($mailid,$mname,$memail,$mphone,$mgender,$mdob,$mqualification,$mexperience,$maddress,$mfile){
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
		$subject = "Careers - Central Point Pharmacy";
		$mworkexp = ucfirst(str_replace("-"," ",$mexperience));
		$message = "<html><body style=\"background-color: #ffffff;color: #ff3c64;\"><table cellpadding=\"10\" cellspacing=\"0\" style=\background-color: #ffffff; color: #a05064\"><tr><th colspan=\"2\" style=\"background-color: #ffffff;\"><img src=\"http://www.centralpointpharmacy.com/assets/logos/cpp-logo.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #ff3c64; color: #ffffff;\">Applicant ID: CPA$mailid</th></tr><tr><td><b>Name:</b></td><td>$mname</td></tr><tr><td><b>Phone:</b></td><td>$mphone</td></tr><tr><td><b>Email:</b></td><td>$memail</td></tr><tr><td><b>Gender:</b></td><td>$mgender</td></tr><tr><td><b>Date of Birth:</b></td><td>$mdob</td></tr><tr><td><b>Qualification:</b></td><td>$mqualification</td></tr><tr><td><b>Work Experience:</b></td><td>$mworkexp</td></tr><tr><td><b>Postal Address:</b></td><td>$maddress</td></tr><tr><td colspan=\"2\" style=\"background-color: #ffffff; color: #999999;\"><center>This email is sent by the applicant via Central Point Pharmacy website <a href=\"http://www.centralpointpharmacy.com\">www.centralpointpharmacy.com</a><br/>PO Box 1448, Le-Chantier Mall, Francis-Rachel Street, Victoria, Mahe, Seychelles.<br/>+248 4225574<br/><span style=\"text-decoration: none; color: #a05064;\">cppharmacy@live.com, cppharmacy@seychelles.net</span></center></td></tr></table></body></html>";
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