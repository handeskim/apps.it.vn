<?php
class Task extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('global_model', 'GlobalMD');	
	}
	
	public function sender_email(){
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$conf_email = $this->load_conf_email();
		$message = '';
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => $conf_email['smtp_host'],
			'smtp_port' => $conf_email['smtp_port'],
			'smtp_user' => $conf_email['smtp_user'],
			'smtp_pass' => $conf_email['smtp_pass'],
			'smtp_crypto' => $conf_email['smtp_crypto'],
		);
		$datasend = $this->load_data_email();
		if(!empty($datasend)){
			foreach($datasend as $value_send){
				$body = $value_send['content'];
				$email_from = $conf_email['mail_from'];
				$email_clients = $value_send['email'];
				$subject = $value_send['title'];
				$id = $value_send['id'];
				$this->email->from($email_from);
				$this->email->to($email_clients);
				$this->email->subject($subject);
				$this->email->message($body);
				if($this->email->send()==true){
					$status = 3;
					$this->update_sendmail($id,$status);
				}else{
					$status = 2;
					$this->update_sendmail($id,$status);
				}
			}
		}
	}
	private function sender_sms($content,$phone){
		$SendContent=urlencode($content);
		$conf = $this->load_conf_email();
		$APIKey=$conf['sms_key'];
		$SecretKey=$conf['sms_secret'];
		$data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$phone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&SmsType=4";
		$curl = curl_init($data); 
		curl_setopt($curl, CURLOPT_FAILONERROR, true); 
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($curl); 
		$obj = json_decode($result,true);
		if($obj['CodeResult']==100){
			return true;
		}else{
			return false;
		}
	}
	public function sms(){
		$datasend = $this->load_data_sms();
		$conf = $this->load_conf_email();
		foreach($datasend as $value_sms){
			$phone = $value_sms['phone'];
			$content = $value_sms['title'];
			$id = $value_sms['id'];
			$result = $this->sender_sms($content,$phone);
			if($result==true){
				$status = 3;
				$this->update_sendsms($id,$status);
			}else{
				$status = 2;
				$this->update_sendsms($id,$status);
			}
		}
		
	}
	private function load_conf_email(){
		$sql = "SELECT * FROM generic";
		$result = $this->GlobalMD->query_global($sql);
		return $result[0];
	}
	private function load_data_sms(){
		$sql = "SELECT * FROM `sms_sending` WHERE `status` = 1 LIMIT 0, 500 ";
		$result = $this->GlobalMD->query_global($sql);
		return $result;
	}
	private function update_sendsms($id,$status){
		$data = array(
               'status' => $status,
            );

		$this->db->where('id', $id);
		$this->db->update('sms_sending', $data); 
	}
	private function load_data_email(){
		$sql = "SELECT * FROM `email_sending` WHERE `status` = 1 LIMIT 0, 500 ";
		$result = $this->GlobalMD->query_global($sql);
		return $result;
	}
	private function update_sendmail($id,$status){
		$data = array(
               'status' => $status,
            );

		$this->db->where('id', $id);
		$this->db->update('email_sending', $data); 
	}
	
}
?>