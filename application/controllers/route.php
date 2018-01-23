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
	public function test(){
		echo $_SERVER['PHP_SELF'];
	}
	public function tracking(){
		$key = $this->input->get('key');
		$cmd = $this->input->get('posts');
		$links ='';
		if($cmd=1){
			$links =  'http://www.vnpost.vn/en-us/dinh-vi/buu-pham?key='.$key;
			 
		}else{
			$links = "https://www.viettelpost.com.vn/Tracking?KEY=".$key;
			
		}
		header('Location: '.$links);
		
	}
	public function packer(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Storage has confirm: '.$query,
				'status' => 1,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		
		if($UpdateNotifation==true){
			$data_Orders = array('type_orders' => 4,);
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}
	public function destroy_packer(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Storage has Reject: '.$query,
				'status' => 1,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		
		if($UpdateNotifation==true){
			$data_Orders = array('type_orders' => 8,);
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}	
	public function destroy_staff(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Sale has Reject: '.$query,
				'status' => 2,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		if($UpdateNotifation==true){
			$data_Orders = array('type_orders' => 6,);
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}	
	
	public function notify(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Storage has Sendding: '.$query,
				'status' => 2,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
			redirect(base_url('cms/oders_management'));
	}

	public function accountancy(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Finance has confirm: '.$query,
				'status' => 1,
				'authorities' => 5,
			);
		$this->db->where('links', $query);
	
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		
		if($UpdateNotifation==true){
			$data_Orders = array('type_orders' => 3,);
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}	
	
	public function destroy_accounts(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Finance has Reject: '.$query,
				'status' => 1,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
	
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		
		if($UpdateNotifation==true){
			$data_Orders = array('type_orders' => 7,);
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}
	
	

	
	
}
?>