<?php
    $open = "transactions";
    
    require_once __DIR__. '/../../conn/conn.php';

   $id = intval(getInput('id'));

    $transaction = $db->fetchID("transaction",$id);
    $status = $transaction['status'] == 0 ? 1 : 0;

    $up = $db->update('transaction',array('status' => $status),array("id"=>$id));
    if($up > 0){
        $_SESSION['success'] = " Cập nhật thành công ";
        $sql="select product_id, qty from orders WHERE transaction_id=$id";
        $Order=$db->fetchsql($sql);
        foreach ($Order as $item){
            $idproduct=intval($item['product_id']);
            $product=$db->fetchID('product',$idproduct);
            $number=$product['number']-$item['qty'];
            $up_prouduct=$db->update("product",array('number'=>$number,'pay'=>$product['pay']+$item['qty']),array('id'=>$idproduct));
        }
        redirectAdmin("transactions");
    }else{
        $_SESSION['success'] = " Dữ liệu cập nhật thất bại ";
        redirectAdmin("transactions");
    }

 ?>