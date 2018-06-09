<?php require_once "conn/conn.php";
    $open="bangdk";

    // Kiểm tra xem đăng nhập hay chưa
    // Nếu đăng nhập thì mới cho vào trang này

    if (!isset($_SESSION['is_login']) || !$_SESSION['is_login']) {
        header('location:login.php');
    }
    $sqlsl="select sum(number) as solu from product";
    $tongs=$db->fetchsql($sqlsl);

    $sqltv="select COUNT(id) as th_vien from users WHERE  status=1";
    $use=$db->fetchsql($sqltv);

    $sql_thanhtoan="select count(id) as thanhtoan from transaction WHERE  status=1";
    $thanhtoans=$db->fetchsql($sql_thanhtoan);

     $sql="select sum(pay) as daban from product";
     $dabans=$db->fetchsql($sql);
?>
<?php require_once "themes/header.php"?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Chào mừng bạn đến với trang quản trị laptop
        </h1>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $tongs[0]['solu']?></div>
                                <div>sản phâm</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $use[0]['th_vien']?></div>
                                <div>Thành Viên!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $thanhtoans[0]['thanhtoan'] ?></div>
                                <div>Đã Thanh Toán</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?= $dabans[0]['daban']?></div>
                                <div>sô lượng bán!</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>
<?php require_once "themes/footer.php"?>

