<?php
class Apps extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		if(isset($this->login)){
			if(!empty($this->login)){
				$this->user_data = $this->session->userdata('data_users');
				$this->permisson = $this->user_data['authorities'];
				$id_clients = $this->user_data['id'];
			}else{
				redirect(base_url('sign'));
			}
		}else{
			redirect(base_url('sign'));
		}
			
		
		
	}
	

	public function index(){
		$msg ='';
		$data = array(
			'msg' => $msg,
			'user_data' => $this->user_data,
			'title'=> 'Dashboard',
			'title_main' => 'Dashboard',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/footer',$data);
	}
	

	
	
}
?>