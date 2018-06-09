<?php

    $open = "category";
    require_once __DIR__. '/../../conn/conn.php';
    $id = intval(getInput('id'));

    $editCategory = $db->fetchID("category",$id);
    if (empty($editCategory))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("category");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data =
        [
            "name" => postInput('name'),
            "slug" => to_slug(postInput("name"))
        ];

        $error = [];

        if(postInput('name') == '')
        {
            $error['name'] = "Mời bạn nhập tên đầy đủ danh mục";
        }

        // $error trống thì không có lỗi
        if (empty($error))
        {
           if ($editCategory['name'] != $data['name'])
           {
                $isset = $db->fetchOne("category","name = '".$data['name']."' ");
                if (count($isset) > 0 )
                {
                    $_SESSION['error'] = "Tên danh mục đã tồn tại";
                }
                else 
                    {
                        $id_update = $db->update("category",$data,array('id'=>$id));
                        if ($id_update > 0 )
                        {
                            // Sửa thành công 
                            $_SESSION['success'] = "Cập nhật thành công";
                            redirectAdmin("category");
                        }
                        else
                        {
                            // Cập nhật thất bại 
                            $_SESSION['error'] = "Cập nhật thất bại ";
                            redirectAdmin("category");
                         }
                    }
            } 
            else 
            {
                $id_update = $db->update("category",$data,array('id'=>$id));
                if ($id_update > 0 )
                {
                    // Sửa thành công 
                    $_SESSION['success'] = "Cập nhật thành công";
                    redirectAdmin("category");
                }
                else
                {
                    // Cập nhật thất bại 
                    $_SESSION['error'] = "Cập nhật thất bại ";
                    redirectAdmin("category");
                 }
             }

        }
    }

 ?>

<?php require_once __DIR__. '/../../themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Thêm mới danh mục
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <i></i><a href="<?php echo base_url(); ?>admin/modules/category">Danh mục</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Sửa danh mục
                </li>
            </ol>
            <div class="clearfix"></div>
            <?php if(isset($_SESSION['error'])) :?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
                </div>
            <?php endif ; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST" action="">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên danh mục <span class="do">(*)</span>  </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập danh mục cần thêm" name="name" value="<?php echo $editCategory['name'] ?>">
                      <?php if (isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                      <button type="submit" class="btn btn-success">Lưu</button>
                    </div>
                  </div>
            </form>
        </div>
    </div>
    <!-- /.row kết thúc nội dung  -->
<?php require_once __DIR__. '/../../themes/footer.php'; ?>
