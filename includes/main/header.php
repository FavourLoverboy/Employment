<?php
    include('config/DB.php');
    include('config/security.php');
    include('includes/setting.php');
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/main/main.css">
</head>
<body>
