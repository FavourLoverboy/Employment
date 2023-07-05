<?php 
    include('includes/auth/header.php');
    echo "<title>Reset | Admin - Nack </title>";

    $e = $errEmail = '';
    $validate_email = true;
    if(isset($_GET['l'])){
        $level = $secObj->decryptURLParam($_GET['l']);
        $levels = ['admins', 'referral', 'users'];
        if(!in_array($level, $levels)){
            echo "<script>  window.location='login' </script>";
        }elseif($level == $levels[0]){
            $userLoginLevel = 'admin';
        }elseif($level == $levels[1]){
            $userLoginLevel = 'referral';
        }else{
            $userLoginLevel = 'login';
        }
    }else{
        echo "<script>  window.location='login' </script>";
    }

    if($_POST){
        extract($_POST);
        $e = $email;
        $enc_email = $secObj->encryptURLParam(strtolower($email));

        // Validating Email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $validate_email = false;
        }

        if($validate_email){
            // Checking for email
            $tblquery = "SELECT * FROM $level WHERE email = :email";
            $tblvalue = [
                ':email' => htmlspecialchars($enc_email)
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            $errEmail = ($select) ? "we sent a reset link to your email" : "email don't exist";
        }else{
            $errEmail = 'invalid email';
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
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $e; ?>" required>
                    <span><?php echo $errEmail; ?></span>
                </div>
                <div class="form-group">
                    <button type="submit">Request</button>
                </div>
                <div class="form-group forgot-password">
                    <a href="<?php echo $userLoginLevel; ?>">Login</a>
                </div>
                <!-- <div class="form-group register-link">
                    Don't have an account? <a href="#">Register here</a>
                </div> -->
            </form>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>