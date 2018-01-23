<?php
class Prints extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('global_model', 'GlobalMD');	
	}
	
	public function index(){
		
	}
	public function orders(){
		
	}
	public function guide(){
		
	}
	
	public function customer_details(){
		if(isset($_GET['code'])){
			$id_sql = $_GET['code'];
			$sql = "SELECT c.code,c.full_name,c.email,c.ngay_sinh,c.dia_chi,c.dien_thoai,c.dien_thoai_2,c.passport_id,c.note,
			s.full_name as name_staff, s.email as account_staff, s.code as code_staff FROM customer c
			INNER JOIN staff s ON s.id = c.supervisor
			WHERE c.id = '$id_sql' limit 1";
			
			
			$data = array(
				'content' => $this->template_customer_details($sql),
			);
			$this->parser->parse('prints/default',$data);
		}
	}
	
	private function template_customer_details($sql){
		$data_field = $this->GlobalMD->query_global($sql);
		if(isset($data_field)){
			$temp = '<div class="col-md-6">';
			$temp .= '<table class="table table-bordered">';
			$temp .= '<h2> Thông tin khách hàng </h2>';
			$temp .= '<tbody>';
			$temp .='<tr>
						<td>
							<label><span>Mã khách hàng</span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['code'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Họ và tên </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['full_name'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Thư điện tử </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['email'].'</b></span>
						</td>
					</tr>';
					
			$temp .='<tr>
						<td>
							<label><span>Ngày sinh </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['ngay_sinh'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Địa chỉ </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['dia_chi'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Điện thoại Di Động </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['dien_thoai'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Điện thoại nhà</span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['dien_thoai_2'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Chứng mình thư nhân dân / hộ chiếu </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['passport_id'].'</b></span>
						</td>
					</tr>';
			
			$temp .='<tr>
						<td>
							<label><span>Mã nhân viên quản lý </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['code_staff'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Họ và tên nhân viên quản lý </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['name_staff'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Thư điện tử nhân viên quản lý </span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['account_staff'].'</b></span>
						</td>
					</tr>';
			$temp .='<tr>
						<td>
							<label><span>Ghi chú khách hàng</span></label>  
						</td>
						<td>
							<span><b>'.$data_field[0]['note'].'</b></span>
						</td>
					</tr>';
			$temp .= '</tbody> </table>';
			$temp .= '</div>';
			return $temp;
		}
	}
}
?>