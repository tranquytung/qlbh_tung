<?php
    $open = "admin";
    require_once __DIR__. '/../../conn/conn.php';
    /**
    *
    * Danh sách danh mục sản phẩm
    *
    */
    $id = intval(getInput('id'));

    $editAdmin = $db->fetchID("admin",$id);
    if (empty($editAdmin))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("admin");
    }
 

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data =
        [
            "name" => postInput('name'),
            "email" => postInput("email"),
            "phone" => postInput("phone"),
            "address" => postInput("address"),
            "level" => postInput("level")
        ];

        $error = [];

        if(postInput('name') == '')
        {
            $error['name'] = "Mời bạn nhập tên đầy đủ danh mục";
        }
        if(postInput('email') == '')
        {
            $error['email'] = "Email không được để trống";
        }
        else
        {
            if (postInput("email") != $editAdmin['email'])
            {
              $is_check = $db->fetchOne("admin","email = '".$data['email']."' ");
                if($is_check != NULL)
                {
                    $error['email'] = "Email đã tồn tại";
                }  
            }
            
        }
        
        if(postInput('phone') == '')
        {
            $error['phone'] = "Phone không được để trống ";
        }      
        if(postInput('address') == '')
        {
            $error['address'] = "Địa chỉ không được không để trống";
        }
         if(postInput('level') == '')
        {
            $error['level'] = "Mời bạn nhập tên đầy đủ danh mục";
        }

         if (postInput('password') != NULL && postInput('re_password') != NULL )
        {
            if (postInput('password') != postInput('re_password'))
            {
                $error[password] = " Mật khẩu thay đổi không khớp ";
            } 
            else
            {
                $data['password'] = MD5(postInput('password'));
            }
        }

        
        // $error trống thì không có lỗi
        if (empty($error))
        {
            

            $id_update = $db->update("admin",$data,array("id"=>$id));
            if($id_update > 0 )
            {	
            	$_SESSION['success'] = "Cập nhật thành viên thành công";
            	redirectAdmin("admin");
            }
            else
            {
            	$_SESSION['error'] = "Cập nhật thành viên thất bại";
                redirectAdmin("admin");

            }
            
        }
    }

 ?>

<?php require_once __DIR__. '/../../themes/header.php'; ?>
    <!-- Nội dung cần thay đổi -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Sửa admin
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Bảng điều khiển</a>
                </li>
                <li>
                    <i></i><a href="<?php echo base_url(); ?>admin/modules/product">Thành viên</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Sửa thành viên
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
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
            	 <div class="form-group"> <!-- Họ tên -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Họ tên <span class="do">(*)</span>  </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Họ tên" name="name" value="<?php echo $editAdmin['name'] ?>">
                      <?php if (isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>

                  <div class="form-group"> <!-- Thêm tên giá sản phẩm -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Email <span class="do">(*)</span>  </label>
                    <div class="col-sm-4">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email - havietnet@gmail.com" name="email" value="<?php echo $editAdmin['email'] ?>">
                        <?php if (isset($error['email'])): ?>
                            <p class="text-danger"><?php echo $error['email'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>

                  <div class="form-group"> <!-- Password -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Password <span class="do">(*)</span> </label>
                    <div class="col-sm-3">
                      <input type="password" class="form-control" id="inputEmail3" placeholder="**********" name="password">
                      <?php if (isset($error['password'])): ?>
                            <p class="text-danger"><?php echo $error['password'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>

                    <div class="form-group"> <!-- Nhập lại Password -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Nhập lại password <span class="do">(*)</span>  </label>
                    <div class="col-sm-3">
                      <input type="password" class="form-control" id="inputEmail3" placeholder="**********" name="re_password">
                      <?php if (isset($error['re_password'])): ?>
                            <p class="text-danger"><?php echo $error['re_password'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>

                  <div class="form-group"> <!-- Phone -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Phone <span class="do">(*)</span> </label>
                    <div class="col-sm-3">
                      <input type="number" class="form-control" id="inputEmail3" placeholder="0962202023" name="phone" value="<?php echo $editAdmin['phone'] ?>">
                      <?php if (isset($error['phone'])): ?>
                            <p class="text-danger"><?php echo $error['phone'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>  

                  <div class="form-group"> <!-- Địa chỉ -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Địa chỉ <span class="do">(*)</span>  </label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="Địa chỉ" name="address" value="<?php echo $editAdmin['address'] ?>">
                      <?php if (isset($error['address'])): ?>
                            <p class="text-danger"><?php echo $error['address'] ?></p>
                        <?php endif ?>
                    </div>
                  </div>   

                   <div class="form-group"> <!-- Level  -->
                    <label for="inputEmail3" class="col-sm-2 control-label">Trạng thái <span class="do">(*)</span>  </label>
                    <div class="col-sm-4">
                      <select class="form-control" name="level">
                          <option value="1" <?php echo isset($data['level']) && $data['level'] == 1 ? "selected = 'selected' " : '' ?>>Admin</option>
                          <option value="2" <?php echo isset($data['level']) && $data['level'] == 2 ? "selected = 'selected' " : '' ?>>CTV</option>
                      </select>
                      <?php if (isset($error['level'])): ?>
                            <p class="text-danger"><?php echo $error['level'] ?></p>
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
