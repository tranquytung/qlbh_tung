<?php
    $open = "users";

    require_once __DIR__. '/../../conn/conn.php';

    $id = intval(getInput('id'));

    $editAdmin = $db->fetchID("users",$id);

    if (empty($editAdmin))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("users");
    }

    $num = $db->delete("users",$id);
    if ($num > 0 )
    {
        $_SESSION['success'] = "Xóa thành công";
        redirectAdmin("users");
    }
    else
    {
        $_SESSION['error'] = "Xóa thất bại";
        redirectAdmin("users");
    }

 ?>
