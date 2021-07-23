<head>
	<link media="all" rel="stylesheet" type="text/css" href="css/dropdown.css" />
</head>

<?php
include 'lib/session.php';
Session::init();
?>
<?php

include 'lib/database.php';
include 'helper/format.php';

spl_autoload_register(function ($className) {
	include_once "classes/" . $className . ".php";
});


$db = new Database();
$fm = new Format();
$us = new user();
$br = new brand();
$cat = new category();
$pd = new product();
$ct = new cart();
$cs = new customer();

?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<header id="header">

	<div class="header_top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="contact">
						<p><i class="fa fa-phone" aria-hidden="true"></i> Gọi ngay: (123) 456- 789</p>
					</div>
				</div>
				<div class="col-md-6">
					<ul class="my-account-container">
						<?php 
							if(isset($_GET['customer_id'])){
								$delCart = $ct->del_all_data_cart();
								Session::destroy();
							}
						?>
						<?php 
							$login_check = Session::get('customer_login');
							if($login_check==false){
								echo '';
							} else {
								echo '<li><a href="cart.php">Giỏ hàng</a></li>';
							}
						?>
						<?php 
							$login_check = Session::get('customer_login');
							if($login_check==false){
								echo'<li><a href="login.php">Đăng nhập</a></li>';
								echo'<li><a href="register.php">Đăng ký</a></li>';
							} else{
								echo'<li><a href="profile.php">Xem thông tin</a></li>';
								echo '<li><a href="?customer_id='.Session::get('customer_id').'">Đăng xuất</a></li>';
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="header_bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<nav class="navbar navbar-light">
						<a href="index.php" class="navbar-brand"><img src="images/logo2.jpg" alt="image"></a>
						<form action="search.php" method="post"class="form-inline">
							<input name="tukhoa" style="color:white;" class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm" aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0"><input value="Tìm" name="submit" type="submit" style="background: transparent; border: none; outline: none;"><i class="fa fa-search" aria-hidden="true"></i></input></button>
						</form>
					</nav>
				</div>
				<div class="col-md-3">
					<div class="fav_icon">
						<a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
						<a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true">
						
						<?php 
						$check_cart = $ct->check_cart();
						if($check_cart){
						$sum = Session::get("sum");
						$qty = Session::get("qty");
						echo '<span id="qty-total">Số lượng: </span>';
						echo $qty;
						echo ' ';
						echo '<span id="cart-total">Giá: </span>';
						echo number_format($sum);
						}
						else{
							echo '';
						}
						?>
						</i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-light">
		<div class="container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto" style="font-family: 'Poppins', sans-serif; font-size:12px;">
					<li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
					<li class="nav-item"><a class="nav-link" href="product.php">Sản phẩm</a></li>
					<li class="nav-item"><a class="nav-link" href="men.php">Đồng hồ Nam</a></li>
					<li class="nav-item"><a class="nav-link" href="women.php">Đồng hồ Nữ</a></li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Danh mục
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php
							$name_cat = $cat->show_category_frontend();
							if ($name_cat) {
								while ($result_cat = $name_cat->fetch_assoc()) {
							?>
								<a class="dropdown-item" href="productbycat.php?catid=<?php echo $result_cat['catId'] ?>"><?php echo $result_cat['catName'] ?></a>
							<?php
								}
							}
							?>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Thương Hiệu
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php
							$name_brand = $br->show_brand_frontend();
							if ($name_brand) {
								while ($result_brand = $name_brand->fetch_assoc()) {?>
									<a class="dropdown-item" href="productbybrand.php?brandid=<?php echo $result_brand['brandId'] ?>"><?php echo $result_brand['brandName'] ?></a>
							<?php
								}
							}
							?>
						</div>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Loại sản phẩm
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<?php
							$type = $pd->get_name_type();
							if ($type) {
								while ($result = $type->fetch_assoc()) {
							?>
									<a class="dropdown-item" href="productbytype.php?type=<?php echo $result['type'] ?>">
										<?php
										if ($result['type'] == 0) {
											echo 'Đồng hồ giá rẻ';
										} else {
											echo 'Đồng hồ cao cấp';
										}
										?></a>
							<?php
								}
							}
							?>
						</div>
					</li>
					<li class="nav-item"><a class="nav-link" href="contact_us.php">Liên hệ</a></li>
				</ul>
			</div>

		</div>
	</nav>

</header>