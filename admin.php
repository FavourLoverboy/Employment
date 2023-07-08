<?php 
    include('includes/auth/header.php');
    echo "<title>Login | Admin - Nack </title>";

    $errEmail = $errPassword = $e = '';
    $validate_email = true;

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
            $tblquery = "SELECT * FROM admin WHERE email = :email";
            $tblvalue = [
                ':email' => htmlspecialchars($enc_email)
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            if($select){
                foreach($select as $data){
                    extract($data);
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                }
                if($_SESSION['password'] == $pwd){
                    $_SESSION['level'] = 'admin';
                    header('location: a/dashboard');
                    echo "<script>  window.location='a/dashboard' </script>";
                }else{
                    $errPassword = "incorrect password";
                }
            }else{
                $errEmail = "We apologize for any confusion caused. It appears that the email provided does not exist in our records";
            }
        }else{
            $errEmail = '
            We apologize for the inconvenience, but it seems that the email provided is invalid';
        }
    }
?>

    <div class="container">
        <h1>Admin</h1>
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
            <a href="forgotPassword" class="forgot-password-link">Forgot Password?</a>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>