<?php 
    include('includes/auth/header.php');
    echo "<title>Login | Admin - Nack </title>";

    $e = $errEmail = $errPassword = '';
    $validate_email = true;
    $resetPasswordLevel = $secObj->encryptURLParam('users');

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
            if($select){
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
                        $errPassword = "your account has been disabled";
                    }
                }else{
                    $errPassword = "incorrect password";
                }
            }else{
                $errEmail = "email don't exist";
            }
        }else{
            $errEmail = 'invalid email';
        }
    }
?>

    <div class="container">
        <h1>Registration</h1>
        <form>
            <div class="form-group">
                <label for="name">LastName</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="name">FirstName</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="name">MiddleName</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <select id="country" name="country">
                    <?php include('includes/countries.php'); ?>
                </select>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>

<?php include('includes/auth/footer.php'); ?>