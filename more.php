<?php

    include('includes/auth/header.php');
    echo "<title>Registration | No </title>";

    if(!isset($_SESSION['nationality']) || $_SESSION['nationality'] == "" || $_SESSION['soo'] == "" || $_SESSION['country'] == "" || $_SESSION['state'] == "" || $_SESSION['city'] == "" || $_SESSION['ads'] == ""){
        echo "<script>  window.location='location' </script>";
    }

    $salary = $skills = $available = $bio = '';

    if($_POST){
        extract($_POST);

        $_SESSION['salary'] = $secObj->encryptURLParam($salary);
        $_SESSION['skills'] = $secObj->encryptURLParam($skills);
        $_SESSION['available'] = $secObj->encryptURLParam($available);
        $_SESSION['bio'] = $secObj->encryptURLParam($bio);
        echo "<script>  window.location='references' </script>";
    }

?>

    <div class="container">
        <h1>More Info</h1>
        <form method="POST">
            <div class="form-group">
                <label for="salary">Salary Expectation</label>
                <select id="salary" name="salary" required>
                    <?php
                        if($salary){
                            echo "
                                <option value='" . $salary . "'>" . $salary . "</option>
                                <option value='$10 - $100'>$10 - $100</option>
                                <option value='$100 - $500'>$100 - $500</option>
                                <option value='$500 - $1,000'>$500 - $1,000</option>
                                <option value='$1,000 - $25,000'>$1,000 - $25,000</option>
                                <option value='$25,000 - $40,000'>$25,000 - $40,000</option>
                                <option value='$40,000 - $80,000'>$40,000 - $80,000</option>
                                <option value='$80,000 - $150,000'>$80,000 - $150,000</option>
                                <option value='$150,000 and above'>$150,000 and above</option>
                            ";
                            include('includes/countries.php');
                        }else{
                            echo "
                                <option value=''>Choose</option>
                                <option value='$10 - $100'>$10 - $100</option>
                                <option value='$100 - $500'>$100 - $500</option>
                                <option value='$500 - $1,000'>$500 - $1,000</option>
                                <option value='$1,000 - $25,000'>$1,000 - $25,000</option>
                                <option value='$25,000 - $40,000'>$25,000 - $40,000</option>
                                <option value='$40,000 - $80,000'>$40,000 - $80,000</option>
                                <option value='$80,000 - $150,000'>$80,000 - $150,000</option>
                                <option value='$150,000 and above'>$150,000 and above</option>
                            ";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="available">Availability and Preferences</label>
                <select id="available" name="available" required>
                    <?php
                        if($available){
                            echo "
                                <option value='" . $available . "'>" . $available . "</option>
                                <option value='Contract'>Contract</option>
                                <option value='Full-time'>Full-time</option>
                                <option value='Part-time'>Part-time</option>
                                <option value='Remote'>Remote</option>
                            ";
                        }else{
                            echo "
                                <option value=''>Choose</option>
                                <option value='Contract'>Contract</option>
                                <option value='Full-time'>Full-time</option>
                                <option value='Part-time'>Part-time</option>
                                <option value='Remote'>Remote</option>
                            ";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="skills">Skills</label>
                <textarea id="skills" name="skills" rows="4" placeholder="enter skills" required><?php echo $skills; ?></textarea>
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea id="bio" name="bio" rows="4" placeholder="enter bio" required><?php echo $bio; ?></textarea>
            </div>
            <button type="submit">Proceed</button>
        </form>
        <div class="button-group">
            <a href="login" class="login-link">Login?</a>
            <a href="forgotPassword" class="forgot-password-link">Forgot Password?</a>
        </div>
    </div>

<?php include('includes/auth/footer.php'); ?>