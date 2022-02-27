<?php
	$param['title'] = $title;
	$param['description'] = $description;
	$param['keywords'] = $keywords;
	$param['copyright'] = $copyright;
	$param['current'] = $current;
	$param['list'] = $list;
	$this->load->view('admin/templates/mdoa_view_header',$param);
	$this->load->view('admin/templates/mdoa_view_navbar',$param);
	$this->load->view('admin/pages/mdoa_view_product_list',$param);
	$this->load->view('admin/templates/mdoa_view_footbar',$param);
	$this->load->view('admin/pagescripts/mdoa_script_main');
	$this->load->view('admin/pagescripts/mdoa_script_product_list');
	$this->load->view('admin/templates/mdoa_view_footer');
?>