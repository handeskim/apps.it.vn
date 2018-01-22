<?php
class Customer_Management extends MY_Controller{
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
		if($this->permisson == 3 || $this->permisson == 5 ){
			redirect(base_url('apps'));
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->Customer(),
			'user_data' => $this->user_data,
			'excel_command' => $this->excel_command(),
			'total_customer' => $this->total_customer(),
			'title'=> 'Quản lý khách hàng',
			'title_main' => 'Quản lý khách hàng',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_Customer',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function excel_command(){
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
	private function Customer(){
		$user = $this->staff;
			$xcrud = Xcrud::get_instance();
			$xcrud->table('customer');
			$xcrud->unset_csv();
			$xcrud->unset_add();
			if($this->permisson == 4){
				$xcrud->where('supervisor',$this->staff);
			}
			if($this->permisson == 2 || $this->permisson == 3 || $this->permisson == 5){
				$xcrud->unset_remove();
				$xcrud->unset_edit();
			}
			$xcrud->table_name('[Customer] - Quản lý khách hàng');
			$xcrud->label('code','Mã khách hàng');
			$xcrud->label('full_name','Họ Va Tên');
			$xcrud->label('email','email');
			$xcrud->label('ngay_sinh','Ngày Sinh');
			$xcrud->label('dia_chi','Địa Chỉ ');
			$xcrud->label('dien_thoai','Điện thoại');
			$xcrud->label('dien_thoai_2','Điện thoại 2');
			$xcrud->label('hinh_anh','Hình Ảnh');
			$xcrud->label('passport_id','CMTND');
			$xcrud->label('note','Ghi chú');
			$xcrud->label('supervisor','Nhân viên Tiếp Thị');
			$xcrud->validation_required('code');
			$xcrud->validation_required('full_name');
			$xcrud->validation_required('email');
			$xcrud->validation_required('ngay_sinh');
			$xcrud->validation_required('dia_chi');
			$xcrud->validation_required('dien_thoai');
			$xcrud->validation_required('supervisor');
			if($this->permisson == 4 || $this->permisson == 5|| $this->permisson == 3){
				$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4 and id='.$user);
			}else{
				$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4');
			}
			$xcrud->change_type('hinh_anh', 'image', '', array('width' => 200, 'height' => 200,'path' => '/upload/Customer/',));
			$xcrud->button(base_url().'prints/customer_details?code={id}','Prints','fa fa-print','',array('target'=>'_blank'));
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
	
	}
}
?>