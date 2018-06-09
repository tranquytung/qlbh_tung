<?php
    require_once "autoload.php";
    /**
     *  xử lý giỏ hàng
     */
    $qty     = postInput('qty');
    $key     = postInput('key');

    // echo $idqty .$idproduct;

    if($qty > 0){
        $product = $db->fetchID("product",$key);

        if($product['number'] >= $qty)
        {
            $_SESSION['cart'][$key]['qty'] = $qty;
            echo 1;
        }

   }
?>