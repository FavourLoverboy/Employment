<?php 
    include('includes/auth/header.php');
    echo "<title>Login | Admin - Nack </title>";

    $errNP = $errCP = '';
    $_GET['q'] = "Ng%3D%3D";
    if(isset($_GET['q'])){
        $userId = $secObj->decryptURLParam($_GET['q']);
    }else{
        echo "<script>  window.location='login' </script>";
    }

    if($_POST){
        extract($_POST);
        if(strlen($np) < 5){
            $errNP = "Password should be at least 6 characters.";
        }elseif($np != $cp){
            $errCP = "Password do not match.";
        }else{
            $np = $secObj->encryptURLParam($np);
            $tblquery = "UPDATE users SET password = :password WHERE id = :id";
            $tblvalue = [
                ':password' => htmlspecialchars($np),
                ':id' => $userId
            ];
            $update = $dbObj->tbl_update($tblquery, $tblvalue);
            echo "<script>  window.location='login' </script>";
        }
    }
?>

    <div class="container">
        <h1>Reset Password</h1>
        <form method="POST">
            <div class="form-group">
                <label for="np">New Password</label>
                <input type="password" id="np" name="np" placeholder="enter new password" required>
                <span class="error"><?php echo $errNP; ?></span>
            </div>
            <div class="form-group">
                <label for="cp">Confirm Password</label>
                <input type="password" id="cp" name="cp" placeholder="enter confirm password" required>
                <span class="error"><?php echo $errCP; ?></span>
            </div>
            <button type="submit">Reset</button>
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