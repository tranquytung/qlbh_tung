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
                                    <span class="badge pull-right"> 14 </span>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="box-left box-menu" id="sankm">
                    <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm mới </h3>
                    <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                    <ul>
                        <?php foreach ($sqlNew as $item) :?>
                        <li class="clearfix">
                            <a href="">
                                <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                                <div class="info pull-right">
                                    <p class="name"><?php $item['name']?></p >
                                    <b class="price">Giảm giá: 6.090.000 đ</b><br>
                                    <b class="sale">Giá gốc: 7.000.000 đ</b><br>
                                    <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- </marquee> -->
                </div>
            </div>