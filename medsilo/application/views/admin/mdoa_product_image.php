<?php
	$param['title'] = $title;
	$param['description'] = $description;
	$param['keywords'] = $keywords;
	$param['copyright'] = $copyright;
	$param['current'] = $current;
	$param['image_data'] = $image_data;
	$this->load->view('admin/templates/mdoa_view_header',$param);
	$this->load->view('admin/templates/mdoa_view_navbar',$param);
	$this->load->view('admin/pages/mdoa_view_product_image',$param);
	$this->load->view('admin/templates/mdoa_view_footbar',$param);
	$this->load->view('admin/pagescripts/mdoa_script_main');
	$this->load->view('admin/pagescripts/mdoa_script_product_image');
	$this->load->view('admin/templates/mdoa_view_footer');
?>