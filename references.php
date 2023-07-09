<?php

    include('includes/auth/header.php');
    echo "<title>Registration | No </title>";

    if(!isset($_SESSION['salary']) || $_SESSION['salary'] == "" || $_SESSION['skills'] == "" || $_SESSION['available'] == "" || $_SESSION['bio'] == ""){
        echo "<script>  window.location='more' </script>";
    }

    $errFN = $errEmail = $errNumber = $number = $email = $fn = '';
    $validate_email = true;
    $continue = true;

    function containsNumber($string) {
        if (preg_match('/\d/', $string)) {
            return true;
        } else {
            return false;
        }
    }
    function containsString($num){
        if (is_numeric($num)){
            return true;
        } else {
            return false;
        }
    }

    if($_POST){
        extract($_POST);

        if(!empty($fn)){
            if(containsNumber($fn)){
                $errFN = "We kindly request you to ensure that your full name does not include any numerical characters";
                $continue = false;
            }
        }

        if(!empty($email)){
            // Validating Email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $validate_email = false;
            }
            
            if(!$validate_email){
                $continue = false;
                $errEmail = "We apologize for the inconvenience, but it seems that the email provided is invalid";
            }
        }

        if(!empty($number)){
            if(containsString($number)){
                if((strlen($number) < 7 || strlen($number) > 15)){
                    $errNumber = "
                    We regret to inform you that the mobile number provided is invalid. Please ensure that the number is entered correctly and meets the required format";
                    $continue = false;
                }
            }else{
                $errNumber = "
                Please ensure that the provided information consists solely of numerical characters";
                $continue = false;
            }
        }

        if($continue){
            $_SESSION['re_fullname'] = $secObj->encryptURLParam(ucwords($fn));
            $_SESSION['re_email'] = $secObj->encryptURLParam(strtolower($email));
            $_SESSION['re_number'] = $secObj->encryptURLParam($number);
            echo "<script>  window.location='files' </script>";
        }
    }

?>

    <div class="container">
        <h1>References</h1>
        <form method="POST">
            <div class="form-group">
                <label for="fn">FullName</label>
                <input type="text" id="fn" name="fn" placeholder="enter reference fullname (Optional)" value="<?php echo $fn; ?>">
                <span class="error"><?php echo $errFN; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="enter reference email (Optional)" value="<?php echo $email; ?>">
                <span class="error"><?php echo $errEmail; ?></span>
            </div>
            <div class="form-group">
                <label for="number">Number</label>
                <input type="text" id="number" name="number" placeholder="enter reference number (Optional)" value="<?php echo $number; ?>">
                <span class="error"><?php echo $errNumber; ?></span>
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