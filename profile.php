<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Thông tin</title>
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

        <main id="main">
            <br>
            <div class="container-fluid">
                <h1 class="text-center">Thông tin tài khoản</h1>
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-4 well well-sm col-md-offset-4">
                        <?php 
                        $id = Session::get('customer_id');
                        $get_customer = $cs->show_customer($id);
                        if($get_customer){
                            while($result = $get_customer->fetch_assoc()){
                        ?>
                        <!-- <legend><a href="index.html"><i class="glyphicon glyphicon-globe"></i></a> Đăng ký thành viên! -->
                        </legend>
                        <form action="" method="post" class="form" role="form">
                            <span>Họ và tên</span>
                            <input class="form-control" name="name" value="<?php echo $result['name'] ?>" type="text" disabled>
                            <br>
                            <span>Email</span>
                            <input class="form-control" name="email" value="<?php echo $result['email'] ?>" type="text" disabled>
                            <br>
                            <span>Địa chỉ</span>
                            <input class="form-control" name="address" value="<?php echo $result['address'] ?>" type="text" disabled> 
                            <br>
                            <span>Số điện thoại</span>
                            <input class="form-control" name="phone" value="<?php echo $result['phone'] ?>" type="text" disabled> 
                            <br>
                            <label for=""> Giới tính</label>
                            <br>
                            <div class="col-xs-4 col-md-4">
                                <select id="name" name="gender" class="form-control" disabled>
                                    <option value="<?php echo $result['gender'] ?>">
                                    <?php 
                                    if($result['gender']==0)
                                    {
                                        echo 'Nam';
                                    } elseif($result['gender']==1)
                                    {
                                        echo 'Nữ';
                                    } else{
                                        echo 'Khác';
                                    }
                                    ?>
                                    </option>
                                    
                                </select>
                            </div>
                            <br>
                            <br>
                            <a href="editprofile.php" name="update_profile" class="btn btn-dark btn-primary btn-block">Sửa thông tin</a>
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