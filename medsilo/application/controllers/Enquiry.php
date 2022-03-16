<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Enquiry extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('enquiry_model');
	}
	public function params(){
		$this->data['title'] = "Enquiry | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "Medsilo pharmaceuticals was started with a mission to thrive in pharmaceutical trade. Our precedence is to deal out reasonable and world class medication with reasonable fee to aid people better.";
		$this->data['keywords'] = "Medsilo, Pharmaceuticals, Chennai, India, Pharmacy, Pharma, Medicines, Medical, Healthcare, About Medsilo";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Medsilo Pharmaceuticals Pvt Ltd. All rights reserved.";
		$this->data['current'] = "contact";
		$this->data['error'] = '';
	}
	public function index(){
		$this->params();
		$this->load->view('mdo_enquiry.php',$this->data);
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
			$this->load->view('mdo_enquiry.php',$this->data);
		}
		else{
			$form = array();
			$form['name'] = $this->input->post("ename");
			$form['email'] = $this->input->post("eemail");
			$form['phone'] = $this->input->post("ephone");
			$form['message'] = $this->input->post("emessage");
			$form['id'] = sprintf("%06d", mt_rand(100000,999999));
			if(self::mailer($form['id'],self::protect($form['name']),self::protect($form['email']),self::protect($form['phone']),self::protect($form['message']))){
				$this->enquiry_model->insert_enquiry($form['id'],self::protect($form['name']),self::protect($form['email']),self::protect($form['phone']),self::protect($form['message']));
				$success = '<h1 class="display-4 text-strike"><i class="fa fa-envelope-o"></i></h1><h1 class="text-strike">Enquiry sent successfully.</h1><p class="lead">Thank you, '.self::protect($form['name']).'.<br>We will verify the enquiry and respond back soon.</p>';
				echo $success;
			}
			else{
				$failed = '<h1 class="display-4 text-strike"><i class="fa fa-envelope-o"></i></h1><h1 class="text-strike">Error occurred!</h1><p class="lead">Sorry, '.self::protect($form['name']).'.<br>There was a problem sending your enquiry.<br><span class="text-strike">Try again later, or contact us.</span></p>';
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
		$config['smtp_user'] = '';
		$config['smtp_pass'] = '';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;
		$config['charset'] = 'iso-8859-1';
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$to_mail = "cephilo@gmail.com";
		$subject = "Medsilo Web Admin - Enquiry";
		$message = "<html><body><table cellpadding=\"10\" cellspacing=\"0\" style=\"border: 1px solid #00a0ff; \"><tr><th colspan=\"2\" style=\"background-color: #00a0ff;\"><img src=\"http://www.medsilo.co.in/assets/logos/medsilo_logo.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #00649b; color: #fff;\">Enquiry ID: ME$mailid</th></tr><tr><td><b>Name:</b></td><td>$mname</td></tr><tr><td><b>Phone:</b></td><td>$mphone</td></tr><tr><td><b>Email:</b></td><td>$memail</td></tr><tr><td><b>Enquiry Message:</b></td><td>$mmessage</td></tr><tr><td colspan=\"2\" style=\"font-size:12px;background-color:#f5f5f5;color:#00649b;padding:10px;\"><center>This email is sent by the enquirer via medsilo.co.in<br/>&copy; Copyrights " . date("Y") . ". Medsilo Pharmaceuticals Pvt Ltd. Plot No: 14, Flat No: G1, Saraswathy Nagar 7th Street, Chennai - 600042, Tamilnadu, India.<br/> Phone: +4422532342, +919884298671. Email: medsilopharmaceuticals@gmail.com | Website: <a style=\"color:#00a0ff;text-decoration:none;\" href=\"www.medsilo.co.in\">www.medsilo.co.in</a></center></td></tr></table></body></html>";
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
