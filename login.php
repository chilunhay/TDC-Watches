<!doctype html>
<html lang="en-US">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Đăng nhập</title>
	<link media="all" rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
	<div id="wrapper">

	<?php
		include 'inc/header.php';
		$login_check = Session::get('customer_login');
		if($login_check){
			echo("<script>location.href = 'index.php';</script>");
		}
        
	    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $loginCustomer = $cs->login_customer($_POST);
            }       
    ?>
	
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
			
			$login_Customers = $cs->login_customer($_POST);
			
		}
	?>
		<!-- End header -->

		<main id="main">

			<div class="container">
				<div class="row">
					<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
						<div class="card card-signin my-5">
							<div class="card-body">
								<h5 class="card-title text-center">Đăng nhập</h5>
								<form action="" method="post" class="form-signin">
								<?php 
                        		if(isset($loginCustomer)){
                            		echo $loginCustomer;
                        		}
                        		?>
									<div class="form-label-group">
										<label for="inputEmail">Địa chỉ mail</label>
										<input name="email" type="email" id="inputEmail" class="form-control" placeholder="Nhập mail" autofocus>
									</div>
									<br>
									<div class="form-label-group">
										<label for="inputPassword">Mật khẩu</label>
										<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Nhập mật khẩu">

									</div>
									<br>
									<button name="submit" class="btn btn-dark btn-primary btn-block" type="submit">Đăng nhập</button>
									<br>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a style="color:black;" href="register.php" tabindex="5" class="register">Đăng ký</a>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>






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