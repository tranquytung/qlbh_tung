<?php
$open = "product";
require_once __DIR__. '/../../conn/conn.php';
/**
 *
 * Danh sách danh mục sản phẩm
 *
 */
$category = $db->fetchAll("category");


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $data =
        [
            "name" => postInput('name'),
            "slug" => to_slug(postInput("name")),
            "category_id" => postInput("category_id"),
            "price" => postInput("price"),
            "sale" => postInput("sale"),
            "number"=>postInput("soluong"),
            "new" => postInput("new"),
            "content" => postInput("content")
        ];

    $error = [];

    if(postInput('name') == '')
    {
        $error['name'] = "Mời bạn nhập tên đầy đủ danh mục";
    }

    if(postInput('category_id') == '')
    {
        $error['category_id'] = "Mời bạn chọn danh mục sản phẩm";
    }

    if(postInput('price') == '')
    {
        $error['price'] = "Mời bạn nhập giá sản phẩm";
    }
    if(postInput('soluong') == '')
    {
        $error['soluong'] = "Mời bạn nhập số lượng sản phẩm";
    }
    if(postInput('content') == '')
    {
        $error['content'] = "Mô tả sản phẩm";
    }
    if(!isset($_FILES['thunbar']))
    {
        $error['thunbar'] = "Hình sản phẩm không để trống";
    }

    // $error trống thì không có lỗi
    if (empty($error))
    {
        if (isset($_FILES['thunbar']))
        {
            $file_name = $_FILES['thunbar']['name'];
            $file_tmp = $_FILES['thunbar']['tmp_name'];
            $file_type = $_FILES['thunbar']['type'];
            $file_error = $_FILES['thunbar']['error'];
            $part = ROOT . "/product/";
            move_uploaded_file($file_tmp,$part.$file_name);
            if ($file_error == 0 )
            {
                $data['thunbar'] = $file_name;
                $id_insert = $db->insert("product",$data);
                if($id_insert)
                {

                    $_SESSION['success'] = "Thêm mới sản phẩm thành công";
                    redirectAdmin("product");
                }
                else
                {
                    $_SESSION['error'] = "Thêm mới sản phẩm thất bại";

                }
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
            Thêm mới sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Bảng điều khiển</a>
            </li>
            <li>
                <i></i><a href="<?php echo base_url(); ?>admin/modules/product">Sản phẩm</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Thêm mới sản phẩm
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
            <div class="form-group"> <!-- Danh mục sản phẩm -->
                <label for="inputEmail3" class="col-sm-2 control-label">Danh mục <span class="do">(*)</span></label>
                <div class="col-sm-10">
                    <select class="form-control col-md-10" name="category_id">
                        <option value=""> - Chọn danh mục sản phẩm - </option>
                        <?php foreach ($category as $item): ?>
                            <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <?php if (isset($error['category'])): ?>
                        <p class="text-danger"><?php echo $error['category'] ?></p>
                    <?php endif ?>
                </div>
            </div>

            <div class="form-group"> <!-- Thêm tên sản phẩm -->
                <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm <span class="do">(*)</span> </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập danh mục cần thêm" name="name">
                    <?php if (isset($error['name'])): ?>
                        <p class="text-danger"><?php echo $error['name'] ?></p>
                    <?php endif ?>
                </div>
            </div>

            <div class="form-group"> <!-- Thêm tên giá sản phẩm -->
                <label for="inputEmail3" class="col-sm-2 control-label">Giá sản phẩm <span class="do">(*)</span>  </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" placeholder="Nhập giá sản phẩm" name="price">
                    <?php if (isset($error['price'])): ?>
                        <p class="text-danger"><?php echo $error['price'] ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group"> <!-- Thêm tên so luong sản phẩm -->
                <label for="inputEmail3" class="col-sm-2 control-label">Số lượng sản phẩm <span class="do">(*)</span>  </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputEmail3" placeholder="Nhập số lượng sản phẩm" name="soluong">
                    <?php if (isset($error['soluong'])): ?>
                        <p class="text-danger"><?php echo $error['soluong'] ?></p>
                    <?php endif ?>
                </div>
            </div>

            <div class="form-group"> <!-- Giá sale -->
                <label for="inputEmail3" class="col-sm-2 control-label">Giảm giá : </label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="inputEmail3" placeholder="10%" name="sale" value="0">
                </div>
            </div>

            <div class="form-group"> <!-- Hình ảnh -->
                <label for="inputEmail3" class="col-sm-2 control-label">Hình ảnh <span class="do">(*)</span> </label>
                <div class="col-sm-3">
                    <input type="file" class="form-control" id="inputEmail3" name="thunbar">
                    <?php if (isset($error['thunbar'])): ?>
                        <p class="text-danger"><?php echo $error['thunbar'] ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group"> <!-- sp mơi  -->
                <label for="inputEmail3" class="col-sm-2 control-label"> Sản phẩm mới : </label>
                <div class="col-sm-3">
                    <select class="form-control" name="new">
                        <option value="0" <?php echo isset($data['new']) && $data['new'] == 0 ? "selected = 'selected' " : '' ?>> Không </option>
                        <option value="1" <?php echo isset($data['new']) && $data['new'] == 1 ? "selected = 'selected' " : '' ?>> Có </option>
                    </select>
                </div>
            </div>

            <div class="form-group"> <!-- Content mô tả sản phẩm -->
                <label for="inputEmail3" class="col-sm-2 control-label">Mô tả sản phẩm <span class="do">(*)</span>  </label>
                <div class="col-sm-10">
                    <textarea class="form-control"  id="nd" name="content" rows="10"></textarea>
                    <?php if (isset($error['content'])): ?>
                        <p class="text-danger"><?php echo $error['content'] ?></p>
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
<script>
    config={};
    config.entities_latin=false;
    config.language="vi";
    CKEDITOR.replace('nd',config);
</script>