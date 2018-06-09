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

    // Kiểm tra danh mục sản phẩm chưa
    $is_product = $db->fetchOne("product"," category_id = $id ");
    if ($is_product == NULL )
    {
        $num = $db->delete("category",$id);
        if ($num > 0 )
        {
            $_SESSION['success'] = "Xóa thành công";
            redirectAdmin("category");
        }
        else
        {
            $_SESSION['error'] = "Xóa thất bại";
            redirectAdmin("category");
        }
    }
    else
    {
        $_SESSION['error'] = "Danh mục có sản phẩm ! bạn không thể xóa";
        redirectAdmin("category");
    }

 ?>
