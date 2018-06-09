<?php
    require_once __DIR__. '/autoload.php';
    $sqlSP="";

    $id=$_GET['id'];
    $sqlSP="SELECT product.id as idsp, product.*, category.id ,category.name as ten FROM product LEFT JOIN category on category.id = product.category_id WHERE  product.id ='$id' ";

    $productSP= $db->fetchsql($sqlSP);
    /*if($productSP==null){
        header('Location:index.php');
    }*/
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
                                <a href="">
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
                            <li>
                                <i class="fa fa-file"></i> <a href=""><?php echo $productSP[0]['ten']; ?></a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> <a href=""><?php echo $productSP[0]['name']; ?></a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-lg-6 img-magnifier-container">
                        <img id="myimage" src="<?php echo uploads() ?>product/<?php echo $productSP[0]['thunbar'] ?>" style="width: 80%">
                    </div>
                    <div class="col-lg-6">
                        <div class="tensp">
                            <h2><?php echo $productSP[0]['name']; ?></h2>
                        </div>
                        <div class="sp_con">
                            <p><?php echo $productSP[0]['number'] == 0 ? "Hết Hàng" : 'Còn Sản Phẩm '.$productSP[0]['number'];?></p>
                        </div>
                        <div class="bt-xuly">
                            <a class="btn btn-success" href="addcart.php?id=<?php echo  $productSP[0]['idsp']?>">Thêm giỏ hàng</a>
                            <a class="btn btn-success" href="">Liên Hệ</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div><h1>Thông Tin Sản Phẩm</h1></div>
                        <div><?php echo $productSP[0]['content']; ?></div>
                    </div>

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
    });
    magnify("myimage", 2);
</script>