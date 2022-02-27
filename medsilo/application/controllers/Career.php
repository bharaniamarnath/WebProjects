<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Career extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
	}
	public function params(){
		$this->data['title'] = "Careers | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "Medsilo is an energetic, exciting place to work. We employ exceptional people, and every one of them is vested to think self reliantly take project and be inventive. We offer you to discover the realm of prospects waiting for you.";
		$this->data['keywords'] = "Medsilo, Pharmaceuticals, Chennai, India, Pharmacy, Pharma, Medicines, Medical, Healthcare, About Medsilo";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Medsilo Pharmaceuticals Pvt Ltd. All rights reserved.";
		$this->data['current'] = "career";
		$this->data['error'] = '';
	}
	public function index(){
		$this->params();
		$this->load->view('mdo_career.php',$this->data);
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
			$this->load->view('mdo_career.php',$this->data);
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
				$this->load->view('mdo_career',$this->data);
			}
			else{
				//fetch file name
				$data = array("upload_data"=>$this->upload->data());
				$form['filename'] = $data['upload_data']['full_path'];
				if(self::mailer($form['id'],self::protect($form['name']),self::protect($form['email']),self::protect($form['phone']),self::protect($form['gender']),self::protect($form['dob']),self::protect($form['qualification']),self::protect($form['experience']),self::protect($form['address']),$form['filename']) == TRUE){
					$success = '<h1 class="display-4 text-strike"><i class="fa fa-envelope-o"></i></h1><h1 class="text-strike">Application sent successfully.</h1><p class="lead">Thank you, '.self::protect($form['name']).'.<br>We will verify the application and respond back soon.</p>';
					echo $success;
				}
				else{
					$failed = '<h1 class="display-4 text-strike"><i class="fa fa-envelope-o"></i></h1><h1 class="text-strike">Error occurred!</h1><p class="lead">Sorry, '.self::protect($form['name']).'.<br>There was a problem sending your application.<br><span class="text-strike">Try again later.</span></p>';
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
		$subject = "Medsilo Web Admin - Careers";
		$mworkexp = ucfirst(str_replace("-"," ",$mexperience));
		$message = "<html><body><table cellpadding=\"10\" cellspacing=\"0\" style=\"border: 1px solid #00a0ff; \"><tr><th colspan=\"2\" style=\"background-color: #00a0ff;\"><img src=\"http://www.medsilo.co.in/assets/logos/medsilo_logo.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #00649b; color: #fff;\">Applicant ID: MA$mailid</th></tr><tr><td><b>Name:</b></td><td>$mname</td></tr><tr><td><b>Phone:</b></td><td>$mphone</td></tr><tr><td><b>Email:</b></td><td>$memail</td></tr><tr><td><b>Gender:</b></td><td>$mgender</td></tr><tr><td><b>Date of Birth:</b></td><td>$mdob</td></tr><tr><td><b>Qualification:</b></td><td>$mqualification</td></tr><tr><td><b>Work Experience:</b></td><td>$mworkexp</td></tr><tr><td><b>Postal Address:</b></td><td>$maddress</td></tr><tr><td colspan=\"2\" style=\"font-size:12px;background-color:#f5f5f5;color:#00649b;padding:10px;\"><center>This email is sent by the applicant via medsilo.co.in<br/>&copy; Copyrights " . date("Y") . ". Medsilo Pharmaceuticals Pvt Ltd. Plot No: 14, Flat No: G1, Saraswathy Nagar 7th Street, Chennai - 600042, Tamilnadu, India.<br/> Phone: +4422532342, +919884298671. Email: medsilopharmaceuticals@gmail.com | Website: <a style=\"color:#00a0ff;text-decoration:none;\" href=\"www.medsilo.co.in\">www.medsilo.co.in</a></center></td></tr></table></body></html>";
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