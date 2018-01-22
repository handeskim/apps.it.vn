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
	public function index(){
		if($this->authorities == 3){
			redirect(base_url('cms/oders_management'));
		}
		$cmd = $this->input->post('cmd');
		if(!empty($cmd)){
			$params = $_POST;
			$code_customer = time().uniqid();
			if($params['NameCheckCustomer'] == 2){
				
				$this->setUpCustomer($params,$code_customer);
			}else{
				$code_customer = $params['CodeCustomer'];	
			}
			if($params['NameCheckCallBack'] ==1){
				$this->setUpcallback($params,$code_customer);
			}
			$this->db->trans_start();
			foreach($params ["product"] as $valueP){
				
				$code_products = $valueP[0];
				$infoP = $this->InfoProduct($code_products);
				$quantily = (int)$valueP[1];
				$price = (int)$infoP[0]['price'];
				$total_price = (int)$quantily * (int)$price;
				$arrayOrder = array(
					'code_products' => $code_products,
					'code_orders' => $params['CodeOrder'],
					'type_post' => $params['NamePost'],
					'code_staff' => $this->staff,
					'code_customner' => $code_customer,
					'type_orders' => 2,
					'quantily' => $quantily,
					'price' => $price,
					'total_price' => $total_price,
					'manuals' => $params['manuals'],
					'note' => $params['note'],
				);
				$install = $this->db->insert('orders',$arrayOrder);
			}
			$this->db->trans_complete();
			if($install==true){
				$this->Notifacation($params['CodeOrder']);
				redirect(base_url('cms/oders_Management'));
				$msg = "Tạo đơn hàng thành công";
			}else{
				$msg = "Tạo đơn hàng thất bại";
			}
			
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			
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
	
	private function setUpCustomer($params,$code_customer){
		$customer = array(
			'code' => $code_customer,
			'full_name'  => $params['name_customer'],
			'email'  => $params['email_customer'],
			'dia_chi'  => $params['addr_customer'],
			'dien_thoai'  => $params['phone_customer'],
			'note'  => $params['note_customer'],
			'supervisor'  => $this->staff,
		);
		$this->db->insert('customer',$customer);
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