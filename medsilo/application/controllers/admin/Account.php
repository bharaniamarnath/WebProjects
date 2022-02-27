<?php
class Account extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}
	public function params(){
		$this->data['title'] = "Admin | Medsilo Pharmaceuticals Pvt Ltd";
		$this->data['description'] = "To incessantly elevating people's life by delivering quality healthcare products. Marketing the best products on demand in the pharmaceuticals industry. Providing affordable and superior healthcare products to serve people better.";
		$this->data['keywords'] = "Pharmacy, Seychelles, Pharma, Central Point, Pharmaceuticals, Medicine, Healthcare, Antibiotics, Anti-Allergic, Anti-Cough, Nutritional, Supplements, G.I.T, Antihelmintics, Analgesic, Anti-Inflammatory";
		$this->data['copyright'] = "&copy; Copyrights ". date('Y') .". Central Point Pharmacy. All rights reserved.";
		$this->data['current'] = "account";
	}
	public function index(){
		$this->params();
		$this->data['lastlogin'] = $this->admin_model->lastlogin();
		$this->load->view('admin/mdoa_account',$this->data);
	}
	public function update(){
		$adata = array(
			'cpswd'=>$this->input->post("adminpwd"),
			'npswd'=>$this->input->post("newpwd"),
			'rnpswd'=>$this->input->post("rnewpwd")
			);
		if($this->admin_model->checkpassword($adata['cpswd']) == false){
			$error = '<h1 class="display-4 text-strike"><i class="fa fa-times-circle"></i></h1><h1 class="text-strobe">Incorrect Password.</h1><p class="lead">Incorrect current password.</p>';
			echo $error;
		}
		else{
			$status = $this->admin_model->updatepassword($adata);
			if($status == true){
				self::mailer($adata['npswd']);
				$success = '<h1 class="display-4 text-strike"><i class="fa fa-check-circle"></i></h1><h1 class="text-strobe">Password updated.</h1><p class="lead">Admin password has been updated.<br />Use the new password to login in next time.</p>';
				echo $success;
			}
			else{
				$error = '<h1 class="display-4 text-strike"><i class="fa fa-check-circle"></i></h1><h1 class="text-strobe">Error occurred.</h1><p class="lead">Unable to update the account password.</p>';
				echo $error;
			}
		}
	}
	
	private function mailer($npwd){
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
		$sender = "admin@medsilo.co.in";
		$sender_name = "Medsilo Web Admin";
		$to_mail = "cephilo@gmail.com";
		$subject = "Medsilo Web Admin - Password Changed";
		$message = "<html><body><table cellpadding=\"10\" cellspacing=\"0\" style=\"border: 1px solid #00a0ff; \"><tr><th colspan=\"2\" style=\"background-color: #00a0ff;\"><img src=\"http://www.medsilo.co.in/assets/logos/medsilo_logo.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #00649b; color: #fff;\">Medsilo Web Admin Notification</th></tr><tr><td><b>Medsilo Web Admin password has been changed.</b></td></tr><tr><td><b>NEW PASSWORD: $npwd</b></td></tr><tr><td>Use the new password to login and access Medsilo Web Admin.</td></tr><tr><td>Medsilo Web Admin Link: <a href=\"http://www.medsilo.co.in/admin\">Click here</a></td></tr><tr><td style=\"font-size:12px;background-color:#f5f5f5;color:#00649b;padding:10px;\"><center>&copy; Copyrights " . date("Y") . ". Medsilo Pharmaceuticals Pvt Ltd. Plot No: 14, Flat No: G1, Saraswathy Nagar 7th Street, Chennai - 600042, Tamilnadu, India. Phone: +4422532342, +919884298671. Email: medsilopharmaceuticals@gmail.com | Website: <a style=\"color:#00a0ff;text-decoration:none;\" href=\"www.medsilo.co.in\">www.medsilo.co.in</a></center></td></tr></table></body></html>"; 
		$this->email->from($sender,$sender_name);
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