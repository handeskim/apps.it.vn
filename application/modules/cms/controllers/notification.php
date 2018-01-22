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
			if($authorities == 1 || $authorities ==2){
				$sql = "SELECT * FROM notification WHERE `status` = 1 ";
			}
			if($authorities == 3 || $authorities == 5){
				$sql = "SELECT * FROM notification WHERE `status` = 1 AND authorities = '$authorities'";
			}
			if($authorities == 4){
				$sql = "SELECT * FROM notification WHERE staff = '$staff' AND `status` = 1 AND authorities = '$authorities'";
			}
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
		$temp = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
		if($total_notifications==0){
			$temp .= '<i style="color: #00a65a;font-size: 18px;" class="fa fa-bell-o"></i>';
		}else{
			$temp .= '<i style="color: #ed3237;font-size: 18px;" class="fa fa-bell-o"></i><span class="label label-warning">'.$total_notifications.'</span>';
		}
		
        $temp .= '</a>
		<ul class="dropdown-menu"><li class="header">Bạn có '.$total_notifications.' Thông báo</li><li><ul class="menu">';
		if(!empty($data)){
			foreach($data as $value){
				$authorities = $value['authorities'];
				if($authorities==3){
					$fa_icon = "fa-shopping-cart";
				}else if($authorities==4){
					$fa_icon = "fa-file";
				}else if($authorities==5){
					$fa_icon = "fa-cube";
				}else{
					$fa_icon = "fa-bullhorn";
				}
				if($value['authorities']==3){
					$temp .= '<li><a href="'.base_url().'route/accountancy?query='.$value['links'].'"><i class="fa '.$fa_icon.' text-aqua"></i> '.$value['title'].' </a></li>';
				}else if($value['authorities']==5){
					$temp .= '<li><a href="'.base_url().'route/packer?query='.$value['links'].'"><i class="fa '.$fa_icon.' text-aqua"></i> '.$value['title'].' </a></li>';
				}
				
			}
		}
        $temp .= '</ul></li></ul>';
		echo $temp;
		}
	
}
?>