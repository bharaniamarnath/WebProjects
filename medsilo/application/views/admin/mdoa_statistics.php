<?php
	$param['title'] = $title;
	$param['description'] = $description;
	$param['keywords'] = $keywords;
	$param['copyright'] = $copyright;
	$param['current'] = $current;
	$param['products_data'] = $products_data;
	$param['categories_data'] = $categories_data;
	$this->load->view('admin/templates/mdoa_view_header',$param);
	$this->load->view('admin/templates/mdoa_view_navbar',$param);
	$this->load->view('admin/pages/mdoa_view_statistics',$param);
	$this->load->view('admin/templates/mdoa_view_footbar',$param);
	$this->load->view('admin/pagescripts/mdoa_script_main');
	$this->load->view('admin/templates/mdoa_view_footer');
?>