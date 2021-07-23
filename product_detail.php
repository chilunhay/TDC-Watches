
<!doctype html>
<html lang="en-US">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Chi tiết sản phẩm</title>
	<link media="all" rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
	<div id="wrapper">

		<?php
			include 'inc/header.php'
		?>
		
	<?php 
	if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
        echo "<script>window.location='404.php'</script>";
    } else {
        $id = $_GET['proid'];
    }	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$quantity = $_POST['quantity'];
		$insertCart = $ct->add_to_cart($quantity, $id);
   	}
	?>
	<?php 
		$login_check = Session::get('customer_login');
		if($login_check==false){
			echo("<script>location.href = 'login.php';</script>");
		}
	?>
		<!-- End header -->

		<section id="inner_banner">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="inner_banner_text">
							<h2>Chi tiết sản phẩm</h2>
						</div>
					</div>
				</div>
				<nav aria-label="breadcrumb text-center">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
						<li class="breadcrumb-item"><a href="">Pages</a></li>
						<li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
					</ol>
				</nav>
			</div>
		</section>
		<!-- End banner -->

		<section class="product_detail gray-bg">
			<div class="container">
				<div class="row">
				<?php 
					$get_product_detail = $pd->get_detail($id);
					if($get_product_detail){
						while($result_detail = $get_product_detail->fetch_assoc()){
				?>
					<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
						<div class="img">
							<img src="admin/uploads/<?php echo $result_detail['image'] ?>" alt="image">
						</div>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
						<div class="product_detail_box">
							
							<h3><?php echo $result_detail['productName'] ?></h3>
							<p>Danh mục: <?php echo $result_detail['catName'] ?></p>
							<p>Giới tính: 
							<?php
							if($result_detail['gender']==0){
								echo 'Đồng hồ Nam';
							} else{
								echo 'Đồng hồ Nữ';
							}
							?></p>
							<p>Thương hiệu: <?php echo $result_detail['brandName'] ?></p>
							<p>Giá: <?php echo number_format($result_detail['price']) ?></p>

							<div class="rating"><a href="#">Đánh giá <span><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half"></i></span></a></div>
							
							<div class="row">
								<form action="" method="post">
									<div class="col-lg-5">
										<div class="quantity">
											<br>
											<label>Số lượng </label>
											<div id="input_div">
												<input name="quantity" type="number" size="25" value="1" id="count" min="1">
											</div>
										</div>
									</div>
									<div class="button_area">
										<a class="btn_pra"><input style="background: transparent; border: none; outline: none;" type="submit" name="submit" value="Mua ngay"/></a>
										<a href="#" class="wishlist"><i class="fa fa-heart"></i> Thêm vào yêu thích</a>
									</div>
								</form>
							</div>
							<br>
							<?php
							if(isset($insertCart)){
								echo $insertCart;
							}
							?>
						</div>
					</div>
					
				</div>



				<section class="tabs_area">
					<div class="container">
						<ul id="myTabs" class="nav nav-pills nav-justified" role="tablist" data-tabs="tabs">
							<li class="active"><a href="#Description" data-toggle="tab">Mô tả</a></li>
							<li><a href="#Comment" data-toggle="tab">Bình luận</a></li>
							
						</ul>
					<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="Description">
						<h3>Mô tả sản phẩm</h3>
						<p><?php echo $fm->textShorten($result_detail['product_desc'],500) ?></p>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="Comment">
						<h3>Bình luận</h3>
						<p>Hello cả nhà yêu của Kem</p>
					</div>
					</div>
					</div>
				</section>
				<?php
						} 
					}
				?>
			</div>
		</section>
		<!-- End Product Details -->

		
		<!-- End Product Details -->

		<div class="featured-product">
			<div class="container">

				<div class="box-intro">
					<h2><span class="title">Đồng hồ mới</span></h2>
					<span class="desc-title">Các sản phẩm</span>
				</div>

				<div class="row">
					<?php 
						$product_new = $pd->getproduct_new_3();
						if($product_new){
							while($result_new = $product_new->fetch_assoc()){
					?>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="item-product">
							<div class="item-product-thumb">
								<a href="#" class="product-thumb-link"><img class="img-responsive" src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
								<div class="product-extra-mask">
									<div class="product-extra-link">
										<a href="#" class="product-compare"><i class="fa fa-history"></i></a>
										<a href="product_detail.php?proid=<?php echo $result_new['productId'] ?>" class="product-add-cart"><i class="fa fa-cart-arrow-down"></i></a>
										<a href="#" class="product-wishlist"><i class="fa fa-heart"></i></a>
										<a href="product_detail.php?proid=<?php echo $result_new['productId'] ?>" class="product-quick-view"><i class="fa fa-search"></i></a>
									</div>
								</div>
							</div>
							<div class="item-product-info">
								<h3 class="title-product"><a href="product_detail.php?proid=<?php echo $result_new['productId'] ?>"><?php echo $result_new['productName'] ?></a></h3>
								<div class="info-price">
									<span><?php echo number_format($result_new['price']) ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php 
						}
					}
					?>
					
					</div>
				</div>

			</div>
		</div>
		<!-- End featured -->


		<?php
			include 'inc/footer.php'
		?>
		<!-- End footer -->

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<form class="searchform">
						<i class="fa fa-search" aria-hidden="true"></i>
						<input class="form-control" type="text" placeholder="Search" aria-label="Search">
					</form>
				</div>
			</div>
		</div>

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>

</html>