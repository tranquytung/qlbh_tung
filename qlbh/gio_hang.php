<?php
    require_once  "autoload.php";
    /**
     *  xử lý giỏ hàng
     */
    if( ! isset($_SESSION['cart']) || count($_SESSION['cart']) == 0)
    {
        echo " <script>alert('Không tồn tại giỏ hàng hoặc không có sản phẩm nào trong giỏ hàng !'); location.href='index.php';</script>";
    }
    $_SESSION['sum']  = 0;
    ?>

    <style type="text/css">
        .btn:hover { cursor: pointer !important;color: white !important }
        .btn {color: white !important }
    </style>
    <?php
   /* $sqlHome = "SELECT name , id FROM category WHERE home = 1 ";
    $categoryHome = $db->fetchsql($sqlHome);

    $data = [];

    foreach ($categoryHome as $item) {
        $cateID = intval($item['id']);
        $sql = "SELECT * FROM product WHERE category_id = $cateID";
        $productHome = $db->fetchsql($sql);
        $data[$item['name']] = $productHome;
    }*/

    if(isset($_SESSION['name_id'])){
        $id_user=intval($_SESSION['name_id']);
        $sql_user="select * from users WHERE id='$id_user'";
        $ht_user=$db->fetchsql($sql_user);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data =
            [
                'user_name' => postInput('user_name'),
                'email'     => postInput('user_email'),
                'address'   => postInput('user_address'),
                'phone'     => postInput('user_phone'),
                'message'   => postInput('message'),
                'amount'    => $_SESSION['sum']
            ];
        $id_transaction = $db->insert("transaction",$data);
        if($id_transaction)
        {
            foreach($_SESSION['cart'] as $m => $l)
            {
                $data2 = [
                    'product_id'     => $m,
                    'transaction_id' => $id_transaction,
                    'qty'           => $l['qty'],
                    'price'         => $l['price']
                ];
                $id_instart2 = $db->insert("orders",$data2);
                if($id_instart2) unset($_SESSION['cart']);
                echo " <script>alert(' Xác nhận thanh toán thành công  !'); location.href='index.php';</script>";
            }
        }
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
                                <i class="fa fa-file"></i> <a href="">Giỏ hàng của bạn</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class=" table table-responsive table-bordered " >
                            <thead>
                            <tr class="active">
                                <td>STT</td>
                                <td>Tên sản phẩm</td>
                                <td>Hình Ảnh</td>
                                <td>Số lượng</td>
                                <td>Giá</td>
                                <td>Thành Tiền</td>
                                <td>Thao Tác</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  $stt=1; foreach($_SESSION['cart'] as $key => $value) :?>
                                <tr>
                                    <td><?php echo  $stt ?></td>
                                    <td><?php echo  $value['name']?></td>
                                    <td>
                                        <img src="<?php echo uploads() ?>product/<?php echo $value['thunbar'] ?>" alt="" width="80px" height="80px" >
                                    </td>
                                    <td>
                                        <input type="number" name="" value="<?php echo $value['qty'] ?>" class="form-control" style="width: 60px;" id="qty" min="1" max="10">
                                    </td>
                                    <td><?php echo formatprice($value['price']) ?></td>
                                    <td><?php echo formatprice($value['price']*$value['qty']) ?> đ</td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="remove.php?key=<?= $key ?>" data-id="<?php echo $key ?>" > Remove </a>
                                        <a class="btn btn-xs btn-info updatecarts" data-key="<?php echo $key ?>"> Update </a>
                                    </td>

                                </tr>
                                <?php $_SESSION['sum'] += $value['qty']*$value['price'] ?>
                                <?php $stt++; endforeach;?>
                                <tr>
                                    <td colspan="4"> <a href="index.php" class="btn btn-success"> Tiếp tục mua hàng </a> </td>
                                    <td colspan="3"> Tổng tiền :  <span class="badge"><?php echo formatprice($_SESSION['sum']) ?> đ</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <form class="form-horizontal" method="post" action="">

                            <!--SHIPPING METHOD-->
                            <div class="panel panel-success">
                                <div class="panel-heading">Thông tin khách hàng </div>
                                <div class="panel-body">
                                    <?php if(isset($_SESSION['name_id'])) :?>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Họ và Tên :</strong></div>
                                        <div class="col-md-12">
                                            <input type="text"  class="form-control" name="user_name" value="<?php echo $ht_user['0']['name']?>" required=""/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-xs-12">
                                            <strong> Số điện thoại  </strong> <span class="do">(*)</span>
                                            <input type="number"  name="user_phone" class="form-control" value="<?php echo $ht_user['0']['phone']?>" required=""/>
                                        </div>
                                        <div class="span1"></div>
                                        <div class="col-md-12  col-xs-12">
                                            <strong>Email </strong>
                                            <input type="email" name="user_email" class="form-control" value="<?php echo $ht_user['0']['email']?>" required=""/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><label>Địa chỉ <span class="do">(*)</span> </label></div>
                                        <div class="col-md-12">
                                            <input type="text"  name="user_address" class="form-control" value="<?php echo $ht_user['0']['address']?>" required="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12"><strong> Ghi chú </strong></div>
                                        <div class="col-md-12">
                                            <textarea name="message" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <?php elseif (!isset($_SESSION['name_id'])) : ?>
                                    <div class="form-group">
                                        <div class="col-md-12"><strong>Họ và Tên </strong> <span class="do">(*)</span> </div>
                                        <div class="col-md-12">
                                            <input type="text"  class="form-control" name="user_name" value="" required=""/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-xs-12">
                                            <strong> Số điện thoại </strong> <span class="do">(*)</span>
                                            <input type="number"  name="user_phone" class="form-control" value="" required=""/>
                                        </div>
                                        <div class="span1"></div>
                                        <div class="col-md-12  col-xs-12">
                                            <strong>Email </strong> <span class="do">(*)</span>
                                            <input type="email" name="user_email" class="form-control" value="" required=""/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><label>Địa ch:</label> <span class="do">(*)</span> </div>
                                        <div class="col-md-12">
                                            <input type="text"  name="user_address" class="form-control" value="" required="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12"><strong> Ghi chú </strong></div>
                                        <div class="col-md-12">
                                            <textarea name="message" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                </div>

                            <!--SHIPPING METHOD END-->
                        </div>
                        <div class=" col-md-4 clearfix col-md-offset-9">
                            <input type="submit" name="" class="btn btn-success" value=" Xác nhận thanh toán ">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('themes/footer.php') ?>

<script type="text/javascript">
    // cập nhật giỏ hàng
    $url = '/qlbh/gio_hang.php';
    $(function(){
        $updatecarts = $(".updatecarts");
        $updatecarts.click(function(){
            $key = $(this).attr("data-key");
            $qty = $(this).parents('tr').find("#qty").val();
            $.ajax({
                url:'cap-nhat-don-hang.php',
                type:"post",
                data:{'qty':$qty,'key':$key},
                success:function(data)
                {
                    console.log(data);
                    if(data == 1)
                    {
                        alert(' Cập nhật thành công!'); location.href=$url;

                    }
                    else
                    {
                        alert(' Cập nhật thất bại ! Số lượng mua lớn hơn số lượng còn hay là giá trị âm'); location.href=$url;

                    }
                }
            })
        })
    })
</script>

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