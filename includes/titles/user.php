<?php 

    if($url[1] == 'dashboard'){
        $link_dashboard = 'active';
        echo "<title>Dashboard | " . $siteName . " </title>";
    }elseif($url[1] == 'enrolled'){
        $link_enrolled = 'active';
        echo "<title>Enrolled | " . $siteName . " </title>";
    }elseif($url[1] == 'job' || $url[1] == 'enroll'){
        $link_job = 'active';
        echo "<title>Jobs | " . $siteName . " </title>";
    }elseif($url[1] == 'profile'){
        $link_profile = 'active';
        echo "<title>Profile | " . $siteName . " </title>";
    }

?>