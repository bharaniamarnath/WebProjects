<?php
	$param['title'] = $title;
	$param['description'] = $description;
	$param['keywords'] = $keywords;
	$param['copyright'] = $copyright;
	$param['current'] = $current;
	$param['error'] = $error;
	$this->load->view('templates/mdo_view_header',$param);
	$this->load->view('templates/mdo_view_navbar',$param);
	$this->load->view('pages/mdo_view_career',$param['error']);
	$this->load->view('templates/mdo_view_footbar',$param);
	$this->load->view('pagescripts/mdo_script_main');
	$this->load->view('pagescripts/mdo_script_career');
	$this->load->view('templates/mdo_view_footer');
?>