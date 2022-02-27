<?php
	$param['title'] = $title;
	$param['description'] = $description;
	$param['keywords'] = $keywords;
	$param['copyright'] = $copyright;
	$param['current'] = $current;
	$param['products'] = $products;
	$this->load->view('templates/mdo_view_header',$param);
	$this->load->view('templates/mdo_view_navbar',$param);
	$this->load->view('products/mdo_view_products',$param);
	$this->load->view('templates/mdo_view_footbar',$param);
	$this->load->view('pagescripts/mdo_script_main');
	$this->load->view('pagescripts/mdo_script_products');
	$this->load->view('templates/mdo_view_footer');
?>