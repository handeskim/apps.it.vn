<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Api extends REST_Controller {
	function __construct(){
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
		$this->staff = 0;
		if(isset($this->session->userdata('data_users'))){
			if(!empty($this->session->userdata('data_users'))){
				$this->user_data = $this->session->userdata('data_users');
				$this->staff = $this->user_data['id'];
			}
		}
		
	}
	
	public function notification_get(){
		$staff = $this->user_data;
		$response = array('user_data' => $staff);
		
		$this->response($response);
	}
}

////------Start Class Core Apps-------////
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