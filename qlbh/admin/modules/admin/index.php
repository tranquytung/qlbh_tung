<?php
    $open = "admin";
    
    require_once __DIR__. '/../../conn/conn.php';

    if(isset($_GET['page']))
    {
        $trang = $_GET['page'];
    }
    else
    {
        $trang = 1;
    }

    $sql = "SELECT admin.* FROM admin ORDER BY ID DESC ";
    $admin = $db->fetchJone('admin',$sql,$trang,4,true);

    if(isset($admin['page']))
    {
        $sotrang = $admin['page'];
        unset($admin['page']);
    }

 ?>

<?php require_once __DIR__. '/../../themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Danh sách admin
                <a class="btn btn-success" href="add_admin.php">Thêm mới</a>
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
                            <th>STT</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Trạng thái</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt=1; foreach ($admin as $item): ?>
                            <tr>
                                <td><?php echo $stt ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td><?php echo $item['phone']; ?></td>
                                <td><?php echo $item['level'] == 1 ? "Admin" : "Nhân viên";?></td>
                               <td>
                                    <a class="btn btn-xs btn-success" href="edit_admin.php?id=<?php echo $item['id'] ?>">Sửa</a>
                                    <a class="btn btn-xs btn-danger" href="delete_admin.php?id=<?php echo $item['id'] ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php $stt++ ; endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pull-right">
            <nav aria-label="Page navigation">
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
            </nav>
        </div>
    </div>

    <!-- /.row kết thúc nội dung  -->
<?php require_once __DIR__. '/../../themes/footer.php'; ?>
