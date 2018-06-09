<?php
    function tong(){
        if(isset($_SESSION['cart'])){
            $tong=0;
            foreach ($_SESSION['cart'] as $k=>$v){
                $tong+=$v['qty'];
            }
            echo $tong;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thực tập</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="public/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css">

    <script  src="public/js/jquery-3.2.1.min.js"></script>
    <script  src="public/js/bootstrap.min.js"></script>
    <script  src="public/js/img-zoom.js"></script>

    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/img-zoom.css">
</head>
<body>
<div id="wrapper">
    <!---->
    <!--HEADER-->
    <div id="header">
        <div id="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-6" id="header-text">
                        <a>Thực Tập Hai</a><b>31 Phan Đình Giót, Q. Thanh Xuân, Hà Nội</b>
                    </div>
                    <div class="col-md-6 col-xs-6 " id="header-chucnang">
                        <nav id="header-nav-top">
                            <ul class="list-inline pull-right" id="headermenu">
                                <?php if(isset( $_SESSION['name_user'])) :?>
                                    <li>
                                        <a href=""><i class="fa fa-user"></i> Xin chào: <?php echo $_SESSION['name_user']?> <i class="fa fa-caret-down"></i></a>
                                        <ul id="header-submenu">
                                            <li><a href="logout.php">Thoát</a></li>
                                        </ul>
                                    </li>
                                <?php else:?>
                                    <li>
                                        <a href="dangnhap.php"><i class="fa fa-unlock"></i> Đăng Nhập</a>
                                    </li>
                                    <li>
                                        <a href="dangky.php"><i class="fa fa-user"></i> Đăng Ký</i></a>
                                    </li>
                                <?php endif;?>
                                <li >
                                    <a href="gio_hang.php" style="color: red;" ><i class="fa fa-shopping-cart"></i>&nbsp;Giỏ Hàng&nbsp
                                    <?php echo  tong(); ?> (SP)</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--END HEADER-->

        <!--MENUNAV-->
        <div id="menunav">
            <div class="container">
                <nav>
                    <!--menu main-->
                    <ul class="pull-left" id="menu-main">
                        <li>
                            <a href="index.php">Trang Trủ</a>
                        </li>
                        <li>
                            <a href="">Giới Thiệu</a>
                        </li>
                        <li>
                            <a href="">Cửa Hàng</a>
                        </li>
                        <li>
                            <a href="">Liên Hệ</a>
                        </li>
                        <li>
                            <a href="">Tin Tức</a>
                        </li>
                    </ul>
                    <!-- end menu main-->

                    <!--Shopping-->
                    <ul class="pull-right">
                        <form class="form-inline" method="post" action="timkiem.php">
                            <div class="form-group" id="timkiem">
                                <input type="text" name="tensp_tk" placeholder=" Tìm Kiếm" class="form-control">
                                <button type="submit" class="btn btn-default" name="tim_kiem"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </ul>
                    <!--end Shopping-->
                </nav>
            </div>
        </div>
        <!--ENDMENUNAV-->

