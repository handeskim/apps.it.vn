<?php
class Prints extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('global_model', 'GlobalMD');	
	}
	
	public function index(){
		
	}
	public function details(){
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
			o.email as orders_email,
			o.full_name as orders_fullname,
			o.dia_chi as orders_addr,
			o.dien_thoai as orders_phone,
			o.code_customner as orders_code_customner,
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
				'content' => $this->template_details($sql),
			);
			$this->parser->parse('prints/default',$data);
		}
	}
	public function orders(){
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
			o.email as orders_email,
			o.full_name as orders_fullname,
			o.dia_chi as orders_addr,
			o.dien_thoai as orders_phone,
			o.code_customner as orders_code_customner,
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
				'content' => $this->template_invoice_details($sql),
			);
			$this->parser->parse('prints/default',$data);
		}
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
			o.email as orders_email,
			o.full_name as orders_fullname,
			o.dia_chi as orders_addr,
			o.dien_thoai as orders_phone,
			o.code_customner as orders_code_customner,
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
	private function template_details($sql){
		$temp = '';
		$data_field = $this->GlobalMD->query_global($sql);
		if(isset($data_field)){
			if(!empty($data_field)){
				$temp = '
				<div class="col-md-12">
					<div class="invoice-box">
						<table cellpadding="0" cellspacing="0">
						<tbody>
						<tr class="top">
							<td colspan="2">
								<table>
									<tbody>
									<tr style="background: #fff212;" >
										<td class="title">
											<img src="'.base_url().'public/logo/logopqa.png" style="width:160px; max-width:300px;">
										</td>
										<td>
											Invoice code#: '.$data_field[0]['orders_code'].'<br>
											Date Purchase: '.$data_field[0]['orders_date_buy'].'<br>
											Date Confirmed: '.$data_field[0]['orders_date_comfim'].'<br>
											Date Delivery: '.$data_field[0]['orders_date_send'].'<br>
										</td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr class="information">
							<td colspan="2">
								<table>
								<tbody>
								<tr>
									<td>
										 Công ty cổ phần PQA .<br>
										 Số 123 Hoàng Hoa Thám - Q.Ngô Quyền<br>
										TP.Đà Nẵng, Việt Nam 20000
									</td>
									<td>
										#'.$data_field[0]['orders_code_customner'].' - '.$data_field[0]['orders_fullname'].'<br>
										 '.$data_field[0]['orders_phone'].'<br>
										 '.$data_field[0]['orders_email'].'<br>
										 '.$data_field[0]['orders_addr'].'<br>
									</td>
								</tr>
								</tbody>
								</table>
							</td>
						</tr>
						<tr class="heading">
							<td>
								 Trạng thái đơn hàng
							</td>
							<td>
								'.$data_field[0]['name_type_orders'].'
							</td>
						</tr>
						<tr class="details">
							<td>
								
							</td>
							<td>
								
							</td>
						</tr>
						</tbody>
						</table>
						<table cellpadding="0" cellspacing="0">
						<tbody>
						<tr class="heading">
							<td>
								#
							</td>
							<td>
								Mã sản phẩm
							</td>
							<td>
								Tên sản phẩm
							</td>
							<td>
								Kiểu loại
							</td>
							<td>
								Số lượng 
							</td>
							<td>
								Đơn vị 
							</td>
							<td>
								Giá bán
							</td>	
							<td>
								Thành tiền
							</td>
						</tr>';
						$stt = 1;
						$total_bill = array();
						foreach($data_field as $value){
							$bill = (int)$value['orders_quantily'] * (int)$value['orders_price'];
							$temp .='<tr class="item">
									<td>
										'.$stt.'
									</td>
									<td>
										'.$value['products_code'].'
									</td>
									<td>
										'.$value['products_name'].'
									</td>
									<td>
										'.$value['name_pharma'].'
									</td>	
									<td>
										'.$value['orders_quantily'].'
									</td>
									<td>
										'.$value['generic_pharma'].'
									</td>
									<td>
										'. number_format($value['orders_price']).' 
									</td>
									<td>
										'. number_format($bill).' 
									</td>
								</tr>';
							$stt++;
							
							$total_bill[] = $bill;
						}
					$total_price_bill = array_sum($total_bill);
					$discounts_bill = ((int)$value['orders_discounts'] * $total_price_bill)/100;
					$total_discounts_bill = $total_price_bill - $discounts_bill;
					$total_vat_bill = ($total_discounts_bill * 10)/100;
					$total_price = $total_vat_bill + $total_discounts_bill;
					
					$temp .='
						</tbody>
						</table>
						<table cellpadding="0" cellspacing="0">
							<tbody>
								<tr class="invoice_total">
								<tr class="invoice_total"><td>Tổng cộng : </td><td>'. number_format($total_price_bill).'</td></tr>
								<tr class="invoice_total"><td>Chiết khấu: </td><td>'.$value['orders_discounts'].' % </td></tr>
								<tr class="invoice_total"><td>Hưởng Chiết Khấu: </td><td> - '.number_format($discounts_bill).'</td></tr>
								<tr class="invoice_total"><td>VAT: </td><td> 10 % </td></tr>
								<tr class="invoice_total"><td>Thuế: </td><td>+ '.number_format($total_vat_bill).'</td></tr>
								<tr class="invoice_total"><td>Thanh Toán không VAT : </td><td> '.number_format($total_discounts_bill).' </td></tr>
								<tr class="invoice_total"><td>Thanh Toán đã bao gồm VAT : </td><td>'.number_format($total_price).' </td></tr>
									
								</tr>
							</tbody>
						</table>
						<table cellpadding="0" cellspacing="0">
							<tr class="heading">
								<td>
									 hướng dẫn đơn hàng 
								</td>
							</tr>
							<tr class="">
								<td>
									'.$data_field[0]['orders_manuals'].'
								</td>
							</tr>
							<tr class="">
								<td>
									'.$data_field[0]['order_note'].'
								</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0">
							<tr class="heading">
								<td>
									 hướng dẫn theo thuốc
								</td>
							</tr>';
							
							foreach($data_field as $field){
								$temp .= '
									<tr><td> Mã sản phẩm: </br>'.$field['products_code'].'</td></tr>
									<tr><td> Tên sản phẩm:</br>  '.$field['products_name'].'</td></tr>
									<tr><td> Nhãn sản phẩm:</br> '.$field['products_label'].'</td></tr>
									<tr><td> kiểu thuốc: </br> '.$field['name_pharma'].'</td></tr>
								';
								$temp .= '<tr class="">
									<td>
										'.$field['products_manuals'].'
										'.$field['products_note'].'
									</td>
								</tr>';
								
								
							}
						$temp .= '</table>
					</div>
				</div>
				';
			}
		}
		return $temp;
	}
	private function info_company_invoice(){
		$sql = "SELECT company_invoice FROM generic ";
		$data_field = $this->GlobalMD->query_global($sql);
		return $data_field[0]['company_invoice'];
	}
	private function template_invoice_details($sql){
		$info_company_invoice = $this->info_company_invoice();
		$temp = '';
		$data_field = $this->GlobalMD->query_global($sql);
		if(isset($data_field)){
			if(!empty($data_field)){
				$temp = '
				<div class="col-md-12">
					<div class="invoice-box">
						<table cellpadding="0" cellspacing="0">
						<tbody>
						<tr class="top">
							<td colspan="2">
								<table>
									<tbody>
									<tr style="background: #fff212;" >
										<td class="title">
											<img src="'.base_url().'public/logo/logopqa.png" style="width:160px; max-width:300px;">
										</td>
										<td>
											Mã đơn hàng#: '.$data_field[0]['orders_code'].'<br>
											Ngày mua : '.$data_field[0]['orders_date_buy'].'<br>
											Ngày xác nhận: '.$data_field[0]['orders_date_comfim'].'<br>
											Ngày gửi hàng: '.$data_field[0]['orders_date_send'].'<br>
										</td>
									</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr class="information">
							<td colspan="2">
								<table>
								<tbody>
								<tr>
									<td>
										'. $info_company_invoice.'
									</td>
									<td>
										#'.$data_field[0]['orders_code_customner'].' - '.$data_field[0]['orders_fullname'].'<br>
										 '.$data_field[0]['orders_phone'].'<br>
										 '.$data_field[0]['orders_email'].'<br>
										 '.$data_field[0]['orders_addr'].'<br>
									</td>
								</tr>
								</tbody>
								</table>
							</td>
						</tr>
						<tr class="heading">
							<td>
								 Phương thức thanh toán
							</td>
							<td>
								 Thanh toán bằng tiền (VNĐ)# 
							</td>
						</tr>
						<tr class="details">
							<td>
								
							</td>
							<td>
								
							</td>
						</tr>
						</tbody>
						</table>
						<table cellpadding="0" cellspacing="0">
						<tbody>
						<tr class="heading">
							<td>
								#
							</td>
							<td>
								Mã sản phẩm
							</td>
							<td>
								Tên sản phẩm
							</td>
						
							<td>
								Số lượng 
							</td>
							<td>
								Đơn vị 
							</td>
							<td>
								Giá bán
							</td>	
							<td>
								Thành tiền
							</td>
						</tr>';
						$stt = 1;
						$total_bill = array();
						foreach($data_field as $value){
							$bill = (int)$value['orders_quantily'] * (int)$value['orders_price'];
							$temp .='<tr class="item">
									<td>
										'.$stt.'
									</td>
									<td>
										'.$value['products_code'].'
									</td>
									<td>
										'.$value['products_name'].'
									</td>
									
									<td>
										'.$value['orders_quantily'].'
									</td>
									<td>
										'.$value['generic_pharma'].'
									</td>
									<td>
										'. number_format($value['orders_price']).' 
									</td>
									<td>
										'. number_format($bill).' 
									</td>
								</tr>';
							$stt++;
							
							$total_bill[] = $bill;
						}
					$total_price_bill = array_sum($total_bill);
					$discounts_bill = ((int)$value['orders_discounts'] * $total_price_bill)/100;
					$total_discounts_bill = $total_price_bill - $discounts_bill;
					// $total_vat_bill = ($total_discounts_bill * 10)/100;
					// $total_price = $total_vat_bill + $total_discounts_bill;
					
					$temp .='
						</tbody>
						</table>
						<table cellpadding="0" cellspacing="0">
							<tbody>
								<tr class="invoice_total">
								<tr class="invoice_total"><td>Tổng cộng : </td><td>'. number_format($total_price_bill).'</td></tr>
								<tr class="invoice_total"><td>Chiết khấu: </td><td>'.$value['orders_discounts'].' % </td></tr>
								<tr class="invoice_total"><td>Hưởng Chiết Khấu: </td><td> - '.number_format($discounts_bill).'</td></tr>
								<tr class="invoice_total"><td>Thanh Toán: </td><td> '.number_format($total_discounts_bill).' </td></tr>
								
									
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				';
			}
		}
		return $temp;
	}
	private function template_manuals_details($sql){
		$data_field = $this->GlobalMD->query_global($sql);
		if(isset($data_field)){
			if(!empty($data_field)){
					$temp = '<div class="col-md-12">
							'.$data_field[0]['orders_manuals'].'<hr>
							'.$data_field[0]['order_note'].'
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