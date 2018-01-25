<?php
class Marketing extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		$this->load->library('excel');
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->authorities = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
			$this->sendmail = $this->user_data['sendmail'];
		}else{
			redirect(base_url('sign'));
		}
		
	}
	private function validate_email($email){
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		if (preg_match($regex, $email)) {
			return true;
		} else { 
			return false;
		}  
	}
	public function email_manager(){
		if($this->authorities == 5 || $this->authorities == 3){
			redirect(base_url('apps'));
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->LoadEmailManager(),
			'user_data' => $this->user_data,
			'title'=> 'Partners Post',
			'title_main' => 'Partners Post',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_account',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function LoadEmailManager(){
		$staff = $this->staff;
		if($this->authorities == 1 || $this->authorities == 2 || $this->authorities == 4){
			if($this->sendmail==1){
				$xcrud = Xcrud::get_instance();
				$xcrud->table('email_sending');
				$xcrud->unset_csv();
				$xcrud->validation_pattern('email', 'email');
				$xcrud->validation_required('staff');
				$xcrud->validation_required('status');
				$xcrud->validation_required('title');
				$xcrud->validation_required('content');
				$xcrud->validation_required('email');
				if($this->authorities == 4){
					$xcrud->where('staff',$staff);
				}
				$xcrud->table_name('[MPP] - Quản lý danh sách gửi email');
				if($this->authorities == 4){
					$xcrud->relation('staff','staff','id','code','id='.$staff);
				}else{
					$xcrud->relation('staff','staff','id','code');
				}
				$xcrud->relation('status','status_email','id','name_status');
				$response = $xcrud->render();
				return $response;
			}else{
				return error_authorities();
			}
		}else{
			return error_authorities();
		}
	}
	public function email(){
		$msg ='';
		if($this->authorities == 5 || $this->authorities == 3){
			redirect(base_url('apps'));
		}else{
			if($this->sendmail==0){
				$msg ='cấm quyền truy cập';
			}
			$cmd = $this->input->post('cmd');
			if($cmd == 'c1'){
				$ArrayConvert = $this->FileUpload();
				$ParmaPOST = $_POST;
				foreach($ArrayConvert as $email){
					$Check =  $this->validate_email($email);
					if($Check==true){
						$params = array(
							'staff' => $this->staff,
							'title' => $ParmaPOST['title_email'],
							'content' => $ParmaPOST['contentEmail'],
							'email' => $email,
							'status' => 1,
						);
						$install = $this->db->insert('email_sending',$params);
						if($install==true){
							$msg = '<div class="callout callout-success"><h4>Cài đặt thành công!</h4><p>Vui lòng thoát ra không tải lại trang.</p></div>';
						}
					}
				}
				
				
			}
			$data = array(
				'msg' => $msg,
				'user_data' => $this->user_data,
				'title'=> 'Marketing Email',
				'title_main' => 'Marketing Email',
				'error' => '',
			);
			$this->parser->parse('default/header',$data);
			$this->parser->parse('default/sidebar',$data);
			$this->parser->parse('default/main',$data);
			if($this->sendmail==1){
				$this->parser->parse('default/layout/Marketing_email',$data);
			}
			$this->parser->parse('default/footer',$data);
		}
		
	}
	public function sms(){
		$msg ='';
		if($this->authorities == 5 || $this->authorities == 3){
			redirect(base_url('apps'));
		}else{
			if($this->sendmail==0){
				$msg ='cấm quyền truy cập';
			}
			$data = array(
				'msg' => $msg,
				'user_data' => $this->user_data,
				'title'=> 'Marketing Email',
				'title_main' => 'Marketing Email',
				'error' => '',
			);
			$this->parser->parse('default/header',$data);
			$this->parser->parse('default/sidebar',$data);
			$this->parser->parse('default/main',$data);
			if($this->sendmail==1){
				$this->parser->parse('default/layout/Marketing_sms',$data);
			}
			$this->parser->parse('default/footer',$data);
		}
		
	}
	
	private function FileUpload(){
		$outoutArr = array();
		if($_FILES['file']['tmp_name'] != "" && $_FILES['file']['type'] == "text/plain"){
			$uploaded_file = $_FILES['file']['tmp_name'];
			$file_open = fopen($uploaded_file, 'r');
			$file_read = fread($file_open,filesize($uploaded_file));
			fclose($file_open);
			$newline_ele = "\n";
			$data_split = explode($newline_ele, str_replace("\r", "", $file_read));
			$new_tab = "\t";
			$outoutArr = array();
			foreach ($data_split as $string)
			{
				$row = explode($new_tab, $string);
				if(isset($row['0']) && $row['0'] != ""){
					$outoutArr[] = trim($row['0']);
				}
			}
		}
		return array_filter($outoutArr);
	}
	
	
	
	
}
?>