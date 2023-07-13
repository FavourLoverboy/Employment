<?php 
    include('includes/auth/header.php');
    echo "<title>Registration | $siteName</title>";

    $errFN = $errLN = $errMN = $errEmail = $errPassword = $errCP = $ln = $fn = $mn = $email = $password = $cp = '';
    $validate_email = true;

    function containsNumber($string) {
        if (preg_match('/\d/', $string)) {
            return true;
        } else {
            return false;
        }
    }

    if($_POST){
        extract($_POST);

        // Validating Email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $validate_email = false;
        }

        if(containsNumber($ln)) {
            $errLN = "Last name must not contain a number.";
        } else {
            if(containsNumber($fn)) {
                $errFN = "First name must not contain a number.";
            } else {
                if(containsNumber($mn)) {
                    $errMN = "Middle name must not contain a number.";
                } else {
                    if($validate_email){
                        // Checking for email
                        $tblquery = "SELECT * FROM users WHERE email = :email";
                        $tblvalue = [
                            ':email' => htmlspecialchars($secObj->encryptURLParam($email))
                        ];
                        $select = $dbObj->tbl_select($tblquery, $tblvalue);
                        // print_r($select);
                        if(!$select){
                            if(!(strlen($password) < 6)){
                                if($password == $cp){
                                    $_SESSION['fn'] = $secObj->encryptURLParam(ucfirst($fn));
                                    $_SESSION['ln'] = $secObj->encryptURLParam(ucfirst($ln));
                                    $_SESSION['mn'] = $secObj->encryptURLParam(ucfirst($mn));
                                    $_SESSION['email'] = $secObj->encryptURLParam(strtolower($email));
                                    $_SESSION['password'] = $secObj->encryptURLParam($password);
                                    echo "<script>  window.location='registration_more' </script>";
                                }else{
                                    $errCP = "Password do not match.";
                                }
                            }else{
                                $errPassword = "Password should be at least 6 characters.";
                            }
                        }else{
                            $errEmail = "Email has already been taking.";
                        }
                    }else{
                        $errEmail = 'invalid email';
                    }
                }
            }
        }        
    }
?>

    <div class="container">
        <h1>Personal Info</h1>
        <form method="POST">
            <div class="form-group">
                <label for="ln">LastName</label>
                <input type="text" id="ln" name="ln" placeholder="enter lastname" value="<?php echo $ln; ?>" required>
                <span class="error"><?php echo $errLN; ?></span>
            </div>
            <div class="form-group">
                <label for="fn">FirstName</label>
                <input type="text" id="fn" name="fn" placeholder="enter firstname" value="<?php echo $fn; ?>" required>
                <span class="error"><?php echo $errFN; ?></span>
            </div>
            <div class="form-group">
                <label for="mn">MiddleName</label>
                <input type="text" id="mn" name="mn" placeholder="enter middle name (Optional)" value="<?php echo $mn; ?>">
                <span class="error"><?php echo $errMN; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="enter email" value="<?php echo $email; ?>" required>
                <span class="error"><?php echo $errEmail; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="enter password" value="<?php echo $password; ?>" required>
                <span class="error"><?php echo $errPassword; ?></span>
            </div>
            <div class="form-group">
                <label for="cp">Confirm Password</label>
                <input type="password" id="cp" name="cp" placeholder="confirm password" value="<?php echo $cp; ?>" required>
                <span class="error"><?php echo $errCP; ?></span>
            </div>
            <div class="form-group">
                <label for="terms-checkbox">
                <input type="checkbox" id="terms-checkbox" name="terms-checkbox" required>
                <a href="#">I accept the terms and conditions.</a>
                </label>
            </div>
            <button type="submit">Proceed</button>
        </form>
        <br>
        <div class="button-group">
            <a href="login" class="login-link">Login?</a>
            <a href="forgotPassword" class="forgot-password-link">Forgot Password?</a>
        </div>
        <div class="button-group">
            <a href="#" class="login-link">Home</a>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>