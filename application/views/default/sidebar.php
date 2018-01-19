<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
	<div class="pull-left image">
		<?php 
			$user_data = $this->session->userdata('data_users');
			if(isset($user_data)){
				if(isset($user_data['hinh_anh'])){
					if(!empty($user_data['hinh_anh'])){
						$img_awata = "assets/xcrud/upload/staff/".$user_data['hinh_anh'];
					}else{
						$img_awata = "public/images/avata/default.png";
					}
				}else{
					$img_awata = "public/images/avata/default.png";
				}
			}else{
				$img_awata = "public/images/avata/default.png";
			}
		?>
	  <img src="<?php echo base_url().$img_awata;?>" class="img-circle" alt="User Image">
	</div>
	<div class="pull-left info">
	  <p></p>
	  <a href="#"><?php echo $user_data["email"]; ?></a><br>
	</div>
	
  </div>
  <!-- search form -->
  
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  
  <ul class="sidebar-menu" data-widget="tree">
	
	<li class="header">Trang Chủ</li>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-briefcase"></i> <span>Khách hàng</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/customer_management"><i class="fa fa-user-secret"></i> Quản lý khách hàng</a></li>
			<li><a href="<?php echo base_url();?>cms/scheduling"><i class="fa fa-history"></i> Lập lịch gọi lại</a></li>
		</ul>
	</li>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-shopping-cart"></i> <span>Đơn hàng</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/oders_management"><i class="fa fa-shopping-cart"></i> Quản lý đơn hàng</a></li>

		</ul>
	</li>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-cubes"></i> <span>Sản phẩm</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/product_management"><i class="fa fa-cube"></i> Quản lý sản phẩ<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"></a></li>

		</ul>
	</li>
	
	<li class="treeview">
		<a href="#">
		<i class="fa fa-gears"></i> <span>Hệ thống</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/staff"><i class="fa fa-users"></i> Nhân viên </a></li>
			<li><a href="<?php echo base_url();?>cms/partnersPost"><i class="fa fa-ship"></i> Dịch vụ bưu chính</a></li>
			<li><a href="<?php echo base_url();?>cms/typesPharma"><i class="fa  fa-eyedropper"></i> Loại thuốc</a></li>
			
		</ul>
	</li>
	
	<li><a  href="<?php echo base_url()?>exits"><i class="fa fa-sign-out"></i> <span>Đăng xuất tài khoản</span></a></li>
	<li class="header">Catalog Manager navigation panel</li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>
