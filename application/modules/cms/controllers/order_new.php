<?php
class Order_new extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->permisson = $this->user_data['authorities'];
			$this->discounts = $this->user_data['discount'];
			$this->authorities = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
		}else{
			redirect(base_url('sign'));
		}
		
	}
	
	public function AddCart(){
		$id = $this->input->get('id');
		$sql = "SELECT p.id,p.code_products,p.name_products,p.label_products,p.quantily,p.price,g.name_generic_pharma  FROM products p 
		INNER JOIN generic_pharma g ON p.generic = g.id
		WHERE p.id = '$id'";
		$resuls = $this->GlobalMD->query_global($sql);
		$temp = "<tr>";
		foreach($resuls as $value){
			$pep = $value['id'];
			$temp .= '<td><input  type="hidden" name="product['.$pep.'][]" value="'.$value['id'].'" required/>';
			$temp .= $value['code_products'].'</td>';
			$temp .= '<td>'.$value['name_products'].'</td>';
			$temp .= '<td>'.$value['label_products'].'</td>';
			$temp .= '<td><input type="number" name="product['.$pep.'][]" value="'.$value['quantily'].'" required/></td>';
			$temp .= '<td>'.$value['price'].'/ 1 '.$value['name_generic_pharma'].'</td>';
		}
		$temp .= "</tr>";
		echo $temp;
	}
	private function InfoProduct($id){
		$sql = "SELECT * FROM products WHERE id = '$id'";
		$resuls = $this->GlobalMD->query_global($sql);
		return $resuls;
	}
	private function Notifacation($code_order){
		$title = 'Bạn có thông báo đơn hàng cần duyệt';
		$links = base_url().'cms/oders_Management';
		$order = array(
			'title' => $title,
			'staff' => $this->staff,
			'authorities'  => $this->authorities,
			'links'  => $code_order,
			'times'  => date('Y-m-d',time()),
			'status'  => 1,
		);
		$install = $this->db->insert('notification',$order);

	}
	public function update_quantily($quantily,$id){
		if($quantily < 0 ){
			$quantily_update = 0;
		}else{
			$quantily_update = $quantily;
		}
		$data = array(
			'quantily' => $quantily_update,
		 );

		$this->db->where('id', $id);
		$this->db->update('products', $data); 
	}
	public function index(){
		if($this->authorities == 3 || $this->authorities == 5){
			redirect(base_url('cms/oders_management'));
		}
		$cmd = $this->input->post('cmd');
		if(!empty($cmd)){
			$params = $_POST;
			$checkCode = $thiss->InfoProductCheckOrder($params['CodeOrder']);
			if($checkCode==true){
				
				if($params['NameCheckCustomer'] == 2){
					$code_customer = $this->setUpCustomer($params);
				}else{
					$code_customer = $params['CodeCustomer'];	
				}
				if($params['NameCheckCallBack'] ==1){
					$this->setUpcallback($params,$code_customer);
				}
				$this->db->trans_start();
				if(isset($params['discounts'])){
					$discounts = $params['discounts'];
				}else{
					$discounts = 0;
				}
				foreach($params ["product"] as $valueP){
					$code_products = $valueP[0];
					$infoP = $this->InfoProduct($code_products);
					$quantily = (int)$valueP[1];
					$quantily_old = (int)$infoP[0]['quantily'];
					$price = (int)$infoP[0]['price'];
					$total_price = (int)$quantily * (int)$price;
					$price_discounts = (($total_price * $discounts)/100);
					$total_pay = $total_price - $price_discounts;
					$quantily_update = $quantily_old-$quantily;
					$this->update_quantily($quantily_update,$code_products);
					$arrayOrder = array(
						'code_products' => $code_products,
						'code_orders' => $params['CodeOrder'],
						'type_post' => $params['NamePost'],
						'code_staff' => $this->staff,
						'code_customner' => $code_customer,
						'type_orders' => 2,
						'discounts' => $discounts,
						'quantily' => $quantily,
						'price' => $price,
						'total_price' => $total_pay,
						'manuals' => $params['manuals'],
						'note' => $params['note'],
					);
					$install = $this->db->insert('orders',$arrayOrder);
				}
				$this->db->trans_complete();
				if($install==true){
					$this->Notifacation($params['CodeOrder']);
					redirect(base_url('cms/oders_management'));
					$msg = "Tạo đơn hàng thành công";
				}else{
					$msg = "Tạo đơn hàng thất bại";
				}
			}
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			'discounts' => $this->discounts,
			'user_data' => $this->user_data,
			'title'=> 'Tạo đơn hàng',
			'title_main' => 'Tạo đơn hàng',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('main_oder_new',$data);
		$this->parser->parse('default/footer',$data);
	}
	
	private function CheckOrder($order){
		$sql = "SELECT * FROM orders WHERE code_orders = '$order'";
		$resuls = $this->GlobalMD->query_global($sql);
		if(!empty($resuls)){
			return true;
		}else{
			return false;
		}
		
	}
	private function setUpCustomer($params){
		$customer = array(
			'full_name'  => $params['name_customer'],
			'email'  => $params['email_customer'],
			'dia_chi'  => $params['addr_customer'],
			'dien_thoai'  => $params['phone_customer'],
			'note'  => $params['note_customer'],
			'supervisor'  => $this->staff,
		);
		$this->db->insert('customer', $customer); 
		$id_customer = $this->db->insert_id();
		if(isset($id_customer)){
			$code = 'KHPAQ0'.$id_customer;
			$array_customer = array(
				'code' => $code,
			);
			$this->db->where('id', $id_customer);
			$Update = $this->db->update('customer', $array_customer); 
			if($Update==true){
				return $code;
			}
		}else{
			return $code = 0;
		}
	}
	private function setUpcallback($params,$code_customer){
		$date = date('Y-m-d',strtotime($params['date_allBack']));
		$callback = array(
			'code_staff' => $this->staff,
			'code_customer'  => $code_customer,
			'scheduling'  => $date,
			'note'  => $params['note_callback'],
			'status'  => $params['NameCheckCallBack'],

		);
		$this->db->insert('scheduling_callback',$callback);
	}
	
	
}
?>