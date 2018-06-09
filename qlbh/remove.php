<?php
    session_start();
    $key=intval($_GET['key']);
    unset($_SESSION['cart'][$key]);
    header('Location:gio_hang.php');
?>