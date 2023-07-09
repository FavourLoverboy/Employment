<?php 
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    include('config/DB.php');
    include('config/security.php');
    $dbObj = new DB();
    $secObj = new Security();
?>
<!DOCTYPE html>
<head>
    <base href="http://localhost/employment/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/icon/favicon.ico">

    <!-- CDNs -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/auth/auth.css">
</head>
<body>
    <div class="overlay"></div>
