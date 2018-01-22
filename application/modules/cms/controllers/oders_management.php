<?php
class Oders_Management extends MY_Controller{
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

	private function button_new_order(){
		$temp='<a class="btn btn-primary" href="'.base_url('cms/order_new').'"> <i class="fa fa-cart-plus"> </i> Tạo mới đơn hàng</a>';
		return $temp;
	}
	public function index(){
		$msg ='';
		$data = array(
			'msg' => $this->button_new_order(),
			'content' => $this->Order(),
			'user_data' => $this->user_data,
			'title'=> 'Quản lý Đơn hàng',
			'title_main' => 'Quản lý Đơn hàng',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_Product',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function Order(){
	
			$xcrud = Xcrud::get_instance();
			$xcrud->table('orders');
			$xcrud->unset_view();
			$xcrud->unset_csv();
			$xcrud->unset_print();
			if($this->permisson == 3 ){
				$xcrud->unset_remove();
				$xcrud->where('type_orders',$this->permisson);
				$xcrud->button(base_url().'route/accountancy?query={code_orders}','Xác thực','fa fa-check-circle','',array('target'=>'_blank'));
				$xcrud->unset_edit();
			}
			if($this->permisson == 5 ){
				$xcrud->unset_remove();
				$xcrud->where('type_orders',$this->permisson);
				$xcrud->or_where('type_orders',8);
				$xcrud->or_where('type_orders',9);
				$xcrud->button(base_url().'route/packer?query={code_orders}','Xác thực','fa fa-check-circle','',array('target'=>'_blank'));
				$xcrud->unset_edit();
			}
			if($this->permisson == 4){
				$xcrud->unset_remove();
				$xcrud->where('code_staff',$this->staff);
				$xcrud->where('type_orders',$this->permisson);
				$xcrud->or_where('type_orders',$this->permisson);
				$xcrud->fields('code_orders,type_post,type_orders,manuals,note');
				$xcrud->columns('code_orders,price,quantily,total_price,code_customner,type_post,type_orders,manuals,note');
				
			}
			$xcrud->unset_add();
			if($this->permisson == 2){
				$xcrud->unset_remove();
			}
			$xcrud->table_name('[Orders] - Quản lý Đơn hàng');
			$xcrud->label('code_products','Mã Sản Phẩm');
			$xcrud->label('code_orders','Mã Đơn hàng');
			$xcrud->label('type_post','Nhà Bưu Chính');
			$xcrud->label('type_orders','Trạng Thái');
			$xcrud->label('code_staff','Mã Nhân viên');
			$xcrud->label('code_customner','Mã Mã khách hàng');
			$xcrud->label('quantily','Số lượng');
			$xcrud->label('price','Giá');
			$xcrud->label('manuals','Hướng Dẫn');
			$xcrud->label('note','Ghi chú');
			$xcrud->relation('code_customner','customer','code','full_name');
			$xcrud->relation('code_products','products','id','id');
			$xcrud->relation('type_orders','type_oders','id','name_oders');
			$xcrud->relation('type_post','type_post','id','name_type_orders');
			$xcrud->relation('code_staff','staff','id','code');
			$xcrud->button(base_url().'prints/orders?query={id}','In Đơn hàng','fa fa-print','',array('target'=>'_blank'));
			$xcrud->button(base_url().'prints/guide?query={id}','In Hướng Dẫn','fa fa-file','',array('target'=>'_blank'));
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
		
	}
}
?>