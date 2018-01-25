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
	public function email(){
		
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
	public function upload_email()
	{	
			
			$config['upload_path'] = './public/email/'; 
			$config['allowed_types'] = 'xls|xlsx|csv';
			$config['max_size'] = '10000'; 
			$config['overwrite'] = true;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ( $this->upload->do_upload('filename') ){
			   $img = $this->upload->data();
			   $ext = $img['file_ext'];                            
			   $post['xlfile'] = time().$ext;
			} else {
				   var_dump($this->upload->data());
				   // exit();                            
				   // redirect('hr/hr/dashboard/');
			}
			// $file_path =  $_SERVER['DOCUMENT_ROOT'].'/public/email/email.xlsx';
		// $inputFileName = $file_path; 
		// $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		// $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		// $arrayCount = count($allDataInSheet); 
		// for($i=2;$i<=$arrayCount;$i++)
		 // {

			// echo $allDataInSheet[$i]["A"];
		// }
			// var_dump($file_data);
	}
	
	
	
}
?>