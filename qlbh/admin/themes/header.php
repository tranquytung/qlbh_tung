<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang quản trị</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>public/css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>public/css/style_admin.css" rel="stylesheet" type="text/css">
    <style>
        .do{
            color: red;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Trang Quản Trị</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Xin chào :<?php echo " ". $_SESSION['username'] ?>
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="http://localhost:81/qlbh/admin/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php echo isset($open) && $open == "bangdk" ? 'active' : '' ?>">
                        <a href="http://localhost:81/qlbh/admin/index.php"><i class="fa fa-fw fa-dashboard"></i> Bảng điều khiển</a>
                    </li>
                    <li class="<?php echo isset($open) && $open == "category" ? 'active' : '' ?>">
                        <a href="<?php echo modules("category") ?>"><i class="fa fa-list"> Danh mục sản phẩm</i></a>
                    </li>
                    <li class="<?php echo isset($open) && $open == "product" ? 'active' : '' ?>">
                        <a href="<?php echo modules("product") ?>"><i class="fa fa-database"> Sản phẩm</i></a>
                    </li>
                    <li class="<?php echo isset($open) && $open == "admin" ? 'active' : '' ?>">
                        <a href="<?php echo modules("admin") ?>"><i class="fa fa-database"> Admin</i></a>
                    </li>
                    <li class="<?php echo isset($open) && $open == "users" ? 'active' : '' ?>">
                        <a href="<?php echo modules("users") ?>"><i class="fa fa-database"> Thành Viên</i></a>
                    </li>
                    <li class="<?php echo isset($open) && $open == "transactions" ? 'active' : '' ?>">
                        <a href="<?php echo modules("transactions") ?>"><i class="fa fa-database"> Quẩn lý đơn hàng</i></a>
                    </li>
                     
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
