<?php require_once "conn/conn.php";

   if($_SERVER['REQUEST_METHOD']=='POST'){
       $email=$_POST['email'];
       $password=MD5($_POST['pass']);

       $sqlLogin="select * from admin WHERE email = '$email' AND password = '$password'";
       $accounts = $db->fetchsql($sqlLogin);
       var_dump($accounts);
       if (count($accounts) == 0){
          $_SESSION['error'] = "Username và password không hợp lệ";

       }else if(count($accounts) == 1){

           $_SESSION['is_login'] = true;
           $_SESSION['username'] =$accounts[0]['name'];
           header('location:index.php');
       }
   }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/bootstrap.css">
    <style>
        .dangnhap{
            margin-top:50px;
            text-align: center;
        }
        .dangnhap form{
            text-align: left;
            padding: 5px;
        }
        #anh{
            width: 60%;
            border-radius: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 dangnhap" >

               <img id="anh" class="" src="../public/img/acount.jpg" />

                <form class="form-horizontal" method="POST" action="" >
                    <label for="inputEmail3" class="control-label">Email : </label>

                    <input type="text" id="inputEmail" class="form-control" placeholder="email" name="email">

                    <label for="inputEmail3" class="control-label">Mật Khẩu: </label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="password" name="pass" > <br>
                    <button class="btn btn-lg btn-primary btn-block " type="submit">Đăng Nhập</button>
                </form><!-- /form -->
            </div>

        </div>
    </div>
</body>
</html>