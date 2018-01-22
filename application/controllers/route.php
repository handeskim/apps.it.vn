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
		$data_notifation = array('status' => 2,);
		
		$this->db->where('links', $query);
	
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		
		if($UpdateNotifation==true){
			$data_Orders = array('type_orders' => 3,);
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}
	
	

	
	
}
?>