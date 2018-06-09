<?php
    $open = "transactions";
    
    require_once  '../../conn/conn.php';
    $id = intval(getInput('id'));
    if(isset($_GET['page']))
    {
        $trang = $_GET['page'];
    }
    else
    {
        $trang = 1;
    }

    $sql = "SELECT orders.*,product.* FROM orders join product on product.id = orders.product_id where orders.transaction_id ='$id'";
    $ordersSql=$db->fetchsql($sql);

    $orders = $db->fetchJone('orders',$sql,$trang,4,false);

    if(isset($orders['page']))
    {
        $sotrang = $orders['page'];
        unset($orders['page']);
    }

 ?>

<?php require_once __DIR__. '/../../themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Danh sách đơn hàng
                
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url() ?>users">Bảng điều khiển</a>
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
                            <th>STT</th>
                            <th>Tên sp </th> 
                            <th>Giá sp </th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($ordersSql as $item): ?>
                            <tr>
                                <td><?php echo $stt ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['price']; ?></td>
                                <td><?php echo $item['qty']; ?></td>
                        
                            </tr>  
                        <?php $stt++ ; endforeach ?>
                                                          
                    </tbody>
                </table>
            </div>
             <div class="pull-right">
                <nav aria-label="Page navigation">
                    <?php if(isset($sotrang) && $sotrang > 1) :?>
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
        </div>
    </div>
   
    <!-- /.row kết thúc nội dung  -->
<?php require_once __DIR__. '/../../themes/footer.php'; ?>
