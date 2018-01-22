<?php
class Route extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->authorities = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
		}else{
			redirect(base_url('sign'));
		}
	
		
	}
	

	public function index(){
		$query = $this->input->get('query');
		$data = array(
               'status' => 2,
            );

		$this->db->where('id', $query);
		$Update = $this->db->update('notification', $data); 
		if($Update==true){
			redirect(base_url('cms/oders_Management'));
		}
	}
	
	

	
	
}
?>