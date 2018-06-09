<?php
require_once 'autoload.php';
    $sqlSP="";
    if(empty($_POST['tensp_tk'])){
        header("location:index.php");
    }

    else if(isset($_POST['tim_kiem']) && !empty($_POST['tensp_tk'])) {
        $ten=$_POST['tensp_tk'];
        $sqlSP="select  product.*, category.name as ten FROM product LEFT JOIN category on category.id = product.category_id WHERE product.name LIKE '%$ten%'";
        /* $timSql=$db->fetchsql($sql_tk);*/
    }
    $productSP= $db->fetchsql($sqlSP);
    if($productSP==null){
        header('Location:index.php');
    }
?>
<?php require_once('themes/header.php') ?>
<div id="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-md-3  fixside" >
                <div class="box-left box-menu" >
                    <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
                    <ul>
                        <?php foreach ($sqlHome as $item) :?>
                            <li>
                                <a href="sanpham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name']; ?>
                                    <?php $hi=$item['name'];
                                    $sqlSL = "SELECT  sum(product.number) as soluong FROM product LEFT JOIN category on category.id = product.category_id WHERE category.name  = '$hi'";
                                    $SL=$db->fetchsql($sqlSL); ?>
                                    <span class="<?php echo $SL[0]['soluong'] > 0 ? 'badge pull-right' : 'an' ?>"><?php echo $SL[0]['soluong']?> </span>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="box-left box-menu" id="sankm">
                    <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm mới </h3>
                    <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                    <ul>
                        <?php foreach ($productNew as $item) :?>
                            <li class="clearfix">
                                <a href="chitietsanpham.php?id=<?php echo $item['id'] ?>">
                                    <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                    <div class="info pull-right">
                                        <p class="name"><?php echo $item['name']?></p >
                                        <b class="price"><?php Gia : echo tinh_km($item['price'],$item['sale']) ?> đ</b><br>
                                        <b class="sale">Giá gốc: <?php echo $item['price']?> đ</b><br>
                                        <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- </marquee> -->
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12" id="chi-muc">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="">Trang Trủ</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> <a href=""><?php echo $productSP[0]['ten']; ?></a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row" id="chitiet">
                    <?php foreach ($productSP as $item) : ?>
                        <div class="col-md-4 ban">
                            <div class="sp">
                                <ul>
                                    <li>
                                        <a href="chitietsanpham.php?id=<?php echo $item['id'] ?>">
                                            <img class="anh-chay "
                                                 src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>">
                                            <!--<h3><?php /*echo $item['namecate'] */ ?></h3>-->
                                            <h4><?php echo $item['name'] ?></h4>
                                            <b>Giá:<?php echo " " . tinh_km($item['price'], $item['sale']) ?></b><br>
                                            <strike class=" <?php echo intval($item['sale']) > 0 ? 'gia-goc' : 'an' ?>"> Giá
                                                gốc:<?php echo " " . formatprice($item['price']) ?> đ</strike>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="badge pull-left"> Liên hệ</a>
                                        <a href="" class="badge pull-right">Giỏ hàng</a>
                                    </li>
                                </ul>
                                <div class="km">
                                    <a href="" class=" <?php echo $item['sale'] > 0 ? ' btn btn-danger tron ' : 'an' ?>">
                                        - <?php echo $item['sale'] ?>%</a>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('themes/footer.php') ?>

<script type="text/javascript">
    $(function() {
        $hidenitem = $(".hidenitem");
        $itemproduct = $(".item-product");
        $itemproduct.hover(function(){
            $(this).children(".hidenitem").show(100);
        },function(){
            $hidenitem.hide(500);
        })
    })
</script>