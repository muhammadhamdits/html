<?php
    if(isset($_POST['pilihan'])){
        $p = $_POST['pilihan'];
        if($p == 1){
            header('Location: http://webgista.ddns.net/mysql_8');
        } else if($p == 2){
            header('Location: http://webgista.ddns.net/postgresql_12');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Pariwsata Halal Bukittinggi">
    <meta name="keyword" content="Pariwisata Halal, Bukittinggi">
    <title>Pariwisata Halal Bukittinggi</title>

    <!-- Bootstrap core CSS -->
    <link href="mysql_8/tourism_bkt/assets/css/bootstrap.css" rel="stylesheet">

    <!--external css-->
    <link href="mysql_8/tourism_bkt/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="mysql_8/tourism_bkt/assets/css/style.css" rel="stylesheet">
    <link href="mysql_8/tourism_bkt/assets/css/style-responsive.css" rel="stylesheet">
</head>

<body>
    <form class="form-login" action="" method="post">
        <h2 class="form-login-heading" style="background:#ffd777;border-color:white">Pariwisata Bukittinggi</h2>
        <div class="login-wrap">       
            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="pilihan" name="pilihan">
                <option value="1">MySQL 8</option>
                <option value="2">PostgreSQL 12</option>
            </select>
            <hr>
            <button type="submit" class="btn btn-theme btn-block"style="background:#ffd777;border-color:white">Pilih</button>   
        </div>
    </form>     

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="mysql_8/tourism_bkt/assets/js/jquery.js"></script>
    <script src="mysql_8/tourism_bkt/assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="mysql_8/tourism_bkt/assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("mysql_8/tourism_bkt/assets/img/say.png", {speed: 500});
    </script>
</body>

<!-- Mirrored from demo.gridgum.com/templates/AdminDashboard/DashGum/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2017 13:34:16 GMT -->
</html>