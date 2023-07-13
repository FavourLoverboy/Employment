<?php 
    include('includes/auth/header.php');
    echo "<title>Forgot Password | $siteName</title>";

    $errEmail = $text_success = $e = '';
    $validate_email = true;

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
            $tblquery = "SELECT id FROM users WHERE email = :email";
            $tblvalue = [
                ':email' => htmlspecialchars($enc_email)
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            if($select){
                $userId = $secObj->encryptURLParam($select[0]['id']);
                $link = "[]/resetPassword.php?q=$userId";
                $errEmail = "We have dispatched a password reset link to your registered email address.";
                $text_success = "text-success";
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
        <h1>Forgot Password</h1>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="enter email" value="<?php echo $e; ?>" required>
                <span class="error <?php echo $text_success; ?>"><?php echo $errEmail; ?></span>
            </div>
            <button type="submit">Proceed</button>
        </form>
        <br>
        <div class="button-group">
            <a href="registration_personal" class="login-link">Register?</a>
            <a href="login" class="forgot-password-link">Login?</a>
        </div>
        <div class="button-group">
            <a href="#" class="login-link">Home</a>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>