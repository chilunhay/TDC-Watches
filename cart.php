<!doctype html>
<html lang="en-US">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Giỏ hàng</title>
	<link media="all" rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
	<div id="wrapper">

		<?php
			include 'inc/header.php';
			if (isset($_GET['cartid'])) {
				$cartid = $_GET['cartid'];
				$delcart = $ct->delete_product_cart($cartid);
			}
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
				$cartId = $_POST['cartId'];
				$quantity = $_POST['quantity'];
				$update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
				if($quantity<=0)
				{
					$delcart = $ct->delete_product_cart($cartId);
				}
			}
		?>
		<!-- End header -->

		<main id="main">

			<section id="inner_banner">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="inner_banner_text">
								<h2>Giỏ hàng</h2>
							</div>
						</div>
					</div>
					<nav aria-label="breadcrumb text-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
							<li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
						</ol>
					</nav>
				</div>
			</section>
			<!-- End banner -->

			<section class="cart gray-bg">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-sm-8">
						<!-- <?php 
							if(isset($update_quantity_cart)){
							echo $update_quantity_cart;
							}
						?>
						<?php 
							if(isset($delcart)){
							echo $delcart;
							}
						?> -->
						
							<div class="card table-responsive">
								<table class="table" cellspacing="0">
									<thead>
										<tr>
											<th class="product-name">Tên sản phẩm</th>
											<th class="product-quantity">Số lượng</th>
											<th class="product-price">Tổng giá</th>
											<th class="product-remove">&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$get_product_cart = $ct->get_product_cart();
										if($get_product_cart){
											$subtotal = 0;
											$subquantity = 0;
											while($result = $get_product_cart->fetch_assoc()){
										?>
										<tr class="cart_item">
											<td>
												<div class="tg-tourname">
													<figure>
														<a href="#"><img src="admin/uploads/<?php echo $result['image'] ?>" class="img-responsive" alt=""></a>
													</figure>
													<div class="tg-populartourcontent">
														<div class="tg-populartourtitle">
															<h3><a href="#"><?php echo $result['productName'] ?></a> </h3>
														</div>
														<span><?php echo $result['quantity'] ?> <span class="Price-amount amount">
															<span class="Price-currencySymbol">x </span><?php echo number_format($result['price']) ?></span> 
														</span>
													</div>
												</div>
											</td>

											<td class="product-quantity">
												<div class="form-group">
													<form action="" method="post">
														<div class="quantity">
															<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
															<input type="hidden" name="quantity" class="form-control" value="<?php echo $quantity ?>"/>
															<input style="background: transparent; border: none; outline: none; float: right;" type="submit" name="submit" value="Cập nhật"/>
															<input style="width:70%;" type="number" name="quantity" min="0" class="form-control" value="<?php 
															$quantity = $result['quantity'];
															echo $quantity;
															?>"/>
															
														</div>
														<!-- <div class="col-sm-2 cart_button">
															<a class="btn_pra">
																<input style="background: transparent; border: none; outline: none; float: right;" type="submit" name="submit" value="Cập nhật"/>
															</a>
														</div> -->
													</form>
												</div>
											</td>

											<td>
												<span class="Price-amount amount"><span
														class="Price-currencySymbol"></span><?php 
														$total = $result['price']*$result['quantity'];
														echo number_format($total);
														?></span>
											</td>

											<td class="product-remove">
												<!-- <a href="?cartId=<?php echo $result['cartId']; ?>" class="remove"><i class="fa fa-trash-o"></i></a> -->
												<a style="color:black;" onclick="return confirm('Bạn có muốn xóa không?');" href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a>
											</td>
										</tr>
										<?php 
											$subtotal += $total;
											
											$subquantity += $quantity;
											
											}
										}
										?>
										
									</tbody>
								</table>
							
							</div>
							
						</div>

						<!-- Sidebar -->
						<div class="col-md-4 col-sm-4">
							<?php 
								$check_cart = $ct->check_cart();
								if($check_cart)
								{
							?>
							<div class="tr-single-box card">
								<div class="tr-single-header">
									<h4>Tổng tiền<span class="fl-right"><?php 
									$vat = $subtotal*0.1;
									$gtotal = $subtotal+$vat;
									echo number_format($gtotal)
									?></span></h4>
								</div>

								<div class="tr-single-body">
									<div class="booking-price-detail side-list no-border">
										<ul>
											<!-- <li>From<strong class="pull-right">25 Jan 2020</strong></li> -->
											<li>Tổng sản phẩm<strong class="pull-right"><?php echo $subquantity; Session::set('qty',$subquantity); ?></strong></li>
											<li>Tổng tiền chưa thuế<strong class="pull-right"><?php echo number_format($subtotal); Session::set('sum',$subtotal);   ?></strong></li>
											<li>VAT<strong class="pull-right">10%</strong></li>
											<li>Tiền sau thuế<strong class="pull-right"><?php echo number_format($gtotal) ?></strong></li>
										</ul>
										<a href="#" class="btn_pra">Thanh toán ngay</a>
									</div>
								</div>
							<?php 
								}else{
									echo "<span style='color:green; font-size:20px'>Giỏ hàng trống ! Hãy lựa chọn sản phẩm</span>";
								} 
							?>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- End featured -->

		</main>

		<?php
			include 'inc/footer.php'
		?>
		<!-- End footer -->

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>

</html>