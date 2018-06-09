<?php
    require_once "conn/conn.php";
    unset($_SESSION['is_login']);
    unset($_SESSION['username']);
    header('location:login.php');