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
			$this->authorities = $this->user_data['authorities'];
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
				$ofset = $limit * 50;
				if($params["finds"]==1){
					if($this->authorities ==1 || $this->authorities ==2 || $this->authorities ==4){
						if($this->authorities ==4){
								$sql = "SELECT * FROM customer 
							WHERE supervisor = '$staff' 
							AND full_name LIKE '%$keyword%'
							OR  code LIKE '%$keyword%'
							OR  email LIKE '%$keyword%'
							OR  dia_chi LIKE '%$keyword%'
							OR  dien_thoai LIKE '%$keyword%'
							OR  dien_thoai_2 LIKE '%$keyword%'
							OR  passport_id LIKE '%$keyword%'
							LIMIT $ofset,50
							";
							return $this->GlobalMD->query_global($sql);
						}
						if($this->authorities ==1 || $this->authorities ==2){
							$sql = "SELECT * FROM customer 
							WHERE  full_name LIKE '%$keyword%'
							OR  code LIKE '%$keyword%'
							OR  email LIKE '%$keyword%'
							OR  dia_chi LIKE '%$keyword%'
							OR  dien_thoai LIKE '%$keyword%'
							OR  dien_thoai_2 LIKE '%$keyword%'
							OR  passport_id LIKE '%$keyword%'
							LIMIT $ofset,50
							";
							return $this->GlobalMD->query_global($sql);
						}
					
					}
				}
				if($params["finds"]==2){
					if($this->authorities !=4 ){
						$sql = "
							SELECT o.*,
							s.id as staff_id,
							s.code as staff_code,
							s.email as staff_email,
							tp.name_oders as orders_status,
							s.full_name as staff_fullname
							FROM orders o
							INNER JOIN staff s ON o.code_staff = s.id
							INNER JOIN type_oders tp ON o.type_orders = tp.id
							WHERE o.code_orders LIKE '%$keyword%'
							OR o.code_customner LIKE '%$keyword%'
							OR o.full_name LIKE '%$keyword%'
							OR  o.dien_thoai LIKE '%$keyword%'
							OR  o.email LIKE '%$keyword%'
							OR  o.dia_chi LIKE '%$keyword%'
							GROUP BY o.code_orders
							ORDER BY o.id DESC
							LIMIT $ofset,50
						";	
						return $this->GlobalMD->query_global($sql);
					}else{
						$sql = "SELECT o.*,
							s.id as staff_id,
							s.code as staff_code,
							s.email as staff_email,
							tp.name_oders as orders_status,
							s.full_name as staff_fullname
							FROM orders o
							INNER JOIN staff s ON o.code_staff = s.id
							INNER JOIN type_oders tp ON o.type_orders = tp.id
							WHERE s.id = '$staff'
							AND code_orders LIKE '%$keyword%'
							OR o.code_customner LIKE '%$keyword%'
							OR o.full_name LIKE '%$keyword%'
							OR  o.dien_thoai LIKE '%$keyword%'
							OR  o.email LIKE '%$keyword%'
							OR  o.dia_chi LIKE '%$keyword%'
							GROUP BY o.code_orders
							ORDER BY o.id DESC
							LIMIT $ofset,50
						";	
						return $this->GlobalMD->query_global($sql);
					}
					
				}
				if($params["finds"]==3){
					$sql = "SELECT * FROM scheduling_callback 
						WHERE code_staff = '$staff' 
						AND code_customer LIKE '%$keyword%'
						AND `status` = 1
						ORDER BY id DESC
						LIMIT $ofset,50
					";
				}
			
	}
	
	private function SQLQueryDateRangerLike($params,$limit){
		$ofset = $limit * 1000;
		$date_ranger = explode(" / ", $params['date_search']);
		$date_start = $date_ranger[0];
		$date_end = $date_ranger[1];
		$staff =   $this->staff;
		$keyword =  $params["q"]; 
		if($this->authorities ==4 ){
			$sql = "SELECT 
				o.code_orders as orders_code,
				p.code_products as order_code_products,
				p.name_products as order_products,
				o.quantily as orders_quantily,
				o.price as orders_price,
				o.total_price as orders_total_price,
				o.discounts as orders_discounts,
				o.date_order as orders_date_buy,
				o.date_confim as orders_date_confim,
				o.date_send as orders_date_send,
				tp.name_oders as orders_status,
				o.code_customner as code_customner,
				o.email as orders_email,
				o.full_name as orders_fullname,
				o.dia_chi as orders_addr,
				o.dien_thoai as orders_phone,
				s.`code` as staff_code,
				s.email as staff_email,
				s.full_name as staff_fullname
				FROM orders o
				INNER JOIN staff s ON o.code_staff = s.id
				INNER JOIN type_oders tp ON o.type_orders = tp.id
				INNER JOIN products p ON o.code_products = p.id
				WHERE o.date_order BETWEEN '$date_start' AND '$date_end'
				AND o.code_staff = '$staff' 
				AND o.code_orders LIKE '%$keyword%' 
				OR o.code_customner LIKE '%$keyword%' 
				OR o.full_name LIKE '%$keyword%' 
				OR o.dien_thoai LIKE '%$keyword%' 
				OR o.email LIKE '%$keyword%'
				ORDER BY o.id DESC 
			";
			return $sql;
			// return $this->GlobalMD->query_global($sql);
		}
		if($this->authorities !=4 ){
			$sql = "SELECT 
				o.code_orders as orders_code,
				p.code_products as order_code_products,
				p.name_products as order_products,
				o.quantily as orders_quantily,
				o.price as orders_price,
				o.total_price as orders_total_price,
				o.discounts as orders_discounts,
				o.date_order as orders_date_buy,
				o.date_confim as orders_date_confim,
				o.date_send as orders_date_send,
				tp.name_oders as orders_status,
				o.code_customner as code_customner,
				o.email as orders_email,
				o.full_name as orders_fullname,
				o.dia_chi as orders_addr,
				o.dien_thoai as orders_phone,
				s.`code` as staff_code,
				s.email as staff_email,
				s.full_name as staff_fullname
				
				FROM orders o
				INNER JOIN staff s ON o.code_staff = s.id
				INNER JOIN type_oders tp ON o.type_orders = tp.id
				INNER JOIN products p ON o.code_products = p.id
				WHERE o.date_order BETWEEN '$date_start' AND '$date_end'
				AND o.code_orders LIKE '%$keyword%' 
				OR o.code_customner LIKE '%$keyword%' 
				OR o.full_name LIKE '%$keyword%' 
				OR o.dien_thoai LIKE '%$keyword%' 
				OR o.email LIKE '%$keyword%' 
				ORDER BY o.id DESC
			";
			return $sql;
			// return $this->GlobalMD->query_global($sql);
		}
		
	}
	private function QueryDateRangerLike($params,$limit){
		$ofset = $limit * 1000;
		$date_ranger = explode(" / ", $params['date_search']);
		$date_start = $date_ranger[0];
		$date_end = $date_ranger[1];
		$staff =   $this->staff;
		$keyword =  $params["q"]; 
		if($this->authorities ==4 ){
			$sql = "SELECT o.*,
				s.`code` as staff_code,
				s.email as staff_email,
				tp.name_oders as orders_status,
				s.full_name as staff_fullname
				FROM orders o
				INNER JOIN staff s ON o.code_staff = s.id
				INNER JOIN type_oders tp ON o.type_orders = tp.id
				WHERE o.date_order BETWEEN '$date_start' AND '$date_end'
				AND o.code_staff = '$staff' 
				AND o.code_orders LIKE '%$keyword%' 
				OR o.code_customner LIKE '%$keyword%' 
				OR o.full_name LIKE '%$keyword%' 
				OR o.dien_thoai LIKE '%$keyword%' 
				OR o.email LIKE '%$keyword%' 
				GROUP BY o.code_orders 
				ORDER BY o.id DESC LIMIT $ofset,1000
			";
			// return $sql;
			return $this->GlobalMD->query_global($sql);
		}
		if($this->authorities !=4 ){
			$sql = "SELECT o.*,
				s.`code` as staff_code,
				s.email as staff_email,
				tp.name_oders as orders_status,
				s.full_name as staff_fullname
				
				FROM orders o
				INNER JOIN staff s ON o.code_staff = s.id
				INNER JOIN type_oders tp ON o.type_orders = tp.id
				WHERE o.date_order BETWEEN '$date_start' AND '$date_end'
				AND o.code_orders LIKE '%$keyword%' 
				OR o.code_customner LIKE '%$keyword%' 
				OR o.full_name LIKE '%$keyword%' 
				OR o.dien_thoai LIKE '%$keyword%' 
				OR o.email LIKE '%$keyword%' 
				GROUP BY o.code_orders 
				ORDER BY o.id DESC LIMIT $ofset,1000
			";
		
			return $this->GlobalMD->query_global($sql);
		}
		
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
							$limit = $params['limit']+50;
						}
					}else{
						$limit= 0;
					}
					$keyword =  $params["q"];
					$finds =  $params["finds"];
					$search =  $params["search"];
					$data = $this->QueryLike($params,$limit);
					$reponse = array(
						'finds' => 	$params["finds"],
						'q' => $params['q'],
						'search' => $params['search'],
						'limit' => (int)$limit,
						'results' => $data,
					);
					
					echo json_encode($reponse, true);
				}
				if($params['search']==2){
					if(isset($params['date_search'])){
						if(!empty($params['date_search'])){
							if(isset($params['limit'])){
								if($params['limit'] < 0){
									$limit= 0;
								}else{
									$limit = $params['limit'];
								}
							}else{
								$limit= 0;
							}
							$date_ranger = explode(" / ", $params['date_search']);
							$keyword =  $params["q"];
							$search =  $params["search"];
							$data = $this->QueryDateRangerLike($params,$limit);
							$sql_download = $this->SQLQueryDateRangerLike($params,$limit);
							$reponse = array(
								'date_ranger' => $params['date_search'],
								'q' => $params['q'],
								'search' =>$params["search"],
								'limit' => (int)$limit,
								'results' => $data,
								'code' => core_encode($sql_download),
							);
							echo json_encode($reponse, true);
							// var_dump($reponse);
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