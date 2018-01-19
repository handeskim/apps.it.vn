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
			$sql = "SELECT * FROM notification WHERE staff = 2 AND `status` = 1 AND authorities = 1";
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
		$temp = '<ul class="dropdown-menu">
              <li class="header">bạn có '.$total_notifications.' Thông báo</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>';
		echo $temp;
		}
	
}
?>