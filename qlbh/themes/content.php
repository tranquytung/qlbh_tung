<div class="col-md-9">
    <div class="row">
        <div class="col-md-12" id="chi-muc">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="">Trang Trủ</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> <a href=""><?php /*echo $productSP[0]['ten']; */?></a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row" id="chitiet">
        <?php foreach ($productSP as $item) :?>
            <div class="col-md-4 ban">
                <div class="sp">
                    <ul>
                        <li>
                            <a href="chitietsanpham.html">
                                <img class="anh-chay " src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>">
                                <!--<h3><?php /*echo $item['namecate'] */?></h3>-->
                                <h4><?php echo $item['name'] ?></h4>
                                <b>Giá:<?php echo " ". tinh_km($item['price'],$item['sale']) ?></b><br>
                                <strike class=" <?php echo intval($item['sale'])>0 ? 'gia-goc' : 'an' ?>" > Giá gốc:<?php echo " ".formatprice($item['price']) ?> đ</strike>
                            </a>
                        </li>
                        <li>
                            <a href="" class="badge pull-left" > Liên hệ</a>
                            <a href="" class="badge pull-right">Giỏ hàng</a>
                        </li>
                    </ul>
                    <div class="km">
                        <a href="" class=" <?php echo $item['sale'] > 0 ? ' btn btn-danger tron ' : 'an' ?>" > - <?php echo $item['sale'] ?>%</a>
                    </div>
                </div>

            </div>
        <?php  endforeach; ?>
    </div>
</div>
</div>
</div>
</div>