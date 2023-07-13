<?php 

    if($url[1] == 'dashboard'){
        $link_dashboard = 'active';
        echo "<title>Dashboard | Nack </title>";
    }elseif($url[1] == 'enrolled'){
        $link_enrolled = 'active';
        echo "<title>Enrolled | Nack </title>";
    }elseif($url[1] == 'job' || $url[1] == 'enroll'){
        $link_job = 'active';
        echo "<title>Jobs | Nack </title>";
    }elseif($url[1] == 'profile'){
        $link_profile = 'active';
        echo "<title>Profile | Nack </title>";
    }

?>