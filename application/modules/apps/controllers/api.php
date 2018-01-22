<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Api extends REST_Controller {
	function __construct(){
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
		$this->staff = 0;
		$this->login = $this->session->userdata('auth_sign');
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->permisson = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
		}
		
	}
	public function search_product_item_get(){
		$response = array('result' => null);
		$resuls = null;
		$code_products = $this->input->get_post('code_products');
		$pepments = $this->input->get_post('name_pepr');
		if(isset($code_products) || !empty($code_products)){
			if($pepments==1){
				$sql = "SELECT id,code_products,name_products,label_products,quantily,price,images  FROM products WHERE `code_products` = '$code_products'";
				$resuls = $this->QueryCoreAll($sql);
				if(!empty($resuls)){
					$response = array('result' => $resuls);
				}else{
					$response = array('result' => null);
				}
			}
			if($pepments==2){
				$sql = "SELECT id,code_products,name_products,label_products,quantily,price,images  FROM products WHERE `name_products` = '$code_products'";	
				$resuls = $this->QueryCoreAll($sql);
				if(!empty($resuls)){
					$response = array('result' => $resuls);
				}else{
					$response = array('result' => null);
				}
				
			}
			if($pepments==3){
				$sql = "SELECT id,code_products,name_products,label_products,quantily,price,images  FROM products WHERE `label_products` = '$code_products'";
				$resuls = $this->QueryCoreAll($sql);
				if(!empty($resuls)){
					$response = array('result' => $resuls);
				}else{
					$response = array('result' => null);
				}
			}
		}
		$this->response($response);
	}
	private function QueryCoreAll($sql){
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		
	}
	public function notification_get(){
		$response = array('staff' => $this->staff);
		$this->response($response);
	}
}

class Appscore extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	public function QueryCoreClientScore($userid){
		
		$sql = "SELECT `score` FROM `users` WHERE `id` = $userid and `level` = 1 limit 1";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		
		
	}
	public function QueryCoreAll(){
		
		$sql = "SELECT `uid`,`phone` FROM `vnphone` LIMIT 100";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		
	}

	private function update_status_user($userid){
		
		$dataUpdate = array('status' => 2,);
		$this->db->where('id', $userid);
		$this->db->update('users', $dataUpdate); 
	}
	
	
	
	
///---End Class Apps---///
}	

?>