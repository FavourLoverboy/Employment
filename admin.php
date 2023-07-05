<?php 
    include('includes/auth/header.php');
    echo "<title>Login | Admin - Nack </title>";

    $e = $errEmail = $errPassword = '';
    $validate_email = true;
    $resetPasswordLevel = $secObj->encryptURLParam('admins');

    if($_POST){
        extract($_POST);
        $e = $email;
        $enc_email = $secObj->encryptURLParam(strtolower($email));
        $pwd = $secObj->encryptPassword($password);

        // Validating Email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $validate_email = false;
        }

        if($validate_email){
            // Checking for email
            $tblquery = "SELECT * FROM admins WHERE email = :email";
            $tblvalue = [
                ':email' => htmlspecialchars($enc_email)
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            if($select){
                foreach($select as $data){
                    extract($data);
                    $_SESSION['myID'] = $id;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['img'] = $img;
                    $_SESSION['status'] = $status;
                }
                if($_SESSION['password'] == $pwd){
                    if($secObj->decryptURLParam($_SESSION['status']) == "1"){
                        $_SESSION['level'] = 'admin';
                        header('location: a/dashboard');
                        echo "<script>  window.location='a/dashboard' </script>";
                    }else{
                        $errPassword = "your account has been disabled";
                    }
                }else{
                    $errPassword = "incorrect password";
                }
            }else{
                $errEmail = "email don't exist";
            }
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
            <h2>SIGN IN</h2>
            <form id="login-form" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $e; ?>" required>
                    <span><?php echo $errEmail; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span><?php echo $errPassword; ?></span>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
                <div class="form-group forgot-password">
                    <a href="forgotPassword.php?l=<?php echo $resetPasswordLevel; ?>">Forgot password?</a>
                </div>
                <!-- <div class="form-group register-link">
                    Don't have an account? <a href="#">Register here</a>
                </div> -->
            </form>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>