<?php

    include('includes/auth/header.php');
    echo "<title>Registration | $siteName</title>";

    if(!isset($_SESSION['mNum']) || $_SESSION['mNum'] == "" || $_SESSION['dob'] == "" || $_SESSION['sex'] == "" || $_SESSION['ms'] == ""){
        echo "<script>  window.location='registration_more' </script>";
    }

    $errSOO = $errState = $nationality = $country = $state = $soo = $city = $ads = '';

    function containsNumber($string) {
        if (preg_match('/\d/', $string)) {
            return true;
        } else {
            return false;
        }
    }

    if($_POST){
        extract($_POST);

        if(containsNumber($soo)){
            $errSOO = "mush not contain a number";
        }else{
            if(containsNumber($state)){
                $errState = "mush not contain a number";
            }else{
                $_SESSION['nationality'] = $secObj->encryptURLParam(ucwords($nationality));
                $_SESSION['soo'] = $secObj->encryptURLParam(ucwords($soo));
                $_SESSION['country'] = $secObj->encryptURLParam(ucwords($country));
                $_SESSION['state'] = $secObj->encryptURLParam(ucwords($state));
                $_SESSION['city'] = $secObj->encryptURLParam(ucwords($city));
                $_SESSION['ads'] = $secObj->encryptURLParam($ads);
                echo "<script>  window.location='more' </script>";
            }
        }
    }

?>

    <div class="container">
        <h1>Location info</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nationality">Nationality</label>
                <select id="nationality" name="nationality">
                    <?php
                        if($nationality){
                            echo "
                                <option value='" . $nationality . "'>" . $nationality . "</option>
                            ";
                            include('includes/countries.php');
                        }else{
                            echo "
                                <option value=''>Choose</option>
                            ";
                            include('includes/countries.php');
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="soo">State</label>
                <input type="text" id="soo" name="soo" placeholder="enter state" value="<?php echo $soo; ?>">
                <span class="error"><?php echo $errSOO; ?></span>
            </div>
            <div class="form-group">
                <label for="country">Current Country</label>
                <select id="country" name="country">
                    <?php
                        if($country){
                            echo "
                                <option value='" . $country . "'>" . $country . "</option>
                            ";
                            include('includes/countries.php');
                        }else{
                            echo "
                                <option value=''>Choose</option>
                            ";
                            include('includes/countries.php');
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="s">Current State</label>
                <input type="text" id="s" name="state" placeholder="enter state" value="<?php echo $state; ?>">
                <span class="error"><?php echo $errState; ?></span>
            </div>
            <div class="form-group">
                <label for="city">Current City</label>
                <input type="text" id="city" name="city" placeholder="enter city" value="<?php echo $city; ?>">
            </div>
            <div class="form-group">
                <label for="ads">Home Address</label>
                <textarea id="ads" name="ads" rows="4" placeholder="enter address"><?php echo $ads; ?></textarea>
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