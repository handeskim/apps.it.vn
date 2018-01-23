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
		if(isset($_GET['query'])){
			$code_orders = $_GET['query'];
			$sql = "SELECT
			o.id as orders_id,
			o.manuals as orders_manuals,
			o.note as order_note,
			o.code_orders as orders_code,
			o.price as orders_price,
			o.total_price as orders_total_price,
			o.discounts as orders_discounts,
			o.code_staff as orders_staff_id,
			o.date_order as orders_date_buy,
			o.date_confim as orders_date_comfim,
			o.date_send as orders_date_send,
			o.quantily as orders_quantily,
			p.manuals as products_manuals,
			p.name_products as products_name,
			p.label_products as products_label,
			p.note as products_note,
			p.id as products_id,
			p.code_products as products_code,
			s.id as staff_id,
			s.full_name as staff_fullname, 
			s.`code` as staff_code,
			s.email as staff_email, 
			s.dien_thoai as staff_phone,
			c.`code` as customer_code,
			c.email as customer_email,
			c.full_name as customer_fullname,
			c.dien_thoai as customer_phone_mobile, 
			c.dien_thoai_2 as customer_phone_home,
			c.dia_chi as customer_addr,
			c.note as customer_note,
			odr.name_oders as name_type_orders,
			ppm.name_types_pharma as name_pharma,
			pgm.name_generic_pharma as generic_pharma
			FROM orders o
			INNER JOIN products p ON o.code_products = p.id
			INNER JOIN types_pharma ppm ON p.types = ppm.id
			INNER JOIN generic_pharma pgm ON p.generic = pgm.id
			INNER JOIN type_post tpt ON o.type_post = tpt.id
			INNER JOIN staff s ON o.code_staff = s.id
			INNER JOIN customer c ON o.code_customner = c.`code`
			INNER JOIN type_oders odr ON o.type_orders = odr.id
			WHERE o.code_orders = '$code_orders'";
			$data = array(
				'content' => $this->template_manuals_details($sql),
			);
			$this->parser->parse('prints/default',$data);
		}
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
	
	private function template_manuals_details($sql){
		$data_field = $this->GlobalMD->query_global($sql);
		if(isset($data_field)){
			if(!empty($data_field)){
				$temp = '<div class="col-md-12">
					<h2 style="text-align:center;"> HƯỚNG DẪN SỬ DỤNG </h2>
					
					<div class="col-md-6">
						<h3 class="header_info_cart"> thông tin khách hàng</h3>
						<div class="col-md-12">
							<table class="table table-bordered">
								<tr>
									<td> Mã khách hàng: </td> <td>'.$data_field[0]['customer_code'].'</td>
								</tr>
								<tr>
									<td> Tên khách hàng: </td> <td> '.$data_field[0]['customer_fullname'].'</td>
								</tr>
								<tr>
									<td> Số điện thoại: </td> <td> '.$data_field[0]['customer_phone_mobile'].'</td>
								</tr>
								<tr>
									<td> Số điện thoại 2: </td> <td>'.$data_field[0]['customer_phone_home'].' </td>
								</tr>
								<tr>
									<td> Thư điện tử: </td> <td> '.$data_field[0]['customer_email'].'</td>
								</tr>
								<tr>
									<td> Địa chỉ: </td> <td> '.$data_field[0]['customer_addr'].'</td>
								</tr>
								<tr>
									<td> Ghi chú: </td> <td> '.$data_field[0]['customer_note'].'</td>
								</tr>								
							</table>
						</div>
					</div>
					
					<div class="col-md-6">
						<h3 class="header_info_cart"> thông tin người tư vấn</h3>
						<div class="col-md-12">
							<table class="table table-bordered">
								<tr>
									<td> Mã tư vấn: </td> <td>'.$data_field[0]['staff_code'].'</td>
								</tr>
								<tr>
									<td> Tên : </td> <td> '.$data_field[0]['staff_fullname'].'</td>
								</tr>
								<tr>
									<td> Số điện thoại: </td> <td> '.$data_field[0]['staff_phone'].'</td>
								</tr>
								<tr>
									<td> Thư điện tử: </td> <td> '.$data_field[0]['staff_email'].'</td>
								</tr>							
							</table>
						</div>
					</div>
					
					<div class="col-md-12">
						<h3 class="header_info_cart"> hướng dẫn sử dụng thuốc theo trị liệu</h3>
						<div class="col-md-12">
							<h4>Danh sách thuốc</h4><hr>
							<table class="table table-bordered">';
							foreach($data_field as $field_lists){
								$temp .= '
									<tr>
										<td> Mã sản phẩm: </td> <td>'.$field_lists['products_code'].'</td>
										<td> Tên sản phẩm: </td> <td> '.$field_lists['products_name'].'</td>
									</tr>
								
									<tr>
										<td> Nhãn sản phẩm: </td> <td> '.$field_lists['products_label'].'</td>
										<td> kiểu thuốc: </td> <td> '.$field_lists['name_pharma'].'</td>
									</tr>
									<tr>
										<td> Số lượng sản phẩm: </td> <td> '.$field_lists['orders_quantily'].'('.$field_lists['generic_pharma'].')</td>
										<td> Giá sản phẩm: </td> <td> '.$field_lists['orders_price'].' (vnđ) / '.$field_lists['generic_pharma'].'</td>
									</tr>							
								';
							}
							$temp .='</table>';
					$temp .='</div>
						<div class="col-md-12">
							<h4> Nội dung hướng dẫn trị liệu theo đơn </h4><hr>
							'.$data_field[0]['orders_manuals'].'<hr>
							<h4> Ghi chú hướng dẫn trị liệu theo đơn </h4><hr>
							'.$data_field[0]['order_note'].'
						</div>
					</div>';
					foreach($data_field as $field){
						$temp .= '<div class="col-md-12">
							<h3 class="header_info_cart"> hướng dẫn sử dụng thuốc: <i><u><b>'.$field['products_name'].'  ('.$field['products_label'].') </b></u></i></h3>
								<div class="col-md-12">
								'.$field['products_manuals'].'
								</div>
						</div>';
					}
					$temp .='<div class="col-md-12">
						<hr>
						<span> Công ty cổ phầm PQA </span></br>
						<span> Địa chỉ: Số 123 Hoàng Hoa Thám - Q.Ngô Quyền - TP.Đà Nẵng, VN</span></br>
						<span> Điện thoại: 0123-123-123 </span>
						<span> Website: http://www.pqa.vn </span>
						<span> Email: info@pqa.vn </span>
					</div>
				</div>';
				return $temp;
			}
		}else{
			return "dữ liệu không tồn tại";
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
		}else{
			return "dữ liệu không tồn tại";
		}
	}
}
?>