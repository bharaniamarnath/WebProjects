<?php
Class Products_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_products($slug = false){
		if($slug === false){
			$categories = array();
			$this->db->order_by('pname','ASC');
			foreach ($this->db->get_where('products')->result_array() as $row) {
				$categories[$row['pcategory']][] = $row; //group rows by country
			}
			return $categories;
		}
		$query = $this->db->get_where('products',array('pid'=>$slug));
		return $query->row_array();
	}
	
	public function product_list(){
		$this->db->order_by('pname','ASC');
		$query = $this->db->get('products');
		return $query->result_array();
	}
	
	public function product_data($pid){
		$query = $this->db->get_where('products',array('pid'=>$pid));
		return $query->row_array();
	}
	
	public function get_gallery($pid){
		$query = $this->db->get_where('gallery',array('pid'=>$pid));
		return $query->result_array();
	}
	
	public function gallery_data($imgid){
		$query = $this->db->get_where('gallery',array('imageid'=>$imgid));
		return $query->row_array();
	}
	
	public function del_gallery($imgid){
		$this->db->where('imageid',$imgid);
		if($this->db->delete('gallery')){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function delete_product($id){
		// Gallery Delete
		foreach($this->db->get_where('gallery',array('pid'=>$id))->result_array() as $row){
			$gallery_link = './uploads/'.$row['link'];
			if(file_exists($gallery_link)){
				unlink($gallery_link);
			}
		}
		$this->db->where('pid',$id);
		$gallery_delete = $this->db->delete('gallery');
		
		// Product Delete
		$get_product = $this->db->get_where('products',array('pid'=>$id));
		$product_data = $get_product->row_array();
		$image_link = './uploads/'.$product_data['pimage'];
		if(file_exists($image_link)){
			unlink($image_link);
		}
		$this->db->where('pid',$id);
		$product_delete = $this->db->delete('products');
		
		if($gallery_delete && $product_delete == true){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function insert_product($id,$name,$category,$type,$combination,$description,$indications,$imagepath){
		$data = array(
				'pid'=>$id,
				'pname'=>$name,
				'pcategory'=>$category,
				'ptype'=>$type,
				'pcombination'=>$combination,
				'pdescription'=>$description,
				'pindication'=>$indications,
				'pimage'=>$imagepath
				);
		if($this->db->insert('products',$data) == true){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_product($id,$name,$category,$type,$combination,$description,$indications){
		$data = array(
				'pname'=>$name,
				'pcategory'=>$category,
				'ptype'=>$type,
				'pcombination'=>$combination,
				'pdescription'=>$description,
				'pindication'=>$indications
				);
		$this->db->where('pid', $id);
		if($this->db->update('products',$data) == true){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function insert_gallery($id,$pid,$imagepath){
		$data = array(
				'imageid'=>$id,
				'pid'=>$pid,
				'link'=>$imagepath
				);
		if($this->db->insert('gallery',$data) == true){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
}
?>