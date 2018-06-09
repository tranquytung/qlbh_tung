<?php
    require_once ('autoload.php');
   /* if(!isset($_SESSION['name_id'])){
        echo "<script>alert('Bạn phải đăng nhập với thực hiện được chức năng này');location.href='dangnhap.php'</script>";
    }else{*/
        $id=intval(getInput('id'));

        $product=$db->fetchID('product',$id);

        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['qty']+=1;
        }else{
            if ( $product['price'] > 0)
            {
                $price = $product['price'] * (100 - $product['sale'] ) /  100  ;
            }
            $_SESSION['cart'][$id]['name']=$product['name'];
            $_SESSION['cart'][$id]['thunbar']=$product['thunbar'];
            $_SESSION['cart'][$id]['price']=$price;
            $_SESSION['cart'][$id]['qty']=1;
        }
        echo "<script>alert('Thêm sản phẩm vào giỏ hàng thành công');location.href='gio_hang.php'</script>";
   /* }*/

