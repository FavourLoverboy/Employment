<?php 
    include('includes/auth/header.php');
    echo "<title>Registration | No </title>";

    if(!isset($_SESSION['fn']) || $_SESSION['fn'] == "" || $_SESSION['ln'] == "" || $_SESSION['email'] == "" || $_SESSION['password'] == ""){
        echo "<script>  window.location='registration_personal' </script>";
    }

    $errMNum = $errSSN = $errDOB = $mNum = $ssn = $dob = $sex = $ms = '';

    function containsString($num){
        if (is_numeric($num)){
            return true;
        } else {
            return false;
        }
    }

    if($_POST){
        extract($_POST);

        # object oriented
        $from = new DateTime($dob);
        $to   = new DateTime('today');
        $age  = $from->diff($to)->y;

        if(containsString($mNum)){
            if(!(strlen($mNum) < 7 || strlen($mNum) > 15)){
                if($ssn AND containsString($ssn) == false){
                    $errSSN = "must only be number";
                }else{
                    if($ssn AND strlen($ssn) != 9){
                        $errSSN = "Invalid SSN number";
                    }else{
                        if($age > 17){
                            $_SESSION['mNum'] = $secObj->encryptURLParam($mNum);
                            $_SESSION['ssn'] = $secObj->encryptURLParam($ssn);
                            $_SESSION['dob'] = $secObj->encryptURLParam($dob);
                            $_SESSION['sex'] = $secObj->encryptURLParam($sex);
                            $_SESSION['ms'] = $secObj->encryptURLParam($ms);
                            echo "<script>  window.location='location' </script>";
                        }else{
                            $errDOB = "you must be at least 18 years";
                        }
                    }
                }
            }else{
                $errMNum = "Invalid mobile number";
            } 
        }else{
            $errMNum = "must only be number";
        }      
    }
?>

    <div class="container">
        <h1>Personal Info</h1>
        <form method="POST">
            <div class="form-group">
                <label for="number">Mobile Number</label>
                <input type="text" id="number" name="mNum" placeholder="enter number" value="<?php echo $mNum; ?>" required>
                <span class="error"><?php echo $errMNum; ?></span>
            </div>
            <div class="form-group">
                <label for="ssn">SSN <span class="error text-dark">for US</span></label>
                <input type="text" id="ssn" name="ssn" placeholder="enter SSN" value="<?php echo $ssn; ?>">
                <span class="error"><?php echo $errSSN; ?></span>
            </div>
            <div class="form-group">
                <label for="dob">DOB</label>
                <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required>
                <span class="error"><?php echo $errDOB; ?></span>
            </div>
            <div class="form-group">
                <label for="sex">Gender</label>
                <select id="sex" name="sex" required>
                    <?php
                    
                        if($sex AND $sex == 'F'){
                            echo "
                                <option value='F' selected>Female</option>
                                <option value='M'>Male</option>
                            ";
                        }elseif($sex AND $sex == 'M'){
                            echo "
                                <option value='F'>Female</option>
                                <option value='M' selected>Male</option>
                            ";
                        }else{
                            echo "
                                <option value=''>Choose</option>
                                <option value='F'>Female</option>
                                <option value='M'>Male</option>
                            ";
                        }
                    
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ms">Marital Status</label>
                <select id="ms" name="ms" required>
                    <?php
                    
                        if($ms){
                            echo "
                                <option value='" . $ms . "'>" . $ms . "</option>
                                <option value='Divorced'>Divorced</option>
                                <option value='Married'>Married</option>
                                <option value='Single'>Single</option>
                                <option value='Widowed'>Widowed</option>
                            ";
                        }else{
                            echo "
                                <option value=''>Choose</option>
                                <option value='Divorced'>Divorced</option>
                                <option value='Married'>Married</option>
                                <option value='Single'>Single</option>
                                <option value='Widowed'>Widowed</option>
                            ";
                        }
                    ?>
                </select>
            </div>
            <button type="submit">Proceed</button>
        </form>
        <div class="button-group">
            <a href="login" class="login-link">Login?</a>
            <a href="forgotPassword" class="forgot-password-link">Forgot Password?</a>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>