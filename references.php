<?php

    include('includes/auth/header.php');
    echo "<title>Registration | No </title>";

    if(!isset($_SESSION['salary']) || $_SESSION['salary'] == "" || $_SESSION['skills'] == "" || $_SESSION['available'] == "" || $_SESSION['bio'] == ""){
        echo "<script>  window.location='more' </script>";
    }

    $errFN = $errEmail = $errNumber = $number = $email = $fn = '';
    $validate_email = true;

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

        // Validating Email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $validate_email = false;
        }

        if(containsNumber($fn)) {
            $errFN = "FullName must not contain a number.";
        } else {
            if($validate_email){
                if(containsString($number)){
                    if(!(strlen($number) < 7 || strlen($number) > 15)){
                        $_SESSION['re_fullname'] = $secObj->encryptURLParam(ucwords($fn));
                        $_SESSION['re_email'] = $secObj->encryptURLParam(strtolower($email));
                        $_SESSION['re_number'] = $secObj->encryptURLParam($number);
                        echo "<script>  window.location='files' </script>";
                    }else{
                        $errNumber = "Invalid mobile number";
                    }
                }else{
                    $errNumber = "Must contain only numbers";
                }
            }else{
                $errEmail = "Invalid email";
            }
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
            <button type="submit">Register</button>
        </form>
    </div>

<?php include('includes/auth/footer.php'); ?>