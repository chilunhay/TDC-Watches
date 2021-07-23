<!doctype html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>TDC Watches</title>
	<link media="all" rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
	<div id="wrapper">

		<?php
			include 'inc/header.php'
		?>
		<!-- End header -->
		 
		<main id="main">
			
			<?php
				include 'inc/slider.php'
			?>
			<!-- End banner -->

			


			<div class="featured-product">
				<div class="container">
					<div class="box-intro">
						<h2><span class="title">Các danh mục sản phẩm</span></h2>
						<span class="desc-title">Tất cả sản phẩm</span>
					</div>
					<!-- Nav tabs -->
					<div class="nav-tabs-default">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#Featured" role="tab" aria-controls="Featured" aria-selected="true">Nổi bật</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#New-Arrivals" role="tab" aria-controls="New-Arrivals" aria-selected="false">Mới về</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="contact-tab" data-toggle="tab" href="#Bestseller" role="tab" aria-controls="Bestseller" aria-selected="false">Bán chạy nhất</a>
							</li>
						</ul>
					</div>
					<div class="product-grid tab-content" id="myTabContent">
						<div id="Featured" class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab">
							<ul class="list-product row list-unstyled">
								
								<?php 
								$product_feature = $pd->getproduct_feature();
								if($product_feature){
									while($result_feature = $product_feature->fetch_assoc()){
								?>
								<li class="col-md-3 col-sm-6 col-xs-12">
									<div class="item-product">
										<div class="item-product-thumb">
											<a href="#" class="product-thumb-link"><img class="img-responsive" src="admin/uploads/<?php echo $result_feature['image'] ?>" alt="" /></a>
											<div class="product-extra-mask">
												<div class="product-extra-link">
													<a href="#" class="product-compare"><i class="fa fa-history"></i></a>
													<a href="product_detail.php?proid=<?php echo $result_feature['productId'] ?>" class="product-add-cart"><i class="fa fa-cart-arrow-down"></i></a>
													<a href="#" class="product-wishlist"><i class="fa fa-heart"></i></a>
													<a href="product_detail.php?proid=<?php echo $result_feature['productId'] ?>" class="product-quick-view"><i class="fa fa-search"></i></a>
												</div>
											</div>
										</div>
										<div class="item-product-info">
											<h3 class="title-product"><a href="product_detail.php?proid=<?php echo $result_feature['productId'] ?>"><?php echo $result_feature['productName'] ?></a></h3>
											<div class="info-price">
												<span><?php echo number_format($result_feature['price']) ?> VNĐ</span>
											</div>
										</div>
									</div>
								</li>
								<?php
									}
								}
								?>
								
							</ul>
						</div>
						<!-- End Funiture -->

						<div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="New-Arrivals">
							<ul class="list-product row list-unstyled">
							<?php 
							$product_newproduct = $pd->getproduct_newproduct();
							if($product_newproduct){
								while($result_newproduct = $product_newproduct->fetch_assoc()){
							?>
								<li class="col-md-3 col-sm-6 col-xs-12">
									<div class="item-product-thumb">
										<a href="#" class="product-thumb-link"><img class="img-responsive" src="admin/uploads/<?php echo $result_newproduct['image'] ?>" alt="" /></a>
											<div class="product-extra-mask">
												<div class="product-extra-link">
													<a href="#" class="product-compare"><i class="fa fa-history"></i></a>
													<a href="product_detail.php?proid=<?php echo $result_newproduct['productId'] ?>" class="product-add-cart"><i class="fa fa-cart-arrow-down"></i></a>
													<a href="#" class="product-wishlist"><i class="fa fa-heart"></i></a>
													<a href="product_detail.php?proid=<?php echo $result_newproduct['productId'] ?>" class="product-quick-view"><i class="fa fa-search"></i></a>
												</div>
											</div>
										</div>
										<div class="item-product-info">
											<h3 class="title-product"><a href="product_detail.php?proid=<?php echo $result_newproduct['productId'] ?>"><?php echo $result_newproduct['productName'] ?></a></h3>
											<div class="info-price">
												<span><?php echo number_format($result_newproduct['price']) ?> VNĐ</span>
										</div>
									</div>
								</li>
							<?php
								}
							}	
							?>
							</ul>
						</div>
						<!-- End Decor -->

						<div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="Bestseller">
							<ul class="list-product row list-unstyled">
							<?php 
							$product_best = $pd->getproduct_best();
							if($product_best){
								while($result_best = $product_best->fetch_assoc()){
							?>
								<li class="col-md-3 col-sm-6 col-xs-12">
									<div class="item-product">
										<div class="item-product-thumb">
											<a href="#" class="product-thumb-link"><img class="img-responsive" src="admin/uploads/<?php echo $result_best['image'] ?>" alt="" /></a>
											<div class="product-extra-mask">
												<div class="product-extra-link">
													<a href="#" class="product-compare"><i class="fa fa-history"></i></a>
													<a href="product_detail.php?proid=<?php echo $result_best['productId'] ?>" class="product-add-cart"><i class="fa fa-cart-arrow-down"></i></a>
													<a href="#" class="product-wishlist"><i class="fa fa-heart"></i></a>
													<a href="product_detail.php?proid=<?php echo $result_best['productId'] ?>" class="product-quick-view"><i class="fa fa-search"></i></a>
												</div>
											</div>
										</div>
										<div class="item-product-info">
											<h3 class="title-product"><a href="product_detail.php?proid=<?php echo $result_best['productId'] ?>"><?php echo $result_best['productName'] ?></a></h3>
											<div class="info-price">
												<span><?php echo number_format($result_best['price']) ?> VNĐ</span>
											</div>
										</div>
									</div>
								</li>
							<?php 
								}
							} 
							?>
							</ul>
						</div>
						<!-- End Lighting -->

						

					</div>
				</div>
			</div>
			<!-- End Featured Product -->

			<!-- <section class="counter_offer parallaxie">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12"></div>

						<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 equalheight text-right">
							<div class="offer_text text-center">
								<h2>New Trending Collection</h2>
								<p>Sale Off 20% All Products</p>
							
								<div class="simply-countdown simply-countdown-one"></div>

								<a href="#" class="btn_pra">Shop Now</a>

							</div>
						</div>
					</div>
				</div>
			</section> -->
			<!-- End Offer -->

			<section id="features_watches">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="features_watches_box">
								<a href="productbytype.php?type=0">
									<img src="images/features_1.jpg" alt="image">
									<div class="features_watches_text">
										<h3>Đồng hồ giá rẻ</h3>
										<p>Mua ngay</p>
									</div>
								</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="features_watches_box">
								<a href="productbytype.php?type=1">
									<img src="images/features_2.jpg" alt="image">
									<div class="features_watches_text">
										<h3>Đồng hồ cao cấp</h3>
										<p>Mua ngay</p>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Features Watches -->

			<div class="featured-product">
				<div class="container">
					<div class="box-intro">
						<h2><span class="title">Đồng hồ mới cập nhật</span></h2>
						<span class="desc-title">Tất cả sản phẩm</span>
					</div>

					<div class="row">
					<?php 
						$product_new = $pd->getproduct_new();
						if($product_new){
							while($result_new = $product_new->fetch_assoc()){
					?>
						<div class="col-md-3 col-sm-3 col-xs-12">
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
										<span><?php echo number_format($result_new['price']) ?> VNĐ</span>
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