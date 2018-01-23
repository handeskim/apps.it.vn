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
		$temp = '';
		if($this->permisson == 1 || $this->permisson == 2 || $this->permisson == 3 || $this->permisson == 5){
			return $temp;
		}else{
			$temp='<a class="btn btn-primary" href="'.base_url('cms/order_new').'"> <i class="fa fa-cart-plus"> </i> Tạo mới đơn hàng</a>';
			return $temp;
		}
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
		$this->parser->parse('default/layout/main_curd_order',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function Order(){
	
			$xcrud = Xcrud::get_instance();
			$xcrud->table('orders');
			$xcrud->unset_view();
			$xcrud->unset_csv();
			$xcrud->unset_print();
			$xcrud->unset_add();
			if($this->permisson == 3 ){
				$xcrud->table_name('[Orders] - Duyệt Đơn hàng');
				$xcrud->unset_remove();
				$xcrud->where('type_orders',2);
				$xcrud->or_where('type_orders',7);
				$xcrud->button(base_url().'route/accountancy?query={code_orders}','Approved','fa fa-check-circle','',array('class'=>'btn btn-success'));
				$xcrud->button(base_url().'route/destroy_accounts?query={code_orders}','Reject','fa fa-remove','',array('class'=>'btn btn-danger'));
				$xcrud->unset_edit();
			}
			if($this->permisson == 5 ){
				$xcrud->unset_edit();
				$xcrud->unset_remove();
				$xcrud->where('type_orders',3);
				$xcrud->fields('type_orders');
				$xcrud->button(base_url().'route/packer?query={code_orders}','Approved','fa fa-check-circle','',array('class'=>'btn btn-success'));
				$xcrud->button(base_url().'route/destroy_packer?query={code_orders}','Reject','fa fa-remove','',array('class'=>'btn btn-danger'));
				$xcrud->button(base_url().'prints/guide?query={id}','Guide','fa fa-file','',array('target'=>'_blank'));
			}
			if($this->permisson == 4){
				$xcrud->unset_remove();
				$xcrud->unset_remove();
				$xcrud->where('code_staff',$this->staff);
				$xcrud->fields('type_post,manuals,note');
				$xcrud->where('type_orders !=',6);
				$xcrud->button(base_url().'prints/guide?query={id}','Guide','fa fa-file','',array('target'=>'_blank'));
				$xcrud->columns('code_orders,price,quantily,total_price,code_customner,type_post,type_orders,manuals,note');
				$xcrud->button(base_url().'route/destroy_staff?query={code_orders}','Reject','fa fa-remove','',array('class'=>'btn btn-danger'));
				
			}
			
			if($this->permisson == 2){
				$xcrud->unset_edit();
				$xcrud->unset_remove();
				$xcrud->table_name('[Orders] - Quản lý Đơn hàng');
			}
			
			$xcrud->label('code_products','Mã SP');
			$xcrud->label('code_orders','Mã ĐH');
			$xcrud->label('type_post','Nhà Bưu Chính');
			$xcrud->label('type_orders','Trạng Thái ĐH');
			$xcrud->label('code_staff','Mã Nhân viên');
			$xcrud->label('code_customner','Mã KH');
			$xcrud->label('quantily','Số lượng');
			$xcrud->label('price','Giá');
			$xcrud->label('manuals','Hướng Dẫn');
			$xcrud->label('note','Ghi chú');
			$xcrud->relation('code_customner','customer','code','full_name');
			$xcrud->relation('code_products','products','id','code_products');
			$xcrud->relation('type_orders','type_oders','id','name_oders');
			$xcrud->relation('type_post','type_post','id','name_type_orders');
			$xcrud->relation('code_staff','staff','id','code');
			$xcrud->columns('code_products,code_customner,code_orders,type_orders,type_post,quantily,price,discounts,total_price');
			$xcrud->button(base_url().'prints/orders?query={id}','Invoice','fa fa-print','',array('target'=>'_blank','class'=>'btn btn-primary'));
			if($this->permisson == 1 || $this->permisson == 2 || $this->permisson == 4 || $this->permisson == 5){
				$xcrud->button(base_url().'route/tracking?key={code_orders}&code={type_post}','Tracking','fa fa-ship','',array('target'=>'_blank'));
			}
			
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
		
	}
}
?>