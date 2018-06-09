<?php
	@ob_start(); 
	session_start();
    require_once __DIR__. '/../../lib/database.php';
    require_once __DIR__. '/../../lib/function.php';

    /* if( !  isset($_SESSION['admin-id']))
    {
        redirect('admin-login/');
    }*/
	$db = new Database ;

	define("ROOT",$_SERVER['DOCUMENT_ROOT'] . "/qlbh/public/uploads/");
	//_debug(ROOT);
?>