<?php
    $open = "product";
    
    require_once '../../conn/conn.php';


    if(isset($_GET['page']))
    {
        $trang = $_GET['page'];
    }
    else
    {
        $trang = 1;
    }

    $sql = "SELECT product.*, category.name as namecate FROM product LEFT JOIN category on category.id = product.category_id ORDER BY pay DESC ";
    $product = $db->fetchJone('product',$sql,$trang,10,true);


    if(isset($product['page']))
    {
        $sotrang = $product['page'];
        unset($product['page']);
    }

 ?>

<?php require_once __DIR__. '/../../themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Danh sách sản phẩm
                <a class="btn btn-success" href="add_product.php">Thêm mới</a>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url() ?>admin">Bảng điều khiển</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Sản phẩm
                </li>
            </ol>
            <!-- Thông báo không lỗi -->
            <?php if(isset($_SESSION['success'])) :?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
                </div>
            <?php endif ; ?>
            <!-- Thông báo lỗi  -->
            <?php if(isset($_SESSION['error'])) :?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                </div>
            <?php endif ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1" >STT</th>
                            <th class="col-md-1" >Danh mục</th>
                            <th class="col-md-1" >Hình ảnh</th>
                            <th class="col-md-1" >Tên sản phẩm</th>
                            <th class="col-md-1" >Giá</th>
                            <th class="col-md-1" >Đã Bán</th>
                            <th class="col-md-1" >Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($product as $item): ?>
                            <tr>
                            <td ><?php echo $stt ?></td>
                            <td><?php echo $item['namecate'] ?></td>
                            <td><img src="<?php echo uploads() ?>product/<?php echo $item['thunbar'] ?>" width="80px" height="80px"></td>
                            <td><?php echo $item['name'] ?></td>
                            <td>
                                <ul>
                                    <li>Giá: <?php echo formatprice($item['price']); ?> đồng</li>
                                    <li>Số Lượng:<?php echo $item['number'] ?></li>
                                    <li class="<?php echo $item['new']==0 ? 'hidden' : ' '?>" style="color: red"><?php echo $item['new']==1 ? 'sản phẩm mới' : ' '?></li>
                                </ul>
                            </td>
                            <!--<td id="fix_nd"><?php /*echo $item['content'] */?></td>-->
                            <td id="fix_nd"><?php echo $item['pay'] ?> sp </td>
                            <td>
                                <a class="btn btn-xs btn-success" href="edit_product.php?id=<?php echo $item['id'] ?>">Sửa</a>
                                <a class="btn btn-xs btn-danger" href="delete_product.php?id=<?php echo $item['id'] ?>">Xóa</a>
                            </td>
                        </tr>
                        <?php $stt++ ; endforeach ?>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="pull-right">
        <nav aria-label="Page navigation">
            <?php if($sotrang > 1) :?>
              <ul class="pagination">
                <li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php for( $i = 1 ; $i <= $sotrang ; $i ++ )  :?>
                    <li class="<?= $i == $_GET['page'] ? 'active' : ''?>">
                        <a href="?page=<?= $i ?>"> <?= $i ?></a>
                    </li>
                <?php endfor ;?>
                <li>
                <a href="" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
          <?php endif ; ?>
        </nav>
    </div>
    <!-- /.row kết thúc nội dung  -->
<?php require_once __DIR__. '/../../themes/footer.php'; ?>
