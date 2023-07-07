<?php

    include('includes/auth/header.php');
    echo "<title>Registration | No </title>";

    if(!isset($_SESSION['salary']) || $_SESSION['salary'] == "" || $_SESSION['skills'] == "" || $_SESSION['available'] == "" || $_SESSION['bio'] == ""){
        echo "<script>  window.location='more' </script>";
    }

    $errImg = '';
    $continue = true;
    if(isset($_POST)){
        if(!empty($_FILES['img']['name']) != ""){
            echo 'here';
            $pictureAllowed = ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF', 'webp', 'WEBP', 'jfif', 'JFIF'];
            $fileName = $_FILES['img']['name'];
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
            $name = substr(str_shuffle($characters), 0, 10);
            $name = "$name.$ext";
            $enc_img_name = $secObj->encryptURLParam($name);
            if(in_array($ext, $pictureAllowed)){
                $continue = true;
                $_SESSION['img'] = $enc_img_name;

                $location = "uploads/$name";
                move_uploaded_file($_FILES['img']['tmp_name'], $location);
                
            }else{
                $errImg = "invalid picture format";
                $continue = false;
            }
        }else{
            $_SESSION['img'] = ($secObj->decryptURLParam($_SESSION['sex']) == "M") ? $secObj->decryptURLParam("profile.png") : $secObj->decryptURLParam("female.png");
            
        }

        if($continue){
            $tblquery = "INSERT INTO not_verify VALUES(:id, :ln, :fn, :mn, :email, :password, :sex, :dob, :pn, :ms, :ref_name, :ref_email, :ref_number, :skills, :salary, :nationality, :soo, :country, :state, :cty, :ads, :ssn, :img, :cv, :bio, :available, :date, :verify)";
            $tblvalue = [
                ':id' => NULL, 
                ':ln' => htmlspecialchars($_SESSION['ln']),
                ':fn' => htmlspecialchars($_SESSION['fn']),
                ':mn' => htmlspecialchars($_SESSION['mn']),
                ':email' => htmlspecialchars($_SESSION['email']), 
                ':password' => htmlspecialchars($_SESSION['password']), 
                ':sex' => htmlspecialchars($_SESSION['sex']),
                ':dob' => htmlspecialchars($_SESSION['dob']),
                ':pn' => htmlspecialchars($_SESSION['mNum']),
                ':ms' => htmlspecialchars($_SESSION['ms']),
                ':ref_name' => htmlspecialchars($_SESSION['re_fullname']),
                ':ref_email' => htmlspecialchars($_SESSION['re_email']),
                ':ref_number' => htmlspecialchars($_SESSION['re_number']),
                ':skills' => htmlspecialchars($_SESSION['skills']), 
                ':salary' => htmlspecialchars($_SESSION['salary']), 
                ':nationality' => htmlspecialchars($_SESSION['nationality']),
                ':soo' => htmlspecialchars($_SESSION['soo']),
                ':country' => htmlspecialchars($_SESSION['country']),
                ':state' => htmlspecialchars($_SESSION['state']),
                ':cty' => htmlspecialchars($_SESSION['city']),
                ':ads' => htmlspecialchars($_SESSION['ads']),
                ':ssn' => htmlspecialchars($_SESSION['ssn']),
                ':img' => htmlspecialchars($_SESSION['img']),
                ':cv' => htmlspecialchars(""),
                ':bio' => htmlspecialchars($_SESSION['bio']),
                ':available' => htmlspecialchars($_SESSION['available']),
                ':date' => htmlspecialchars($secObj->encryptURLParam(date('Y-m-d'))),
                ':verify' => htmlspecialchars($secObj->encryptURLParam(date('0')))
            ];
            $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
            if($insert){
                echo "<script>  window.location='login' </script>";
            }
        }
    }

?>

    <div class="container">
        <h1>Files</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="img">Profile Image</label>
                <input type="file" name="img" id="img">
                <br>
                <span class="error"><?php echo $errImg; ?></span>
            </div>

            <div class="form-group">
                <label for="cv">Upload your CV</label>
                <input type="file" name="cv" id="cv">
            </div>
            <button name="image" type="submit">Register</button>
        </form>
    </div>

<?php include('includes/auth/footer.php'); ?>