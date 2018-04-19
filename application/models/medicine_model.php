<?php
class Medicine_model extends CI_Model {
	
	private $tbl_user= 'tbl_medicines';
	
	function __construct(){
		parent::__construct();
	}

	function list_all(){
		$this->db->order_by('name','asc');
		return $this->db->get('tbl_medicines');
	}

	function get_list(){
		$this->db->order_by('tbl_medicines.name','asc');
		$this->db->select('tbl_medicines.*, tbl_medicines.name as name , tbl_medicine_category.name as category');
        $this->db->join('tbl_medicine_category', 'tbl_medicine_category.category_id = tbl_medicines.category', 'left');
		return $this->db->get('tbl_medicines');
	}

	function get_category_list(){
		$this->db->order_by('name','asc');
		return $this->db->get('tbl_medicine_category');
	}


	function get_by_id($id){
		$this->db->where('medicine_id', $id);
		return $this->db->get('tbl_medicines');
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_user);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_user, $limit, $offset);
	}
	
	function save($user){
		$this->db->insert('tbl_medicines', $user);
		return $this->db->insert_id();
	}
	
	function update($id, $user){
		$this->db->where('medicine_id', $id);
		return $this->db->update($this->tbl_user, $user);
	}
	
	function delete_update($id, $user){//set deleted status as 0
		$this->db->where('company_id', $id);
		$this->db->update('tbl_medicines', $user);
	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_user);
	}

	function save_medicine_category($data){
		$this->db->insert('tbl_medicine_category', $data);
		return $this->db->insert_id();
	}

	function update_medicine_category($id, $data){
		$this->db->where('category_id', $id);
		$this->db->update('tbl_medicine_category', $data);
	}
}
?>