<?php
class Notification extends MY_Controller{
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
	private function Notification(){
		$staff =  $this->staff ;
		$authorities =  $this->authorities;
		try{
			$sql = "SELECT * FROM notification WHERE staff = '$staff' AND `status` = 1 AND authorities = '$authorities'";
			return $this->GlobalMD->query_global($sql);
		}catch (Exception $e) {
			return false;
		}
	}
	public function index(){
		
		$this->temp_notifacation();
	}
	public function temp_notifacation(){
		$data = $this->Notification();
		$total_notifications = 0;
		if($data){
			$total_notifications = count($data);
		}
		$temp = '<ul class="dropdown-menu"><li class="header">bạn có '.$total_notifications.' Thông báo</li><li><ul class="menu">';
		if(!empty($data)){
			foreach($data as $value){
				$temp .= '<li><a href="'.$value['link'].'"><i class="fa fa-users text-aqua"></i> '.$value['title'].' </a></li>';
			}
		}
        $temp .= '</ul></li></ul>';
		echo $temp;
		}
	
}
?>