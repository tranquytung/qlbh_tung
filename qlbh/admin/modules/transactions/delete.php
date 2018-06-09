<?php
    $open = "transactions";

    require_once '../../conn/conn.php';

    $id = intval(getInput('id'));

    $editProduct = $db->fetchID("transaction",$id);

    if (empty($editProduct))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("transaction");
    }

    $num = $db->delete("transaction",$id);
    if ($num > 0 )
    {
        $_SESSION['success'] = "Xóa thành công";
        redirectAdmin("transactions");
    }
    else
    {
        $_SESSION['error'] = "Xóa thất bại";
        redirectAdmin("transactions");
    }

 ?>
