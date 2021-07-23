<!doctype html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Loại sản phẩm</title>
	<link media="all" rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
	
	<div id="wrapper">

		<?php
			include 'inc/header.php';
			if(!isset($_GET['type']) || $_GET['type']==NULL){
				echo "<script>window.location ='404.php'</script>";
			}else{
				$type = $_GET['type']; 
			}
			
		?>
		<!-- End header -->

		<main id="main">

			<section id="inner_banner">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="inner_banner_text">
								<h2>Loại sản phẩm</h2>
							</div>
						</div>
					</div>
					<nav aria-label="breadcrumb text-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
							<?php
	     	                $name_type = $pd->get_name_by_type($type);
	      	                if($name_type){
	      	 	                while($result_type = $name_type->fetch_assoc()){
	      	                ?>
							<li class="breadcrumb-item active" aria-current="page">
                            <?php
							if($result_type['type']==0){
								echo 'Đồng hồ giá rẻ';
							}else{
								echo 'Đồng hồ cao cấp';
							} 
						    ?>
                        </li>
							<?php
								}
							}
							?>
						</ol>
					</nav>
				</div>
			</section>
			<!-- End banner -->

			<div class="featured-product">
				<div class="container">
				<div class="content">
    		<?php
	     	$name_type = $pd->get_name_by_type($type);
	      	if($name_type){
	      	 	while($result_type = $name_type->fetch_assoc()){
	      	?>
    		<div class="content_top">		
    			<div class="heading">	
    				<h3>Loại sản phẩm : 
                        <?php
							if($result_type['type']==0){
								echo 'Đồng hồ giá rẻ';
							}else{
								echo 'Đồng hồ cao cấp';
							} 
						?>
                    </h3>
    			</div>
    		<div class="clear"></div>

    		</div>
    		<?php
			}}
			?>

					<div class="row">

						<div class="col-md-6 cols-sm-6 col-xs-6">
							<div class="grid_view">
								<a href="#"><i class="fa fa-th-large"></i> Grid</a>
								<a href="#"><i class="fa fa-th-list"></i> List</a>
							</div>
						</div>

						<div class="col-md-6 cols-sm-6 col-xs-6 text-right">
							<div class="product_search">
								<div class="search_area">
									<span><i class="fa fa-search"></i></span>
									<input type="search" placeholder="Search" class="form-control"/>
								</div>
							</div>
						</div>

					</div>

					<hr>

					<div class="row">
					<?php
	      	 		$productbytype = $pd->get_product_by_type($type);
	      	 		if($productbytype){
	      	 			while($result = $productbytype->fetch_assoc()){
	      			?>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="item-product">
								<div class="item-product-thumb">
									<a href="#" class="product-thumb-link"><img class="img-responsive" src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
									<div class="product-extra-mask">
										<div class="product-extra-link">
											<a href="#" class="product-compare"><i class="fa fa-history"></i></a>
											<a href="product_detail.php?proid=<?php echo $result['productId'] ?>" class="product-add-cart"><i class="fa fa-cart-arrow-down"></i></a>
											<a href="#" class="product-wishlist"><i class="fa fa-heart"></i></a>
											<a href="product_detail.php?proid=<?php echo $result['productId'] ?>" class="product-quick-view"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="item-product-info">
									<h3 class="title-product"><a href="product_detail.php?proid=<?php echo $result['productId'] ?>"><?php echo $result['productName'] ?></a></h3>
									<div class="info-price">
										<span><?php echo number_format($result['price']) ?> VNĐ</span>
									</div>
								</div>
							</div>
						</div>
					<?php 
						}
					}else{
						echo 'Hiện tại chưa có sản phẩm';
					}
					?>
					</div>
				
					<div class="row">
						<div class="coil-md-12 text-center">
							<nav aria-label="Page navigation example">
								<ul class="pagination">
									<li class="page-item">
										<a class="page-link active" href="#" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
											<span class="sr-only">Previous</span>
										</a>
									</li>
									<li class="page-item"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											<span class="sr-only">Next</span>
										</a>
									</li>
								</ul>
							</nav>
						</div>
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
