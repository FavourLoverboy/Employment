<?php
    // Logout
    session_start();
    session_destroy();
    if($_SESSION['level'] == 'admin'){
        header('location: admin');
    }elseif($_SESSION['level'] == 'referral'){
        header('location: referral');
    }else{
        header('location: login');
    }
?>