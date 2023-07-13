<?php 

    if($url[1] == 'dashboard'){
        $link_dashboard = 'active';
        echo "<title>Dashboard | " . $siteName . " </title>";
    }elseif($url[1] == 'approveUsers'){
        $link_approveUsers = 'active';
        echo "<title>Approve Users | " . $siteName . " </title>";
    }elseif($url[1] == 'clients' || $url[1] == 'view'){
        $link_clients = 'active';
        echo "<title>Clients | " . $siteName . " </title>";
    }elseif($url[1] == 'job' || $url[1] == 'viewJob'){
        $link_job = 'active';
        echo "<title>Job | " . $siteName . " </title>";
    }elseif($url[1] == 'payment'){
        $link_payment = 'active';
        echo "<title>Payment | " . $siteName . " </title>";
    }elseif($url[1] == 'processing'){
        $link_processing = 'active';
        echo "<title>Processing | " . $siteName . " </title>";
    }elseif($url[1] == 'profile'){
        $link_profile = 'active';
        echo "<title>Profile | " . $siteName . " </title>";
    }elseif($url[1] == 'setting'){
        $link_setting = 'active';
        echo "<title>Setting | " . $siteName . " </title>";
    }elseif($url[1] == 'suspend'){
        $link_suspend = 'active';
        echo "<title>Suspend | " . $siteName . " </title>";
    }

?>