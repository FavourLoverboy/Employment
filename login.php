<?php 
    include('includes/auth/header.php');
    echo "<title>Login | Admin - Nack </title>";

    $errEmail = $errPassword = $e = '';
    $validate_email = true;
    $continue = false;

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
            $tblquery = "SELECT * FROM users WHERE email = :email";
            $tblvalue = [
                ':email' => htmlspecialchars($enc_email)
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            if(!$select){
                $tblquery = "SELECT id FROM not_verify WHERE email = :email";
                $tblvalue = [
                    ':email' => htmlspecialchars($enc_email)
                ];
                $select = $dbObj->tbl_select($tblquery, $tblvalue);
                $errEmail = ($select) ? "
                We regret to inform you that your account has not yet been verified" : "
                We apologize for any confusion caused. It appears that the email provided does not exist in our records";
            }else{
                $continue = true;
            }
        }else{
            $errEmail = '
            We apologize for the inconvenience, but it seems that the email provided is invalid';
        }

        if($continue){
            foreach($select as $data){
                extract($data);
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['status'] = $status;
            }
            if($_SESSION['password'] == $pwd){
                if($secObj->decryptURLParam($_SESSION['status']) == "1"){
                    $_SESSION['level'] = 'user';
                    header('location: user/dashboard');
                    echo "<script>  window.location='user/dashboard' </script>";
                }else{
                    $errPassword = "Your account has been suspended";
                }
            }else{
                $errPassword = "Please try again with a different password";
            }
        }
    }
?>

    <div class="container">
        <h1>Login</h1>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="enter email" value="<?php echo $e; ?>" required>
                <span class="error"><?php echo $errEmail; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="enter password" required>
                <span class="error"><?php echo $errPassword; ?></span>
            </div>
            <button type="submit">Login</button>
        </form>
        <br>
        <div class="button-group">
            <a href="registration_personal" class="login-link">Register?</a>
            <a href="forgotPassword" class="forgot-password-link">Forgot Password?</a>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>