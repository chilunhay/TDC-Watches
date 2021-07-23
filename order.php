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
                <h1 class="text-center">Trang đặt hàng</h1>
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