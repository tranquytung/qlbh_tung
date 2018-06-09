<?php require_once "autoload.php" ?>
<?php require_once  'themes/header.php'; ?>
<div id="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-4 fixside" >
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
            </div>
            <div class="col-md-9 col-xs-8">
                <section id="slide" class="text-center" >
                    <div id="carousel-id" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-id" data-slide-to="0" class=""></li>
                            <li data-target="#carousel-id" data-slide-to="1" class=""></li>
                            <li data-target="#carousel-id" data-slide-to="2" class="active"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item">
                                <img src="public/img/slide/sl1.jpg">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h1></h1>
        
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <img src="public/img/slide/sl2.jpg">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h1></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="item active">
                                 <img src="public/img/slide/sl3.jpg">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h1></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    
                </section>
            </div>
        </div>
    </div>
    <div class="container">
        <div>
            <hr style="background: red; height: 3px;margin-bottom: 0;">
            <h1 class="btn btn-danger" style="margin-bottom: 20px;border-top: none; font-size: 18px">Sản phẩm khuyến mại</h1>
        </div>
        <div class="row css_index" >
            <div class="col-md-12">
                <?php foreach ($productKM as $item) :?>
                    <div class="col-md-3 col-sm-4 col-xs-6 ban">
                        <div class="sp">
                            <ul>
                                <li>
                                    <a href="chitietsanpham.php?id=<?php echo $item['id'] ?>">
                                        <img class="anh-chay " src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>">
                                        <h3><?php echo $item['namecate'] ?></h3>
                                        <h4><?php echo $item['name'] ?></h4>
                                        <b>Giảm giá:<?php echo " ". tinh_km($item['price'],$item['sale']) ?></b><br>
                                        <strike class="gia-goc">Giá gốc:<?php echo " ".formatprice($item['price']) ?> đ</strike>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="badge pull-left" > Liên hệ</a>
                                    <a href="addcart.php?id=<?php echo  $item['id']?>" class="badge pull-right">Giỏ hàng</a>
                                </li>
                            </ul>
                        </div>
                        <div class="km">
                            <a href="" class="btn btn-danger tron" > - <?php echo $item['sale'] ?>%</a>
                        </div>
                        <div class="new">
                            <a href="" class=" <?php echo $item['new'] == 1 ? ' btn btn-danger tron ' : 'an' ?>">
                                <?php echo $item['new']==1 ? 'new' : ' '?></a>
                        </div>
                    </div>
                <?php  endforeach; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div>
            <hr style="background: red; height: 3px;margin-bottom: 0;">
            <h1 class="btn btn-danger" style="margin-bottom: 20px;border-top: none; font-size: 18px">Sản phẩm mới ra</h1>
        </div>
        <div class="row" >
            <div class="col-md-12">
                <?php foreach ($productNew as $item) :?>
                    <div class="col-md-3 col-sm-4 col-xs-6 ban">
                        <div class="sp">
                            <ul>
                                <li>
                                    <a href="chitietsanpham.php?id=<?php echo $item['id'] ?>">
                                        <img class="anh-chay" src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>">
                                        <h3><?php echo $item['namete']?></h3>
                                        <h4 ><?php echo $item['name'] ?></h4>
                                        <b>Gía:<?php echo " ". tinh_km($item['price'],$item['sale']) ?></b><br>
                                        <strike class="<?php echo intval($item['sale'])>0 ? 'gia-goc' : 'an' ?>">Giá gốc:<?php echo " ".formatprice($item['price']) ?> đ</strike>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="badge pull-left" > Liên hệ</a>
                                    <a href="addcart.php?id=<?php echo  $item['id']?>" class="badge pull-right md">Giỏ hàng</a>
                                </li>
                            </ul>
                        </div>
                        <div class="km">
                            <a href="" class=" <?php echo $item['sale'] > 0 ? ' btn btn-danger tron ' : 'an' ?>" >
                                - <?php echo $item['sale']?>%
                            </a>
                        </div>
                        <div class="new">
                            <a href="" class=" <?php echo $item['new'] == 1 ? ' btn btn-danger tron ' : 'an' ?>">
                                <?php echo $item['new']==1 ? 'new' : ' '?></a>
                        </div>
                    </div>
                <?php  endforeach; ?>
            </div>
            <div class="clearfix"></div>
        </div>

</div>
<div class="container">
    <div>
        <hr style="background: red; height: 3px;margin-bottom: 0;">
        <h1 class="btn btn-danger" style="margin-bottom: 20px;border-top: none; font-size: 18px">Sản phẩm bán chạy</h1>
    </div>
    <div class="row" >
        <div class="col-md-12">
            <?php foreach ($banchay_sql as $item) :?>
                <div class="col-md-3 col-sm-4 col-xs-6 ban">
                    <div class="sp">
                        <ul>
                            <li>
                                <a href="chitietsanpham.php?id=<?php echo $item['id'] ?>">
                                    <img class="anh-chay" src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>">
                                    <!-- <h3><?php /*echo $item['namete']*/?></h3>-->
                                    <h4 ><?php echo $item['name'] ?></h4>
                                    <b>Gía:<?php echo " ". tinh_km($item['price'],$item['sale']) ?></b><br>
                                    <strike class="<?php echo intval($item['sale'])>0 ? 'gia-goc' : 'an' ?>">Giá gốc:<?php echo " ".formatprice($item['price']) ?> đ</strike>
                                </a>
                            </li>
                            <li>
                                <a href="" class="badge pull-left" > Liên hệ</a>
                                <a href="addcart.php?id=<?php echo  $item['id']?>" class="badge pull-right">Giỏ hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="km">
                        <a href="" class=" <?php echo $item['sale'] > 0 ? ' btn btn-danger tron ' : 'an' ?>" >
                            - <?php echo $item['sale']?>%
                        </a>
                    </div>
                    <div class="new">
                        <a href="" class=" <?php echo $item['new'] == 1 ? ' btn btn-danger tron ' : 'an' ?>">
                            <?php echo $item['new']==1 ? 'new' : ' '?></a>
                    </div>
                </div>
            <?php  endforeach; ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php require_once 'themes/footer.php'; ?>