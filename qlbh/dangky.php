<?php
require_once __DIR__. '/autoload.php';
/*$sqlSP="";
if(isset($_POST['tim_kiem'])) {
    $ten=$_POST['tensp_tk'];
    $sqlSP="select  product.*, category.name as ten FROM product LEFT JOIN category on category.id = product.category_id WHERE product.name LIKE '%$ten%'";
}*/
/*$productSP= $db->fetchsql($sqlSP);*/
/*if($productSP==null){
    header('Location:index.php');
}*/
    $data =
    [
        "name" => "", "email" => "", "password" => "","phone" =>"", "address" =>""

    ];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data =
            [
                "name" => postInput('txt_name'),
                "email" => postInput('txt_email'),
                "password" => MD5(postInput('txt_password')),
                "phone" => postInput('txt_phone'),
                "address" => postInput('txt_address')

            ];

        $error = [];

        if(postInput('txt_name') == '')
        {
            $error['txt_name'] = "Nhập đầy đủ họ và tên";
        }
        if(postInput('txt_email') == '')
        {
            $error['txt_email'] = "Nhập email không được để trống";
        }
        if(postInput('txt_password') == '')
        {
            $error['txt_password'] = "Password không được để trống";
        }
        if(postInput('txt_phone') == '')
        {
            $error['txt_phone'] = "Số điện thoại không được đẻ trống";
        }
        if(postInput('txt_address') == '')
        {
            $error['txt_address'] = "Địa chỉ không được trống";
        }

        // $error trống thì không có lỗi
        if (empty($error))
        {
            $isset = $db->fetchOne("users","email = '".$data['email']."' ");
            if (count($isset) > 0 )
            {
                $error['txt_email']  = "Tên email đã tồn tại đã tồn tại";

            }
            else
            {
                $id_insert = $db->insert("users",$data);
                if ($id_insert > 0 )
                {
                    // Thêm mới thành công
                    $_SESSION['success'] = "Đăng thành công và bạn tiếp tục đang nhập";
                    header('location:dangnhap.php');
                }
                else
                {
                    // Thêm mới thất bại
                    $_SESSION['error'] = "Đăng nhập kí thất bại";

                }
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
                                <i class="fa fa-file"></i> <a href="">Đăng ký thành viên</a>
                            </li>
                        </ol>
                    </div>
                    <div class="clearfix"></div>
                    <?php if(isset($_SESSION['error'])) :?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                        </div>
                    <?php endif ; ?>
                </div>
                 <div class="row">
                     <form action="" method="post" class="form-horizontal dangky_css">
                         <div class="form-group">
                             <label class="col-md-2 col-md-offset-1" for="">Tên Thành Viên <span class="do">(*)</span> </label>
                             <div class="col-md-8">
                                 <input type="text" name="txt_name" placeholder="Họ và tên" class="form-control" value="<?php echo $data['name']?>">
                                 <?php if(isset($error['txt_name'])) :?>
                                     <p class="text-danger"><?php echo $error['txt_name']?></p>
                                 <?php endif;?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-2 col-md-offset-1" for="">Email <span class="do">(*)</span> </label>
                             <div class="col-md-8">
                                 <input type="email" name="txt_email" placeholder="user@gmail.com" class="form-control" value="<?php echo $data['email']?>" >
                                 <?php if(isset($error['txt_email']) ):?>
                                     <p class="text-danger"><?php echo $error['txt_email']?></p>
                                 <?php endif;?>
                             </div>

                         </div>
                         <div class="form-group">
                             <label class="col-md-2 col-md-offset-1" for="">Password <span class="do">(*)</span> </label>
                             <div class="col-md-8">
                                 <input type="password" name="txt_password" placeholder="*****" class="form-control" >
                                 <?php if(isset($error['txt_password']) ):?>
                                     <p class="text-danger"><?php echo $error['txt_password']?></p>
                                 <?php endif;?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-2 col-md-offset-1" for="">Số điện thoại <span class="do">(*)</span> </label>
                             <div class="col-md-8">
                                 <input type="number" name="txt_phone" placeholder="0973951802" class="form-control" value="<?php echo $data['phone'] ?>">
                                 <?php if( isset($error['txt_phone'])) :?>
                                     <p class="text-danger"><?php echo $error['txt_phone']?></p>
                                 <?php endif;?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-2 col-md-offset-1" for="">Địa chỉ <span class="do">(*)</span> </label>
                             <div class="col-md-8">
                                 <input type="text" name="txt_address" placeholder="31 Phan Đình Giót, Cầu Giấy, Hà Nội" class="form-control" value="<?php echo $data['address']?>">
                                 <?php if( isset($error['txt_address'])) :?>
                                     <p class="text-danger"><?php echo $error['txt_address']?></p>
                                 <?php endif;?>
                             </div>
                         </div>
                         <button type="submit" class="btn btn-success col-md-2 col-md-offset-5">Đăng Ký</button>
                     </form>
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