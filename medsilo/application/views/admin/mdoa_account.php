<?php
	$param['title'] = $title;
	$param['description'] = $description;
	$param['keywords'] = $keywords;
	$param['copyright'] = $copyright;
	$param['current'] = $current;
	$param['lastlogin'] = $lastlogin;
	$this->load->view('admin/templates/mdoa_view_header',$param);
	$this->load->view('admin/templates/mdoa_view_navbar',$param);
	$this->load->view('admin/pages/mdoa_view_account',$param);
	$this->load->view('admin/templates/mdoa_view_footbar',$param);
	$this->load->view('admin/pagescripts/mdoa_script_main');
	$this->load->view('admin/pagescripts/mdoa_script_account');
	$this->load->view('admin/templates/mdoa_view_footer');
?>