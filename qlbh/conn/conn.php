<?php 
	@ob_start();
	session_start();
	require_once __DIR__. '/../lib/database.php';
	require_once __DIR__. '/../lib/function.php';
	
	$db = new Database ;

	define("ROOT",$_SERVER['DOCUMENT_ROOT'] . "/qlbh/public/uploads/product/");
	
	$category = $db->fetchAll('category');

	/**
	*
	* lấy danh sách sản phẩm mới
	*/

	$sqlNew = "SELECT * FROM product WHERE 1 ORDER BY ID DESC LIMIT 3";
	$productNew = $db->fetchsql($sqlNew);
?>