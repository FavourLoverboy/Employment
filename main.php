<?php
    session_start();
    if(!$_SESSION['email']){
        header('location: ../');
    }

    include('includes/main/header.php');

    if($_SESSION['level'] == 'admin'){
        include('includes/titles/admin.php');
        if($url[0] != 'a'){
            header("location: ../a/dashboard");
        }
    }elseif($_SESSION['level'] == 'referral'){
        include('includes/titles/referral.php');
        if($url[0] != 'r'){
            header("location: ../r/dashboard");
        }
    }else{
        include('includes/titles/user.php');
        if($url[0] != 'user'){
            header("location: ../user/dashboard");
        }
    }

    include('includes/navs/sidebar.php');

    // Code Start Here
        include($page);
    // Code End Here

    include ('includes/main/footer.php');
    
?>