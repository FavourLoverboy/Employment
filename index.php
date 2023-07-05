<?php
    // if(session_status() !== PHP_SESSION_ACTIVE) {
    //     session_start();
    // }
    // error_reporting(E_ALL & ~E_NOTICE);
    date_default_timezone_set("Africa/Lagos");
    
    // Check if the "url" parameter exists in $_GET
    if(isset($_GET['url'])) {
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);
    
        if($url[0] == ""){
            include('login.php');
        } 
    
        $file_path = $url[0];
    
        if(file_exists("views/$file_path/$url[1].php")){
            $page = "views/$file_path/$url[1].php";
            include('main.php');
        }elseif(!file_exists("views/$file_path/$url[1].php") && $url[0] != "") {
            include("404.php");
        }
    }else{
        // Handle the case when "url" parameter is not present
        include('login.php');
    }
?>
