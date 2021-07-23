<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sửa thông tin</title>
    <link media="all" rel="stylesheet" type="text/css" href="css/main.css" />
</head>


<body>
    <div id="wrapper">

        <?php
        include 'inc/header.php';       
        ?>
        <?php 
			$login_check = Session::get('customer_login');
			if($login_check==false){
				echo("<script>location.href = 'login.php';</script>");
			}
		?>
        <?php 
        $id = Session::get('customer_id');
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
            $update_customer = $cs->update_customer($_POST, $id);
           }
        ?>

        <main id="main">
            <br>
            <div class="container-fluid">
                <h1 class="text-center">Sửa thông tin tài khoản</h1>
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-4 well well-sm col-md-offset-4">
                        <?php 
                        if(isset($update_customer)){
                            echo $update_customer;
                        }
                        ?>
                        <?php 
                        $id = Session::get('customer_id');
                        $get_customer = $cs->show_customer($id);
                        if($get_customer){
                            while($result = $get_customer->fetch_assoc()){
                        ?>
                        <br>
                        <form action="" method="post" class="form" role="form">
                            <span>Họ và tên</span>
                            <input class="form-control" name="name" value="<?php echo $result['name'] ?>" type="text">
                            <br>
                            <span>Email</span>
                            <input class="form-control" name="email" value="<?php echo $result['email'] ?>" type="email">
                            <br>
                            <span>Địa chỉ</span>
                            <input class="form-control" name="address" value="<?php echo $result['address'] ?>" type="address"> 
                            <br>
                            <span>Số điện thoại</span>
                            <input class="form-control" name="phone" value="<?php echo $result['phone'] ?>" type="phone"> 
                            <br>
                            <br>
                            <button name="save" class="btn btn-dark btn-primary btn-block" type="submit">Sửa</button>
                            <!-- <input type="submit" name="submit" value="Đăng ký" /> -->
                        </form>
                        <?php 
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <br>
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