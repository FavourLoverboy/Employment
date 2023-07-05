<?php 
    include('includes/auth/header.php');
    echo "<title>Reset | Admin - Nack </title>";
    // echo $secObj->encryptURLParam("5,users");

    $errCNewPassword = $errNewPassword= '';
    if(isset($_GET['q'])){
        $q = $secObj->decryptURLParam($_GET['q']);
        $q = explode(',', $q);
        if($q[0] == "" || $q[1] == ""){
            echo "<script>  window.location='login' </script>";
        }
        $levels = ['admins', 'referral', 'users'];
        if(!in_array($q[1], $levels)){
            echo "<script>  window.location='login' </script>";
        }elseif($q[1] == $levels[0]){
            $table = 'admin';
        }elseif($q[1] == $levels[1]){
            $table = 'referral';
        }else{
            $table = 'users';
        }
    }else{
        echo "<script>  window.location='login' </script>";
    }

    if($_POST){
        extract($_POST);
        if(strlen($np) < 6){
            $errNewPassword = "password must be more than 5 characters";
        }elseif($np != $cnp){
            $errCNewPassword = "password do not match";
        }else{
            $new_pwd = $secObj->encryptPassword($np);
            $c_pwd = $secObj->encryptPassword($cnp);

            $tblquery = "UPDATE $q[1] SET password = :password WHERE id = :id";
            $tblvalue = [
                ':password' => htmlspecialchars($new_pwd),
                ':id' => htmlspecialchars($q['0'])
            ];
            $update = $dbObj->tbl_update($tblquery, $tblvalue);
            if($update){
                if($q['1'] == 'admins'){
                    $link = 'admin';
                }elseif($q['1'] == 'referral'){
                    $link = 'referral';
                }else{
                    $link = 'login';
                }
                echo "<script>  window.location='$link' </script>";
            }

        }
    }
?>

    <div class="container">
        <div class="left-box">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <!-- <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol> -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/images/1.png" class="d-block w-100" alt="Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/2.jpg" class="d-block w-100" alt="Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/3.png" class="d-block w-100" alt="Image 3">
                    </div>
                </div>
                <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a> -->
            </div>
        </div>
        <div class="right-box">
            <h2>Reset Password</h2>
            <form id="login-form" method="POST">
                <div class="form-group">
                    <label for="np">New Password</label>
                    <input type="password" id="np" name="np" placeholder="Enter new password" required>
                    <span><?php echo $errNewPassword; ?></span>
                </div>

                <div class="form-group">
                    <label for="cnp">Confirm Password</label>
                    <input type="password" id="cnp" name="cnp" placeholder="Confirm password" required>
                    <span><?php echo $errCNewPassword; ?></span>
                </div>
                <div class="form-group">
                    <button type="submit">Proceed</button>
                </div>
                <!-- <div class="form-group register-link">
                    Don't have an account? <a href="#">Register here</a>
                </div> -->
            </form>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>