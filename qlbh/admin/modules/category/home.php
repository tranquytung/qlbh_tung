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
    $home = $editCategory['home'] == 0 ? 1 : 0;

    $update = $db->update("category",array("home"=>$home),array("id"=>$id));
    if ($update > 0 )
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

 ?>