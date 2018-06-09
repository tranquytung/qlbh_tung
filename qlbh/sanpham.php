<?php

    $sqlSP="";
    $idsp=$_GET['id'];
    require_once 'autoload.php';
    $sql_cout="select count(*) as tong  from product WHERE category_id ='$idsp' ";
    $total=$db->fetchsql($sql_cout);
    $total_row=$total[0]['tong'];

    $page=@$_GET['page'];
    if(!$page) $page=1;
    $row=9;
    $total_page=ceil($total_row/$row);

    if ($page > $total_page) $page=$total_page;

    $from=($page-1)*$row;


    $sqlSP="SELECT product.*,product.id as sp_id, category.id ,category.name as ten FROM product LEFT JOIN category on category.id =product.category_id WHERE category.id ='$idsp' limit $from,$row";

    $productSP= $db->fetchsql($sqlSP);
    if($productSP==null){
        header('Location:index.php');
    }

?>

<?php require_once('themes/header.php') ?>
<div id="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-5   fixside" >
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
            <div class="col-md-9 col-xs-7">
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
                <div class="row class_sp" id="chitiet">
                    <div class="col-md-12">
                        <?php foreach ($productSP as $item) : ?>
                            <div class="col-md-4 ban">
                                <div class="sp">
                                    <ul>
                                        <li>
                                            <a href="chitietsanpham.php?id=<?php echo $item['sp_id'] ?>">
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
                                            <a href="" class="badge pull-left mb"> Liên hệ</a>
                                            <a href="addcart.php?id=<?php echo  $item['sp_id']?>" class="badge pull-right mb">Giỏ hàng</a>
                                        </li>
                                    </ul>
                                    <div class="km">
                                        <a href="" class=" <?php echo $item['sale'] > 0 ? ' btn btn-danger tron ' : 'an' ?>">
                                            - <?php echo $item['sale'] ?>%</a>
                                    </div>
                                    <div class="new">
                                        <a href="" class=" <?php echo $item['new'] == 1 ? ' btn btn-danger tron ' : 'an' ?>">
                                            <?php echo $item['new']==1 ? 'new' : ' '?></a>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="pull-right">
                    <nav aria-label="Page navigation">
                        <?php if($total_page > 1):?>
                            <ul class="pagination">
                                <li>
                                    <a href="<?php echo getLinkPagination($page-1); ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                               <?php  for($i=1;$i<=$total_page;$i++) :?>
                                <li class="">
                                    <a href="<?php echo getLinkPagination($i); ?>"><?= $i;?></a>
                                </li>
                                <?php endfor;?>
                                <li>
                                    <a href="<?php echo getLinkPagination($page+1); ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        <?php endif;?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('themes/footer.php') ?>
