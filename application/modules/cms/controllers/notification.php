<?php
class Notification extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->permisson = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
		}else{
			redirect(base_url('sign'));
		}
		
	}
	public function index(){
		
		echo "hello";
		// $msg ='';
		// $data = array(
			// 'msg' => $msg,
			// 'content' => $this->staffs(),
			// 'user_data' => $this->user_data,
			// 'title'=> 'Staff Management',
			// 'title_main' => 'Staff Management',
		// );
		// $this->parser->parse('default/header',$data);
		// $this->parser->parse('default/sidebar',$data);
		// $this->parser->parse('default/main',$data);
		// $this->parser->parse('default/layout/main_curd_account',$data);
		// $this->parser->parse('default/footer',$data);
	}
	
}
?>