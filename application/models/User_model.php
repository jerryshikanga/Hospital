 <?php
class User_model extends CI_Model {
	//Doctor - 2, users - 1, lab - 3, nurse - 4
	private $tbl_user= 'tbl_users';
	
	function __construct(){
		parent::__construct();
	}

	function list_all(){
		$this->db->order_by('tbl_users.name','asc');
		$this->db->select('tbl_users.username, tbl_users.user_id, tbl_users.name, tbl_users.role_id, tbl_roles.name as role_name, tbl_users.date_created, tbl_users.last_login, tbl_users.active');
        $this->db->join('tbl_roles', 'tbl_roles.role_id=tbl_users.role_id');
		return $this->db->get('tbl_users');
	}

	function get_list(){
		$this->db->order_by('name','asc');
		return $this->db->get('tbl_users');	
	}

	function get_list_active_doctors(){
		$this->db->order_by('tbl_users.name','asc');
		$this->db->select('tbl_users.*');
        $this->db->where('role_id', 2); //
		return $this->db->get('tbl_users');
	}

	function get_list_active_lab_tech(){
		$this->db->order_by('tbl_users.name','asc');
		$this->db->select('tbl_users.*');
        $this->db->where('role_id', 4); //
		return $this->db->get('tbl_users');
	}

	function get_list_active_nurses(){
		$this->db->order_by('tbl_users.name','asc');
		$this->db->select('tbl_users.username, tbl_users.user_id, tbl_users.name, tbl_users.role_id, tbl_roles.name as role_name, tbl_users.date_created, tbl_users.last_login, tbl_users.active');
        $this->db->where('tbl_users.role_id', 3); //
        $this->db->join('tbl_roles', 'tbl_roles.role_id=tbl_users.role_id');
		return $this->db->get('tbl_users');
	}

	function count_all(){
		return $this->db->count_all($this->tbl_user);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_user, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->select('tbl_users.username, tbl_users.user_id, tbl_users.name, tbl_users.role_id, tbl_roles.name as role_name');
		$this->db->where('user_id', $id);
		$this->db->join('tbl_roles', 'tbl_roles.role_id=tbl_users.role_id');
		return $this->db->get('tbl_users')->row();
	}
	
	function save($user){
		$user['password'] = MD5($user['password']);
		$this->db->insert($this->tbl_user, $user);
		return $this->db->insert_id();
	}
	
	function update($id, $user){
		$user['password'] = MD5($user['password']);
		$this->db->where('user_id', $id);
		$this->db->update($this->tbl_user, $user);
	}
	
	function delete_update($id, $user){//set deleted status as 0
		$this->db->where('user_id', $id);
		$this->db->update('tbl_users', $user);
	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_user);
	}

	function active($username, $password)
	{
		$this -> db -> from('tbl_users');
		$this -> db -> where('user_id', $username);
		$this -> db -> where('a = ' . "'" . MD5($password) . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
	
	function login($username, $password)
	{
		$this -> db -> select('tbl_users.user_id as user_id, username, password, name, role_id, active');
		$this -> db -> from('tbl_users');
		$this -> db -> where('username', $username);
		$this -> db -> where('password = ' . "'" . MD5($password) . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$this->updateLastLogin($username, $password);
			return $query->result();
		}
		else
		{
			return false;
		}

	}

	function updateLastLogin($username, $password){
		$this->load->helper('my_date_helper');
		$data['last_login'] = getCurrentDateTime();
		$this->db->set($data);
		$this->db->where('username', $username);
		$this->db->where('password = ' . "'" . MD5($password) . "'");
		$this->db->update('tbl_users');
	}

	function userNameExists($username){
		$this->db->select('tbl_users.username, tbl_users.name');
		$this->db->where('username', $username);
		$this->db->from('tbl_users');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

	function get_user_roles(){
		$this->db->select('tbl_roles.role_id, tbl_roles.name, tbl_roles.description');
		$this->db->order_by('tbl_roles.name');
		$this->db->from('tbl_roles');
		return $this->db->get()->result_array();
	}

	function addDoctor($user_id){
		$data['user_id'] = $user_id;
		$this->db->insert('tbl_doctors', $data);
	}

	function addNurse($user_id){
		$data['user_id'] = $user_id;
		$this->db->insert('tbl_nurses', $data);
	}

	function addLabTechnician($user_id){
		$data['user_id'] = $user_id;
		$this->db->insert('tbl_lab_techs', $data);
	}

	function addPharmacist($user_id){
		$data['user_id'] = $user_id;
		$this->db->insert('tbl_pharmacists', $data);
	}
}
?>