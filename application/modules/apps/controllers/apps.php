<?php
class Apps extends MY_Controller{
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
		$msg ='';
		$data = array(
			'msg' => $msg,
			'user_data' => $this->user_data,
			'title'=> 'Dashboard',
			'title_main' => 'Dashboard',
			'excel_customer_command' => $this->excel_customer_command(),
			'total_customer' => $this->total_customer(),
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		// if($this->permisson ==4){
			$this->parser->parse('dashboard_authorities_4',$data);
		// }
		
		$this->parser->parse('default/footer',$data);
	}
	private function QueryLike($params,$limit){
				$staff =   $this->staff;
				$keyword =  $params["q"]; 
				if($params["finds"]==1){
					$sql = "SELECT * FROM customer 
						WHERE full_name LIKE '%$keyword%'
						OR  code LIKE '%$keyword%'
						OR  email LIKE '%$keyword%'
						OR  dia_chi LIKE '%$keyword%'
						OR  dien_thoai LIKE '%$keyword%'
						OR  dien_thoai_2 LIKE '%$keyword%'
						OR  passport_id LIKE '%$keyword%'
						AND supervisor = '$staff'
						LIMIT $limit,50
					";
				}
				if($params["finds"]==2){
					$sql = "SELECT * FROM orders 
						WHERE code_orders LIKE '%$keyword%'
						OR code_customner LIKE '%$keyword%'
						OR full_name LIKE '%$keyword%'
						OR  dien_thoai LIKE '%$keyword%'
						OR  email LIKE '%$keyword%'
						OR  dia_chi LIKE '%$keyword%'
						AND code_staff = '$staff'
						GROUP BY code_orders
						ORDER BY id DESC
						LIMIT $limit,50
					";
				}
				if($params["finds"]==3){
					$sql = "SELECT * FROM scheduling_callback 
						WHERE code_customer LIKE '%$keyword%'
						AND code_staff = '$staff'
						AND `status` = 1
						ORDER BY id DESC
						LIMIT $limit,50
					";
				}
			return $this->GlobalMD->query_global($sql);
	}
	public function search(){
		$params = $_GET;
		if(isset($params)){
			if(isset($params['search'])){
				if($params['search']==1){
					if(isset($params['limit'])){
						if($params['limit'] < 0){
							$limit= 0;
						}else{
							$limit = $params['limit'];
						}
					}else{
						$limit= 0;
					}
					$keyword =  $params["q"];
					$finds =  $params["finds"];
					$data = $this->QueryLike($params,$limit);
					$reponse = array(
						'finds' => (int)$finds,
						'limit' => (int)$limit,
						'results' => $data,
					);
					echo json_encode($reponse, true);
				}
				if($params['search']==2){
					if(isset($params['date_search'])){
						if(!empty($params['date_search'])){
							$date_ranger = explode(" / ", $params['date_search']);
							var_dump($date_ranger);
						}
					}
				}
			}
		}
		
	}
	private function excel_customer_command(){
		$user = $this->staff;
		if($this->permisson == 1 || $this->permisson == 2 ){
			$sql = "SELECT 
			c.code,
			c.full_name,
			c.email,
			c.ngay_sinh,
			c.dia_chi,
			c.dien_thoai,
			c.dien_thoai_2,
			c.passport_id,
			c.note,
			s.full_name as name_staff, s.email as account_staff FROM customer c
			INNER JOIN staff s ON s.id = c.supervisor";
		}else{
			$sql = "SELECT 
			c.code,
			c.full_name,
			c.email,
			c.ngay_sinh,
			c.dia_chi,
			c.dien_thoai,
			c.dien_thoai_2,
			c.passport_id,
			c.note,
			s.full_name as name_staff, s.email as account_staff FROM customer c
			INNER JOIN staff s ON s.id = c.supervisor WHERE supervisor =  '$user' ";
		}
		return core_encode($sql);
	}
	private function total_customer(){
		$user = $this->staff;
		try { 
			if($this->permisson == 1 || $this->permisson == 2 || $this->permisson == 3 || $this->permisson == 5){
				$sql ="SELECT count(id) as total FROM customer";
			}else{
				$sql ="SELECT count(id) as total FROM customer WHERE supervisor =  '$user' ";
			}
			$reponse = $this->GlobalMD->query_global($sql);
			$result = $reponse[0]['total'];
		}catch (Exception $e) {
			$result = 0;
		}
		return $result;
	}

	
	
}
?>