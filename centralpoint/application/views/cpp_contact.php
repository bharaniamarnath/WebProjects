<?php
	$param['title'] = $title;
	$param['description'] = $description;
	$param['keywords'] = $keywords;
	$param['copyright'] = $copyright;
	$param['current'] = $current;
	$param['address'] = $address;
	$this->load->view('templates/cpp_view_header.php',$param);
	$this->load->view('templates/cpp_view_navbar.php',$param);
	$this->load->view('pages/cpp_view_contact.php');
	$this->load->view('templates/cpp_view_footbar.php',$param);
	$this->load->view('pagescripts/cpp_script_main.php');
	$this->load->view('templates/cpp_view_footer.php');
?>