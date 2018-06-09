<?php 
    @ob_start();
    session_start();
    require_once 'lib/database.php';
    require_once 'lib/function.php';

    $db = new Database ;

    define("ROOT",$_SERVER['DOCUMENT_ROOT'] . "/qlbh/public/uploads/");
    
    $category = $db->fetchAll('category');

    /*lay danh muc hien thi hay khong*/
    $sqlHome = "SELECT * FROM category WHERE home=1 ORDER BY updated_at";
    $sqlHome=$db->fetchsql($sqlHome);



    /**
    * lấy danh sách sản phẩm mới
    */

    $sqlNew = "SELECT  product.*, category.name as namete,home FROM product LEFT JOIN category on category.id = product.category_id WHERE home=1 AND new=1 LIMIT 4";
    $productNew = $db->fetchsql($sqlNew);

    /*lay san pham kuyen mai*/
    /*$sqlKM="SELECT * FROM product WHERE sale > 0";*/
    $sqlKM="SELECT product.*, category.name as namecate ,home FROM product LEFT JOIN category on category.id = product.category_id WHERE sale > 0 AND home=1 ORDER BY ID DESC LIMIT 4";
    $productKM=$db->fetchsql($sqlKM);

    // sanpham ban chay

    $sql_bc="select * from product order by  pay DESC Limit 4 ";
    $banchay_sql=$db->fetchsql($sql_bc);

?>