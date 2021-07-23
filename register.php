<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng ký</title>
    <link media="all" rel="stylesheet" type="text/css" href="css/main.css" />
</head>


<body>
    <div id="wrapper">

        <?php
        include 'inc/header.php';
        
	    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $insertCustomer = $cs->insert_customer($_POST);
            }       
        ?>

        <main id="main">
            <br>
            <div class="container-fluid">
                <h1 class="text-center">Đăng Ký Tài Khoản</h1>
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-4 well well-sm col-md-offset-4">
                        <?php 
                        if(isset($insertCustomer)){
                            echo $insertCustomer;
                        }
                        ?>
                        <!-- <legend><a href="index.html"><i class="glyphicon glyphicon-globe"></i></a> Đăng ký thành viên! -->
                        </legend>
                        <form action="" method="post" class="form" role="form">
                            <input class="form-control" name="name" placeholder="Họ và tên" type="text">
                            <!-- <div class="row justify-content-md-center">
                                <div class="col-xs-6 col-md-6"> 
                                    <input class="form-control" name="name" placeholder="Họ và tên" required="" autofocus="" type="text">
                                </div>
                                <div class="col-xs-6 col-md-6"> 
                                    <input class="form-control" name="lastname" placeholder="Tên" required="" type="text">
                                </div>
                            </div>  -->
                            <br>
                            <input class="form-control" name="email" placeholder="Email" type="email">
                            <br> 
                            <input class="form-control" name="password" placeholder="Mật khẩu" type="password">
                            <br> 
                            <input class="form-control" name="address" placeholder="Địa chỉ" type="address"> 
                            <br>
                            <input class="form-control" name="phone" placeholder="Số điện thoại" type="phone"> 
                            <br>
                            <label for=""> Giới tính</label>
                            <br>
                            <div class="col-xs-4 col-md-4">
                                <select id="name" name="gender" class="form-control">
                                    <option value="null">Chọn giới tính</option>
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                    <option value="2">Khác</option>
                                </select>
                            </div>
                            <!-- <label class="radio-inline"><input name="gender" id="inlineCheckbox1" value="male" type="radio">Nam </label> 
                            <label class="radio-inline"><input name="gender" id="inlineCheckbox2" value="female" type="radio">Nữ </label> -->
                            <br>
                            <br>
                            <button name="submit" class="btn btn-dark btn-primary btn-block" type="submit">Đăng ký</button>
                            <!-- <input type="submit" name="submit" value="Đăng ký" /> -->
                        </form>
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