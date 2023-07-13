<section class="home">
    <?php
        
        $tblquery = "SELECT * FROM users WHERE id = :id";
        $tblvalue = [
            ':id' => htmlspecialchars($_SESSION['myID'])
        ];
        $select = $dbObj->tbl_select($tblquery, $tblvalue);
        if($select){
            foreach($select as $data){
                extract($data);
                $ln = $secObj->decryptURLParam($ln);
                $fn = $secObj->decryptURLParam($fn);
                $mn = $secObj->decryptURLParam($mn);
                $name_details = $ln . " " . $fn . " " . $mn;
                $email_details = $secObj->decryptURLParam($email);
                $number_details = $secObj->decryptURLParam($pn);
                $available_details = $secObj->decryptURLParam($available);
                $date_details =  $secObj->decryptURLParam($date);
            }
        }

        // details
        $e = $fname = $lname = $mname = $p = $a = $errEmail = $errLn = $errFn = $errMn = $errP = $errA = '';
        $validate_email = true;
        if(isset($_POST['details'])){
            extract($_POST);
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

            $e = $email;
            $lname = $ln;
            $fname = $fn;
            $mname = $mn;
            $p = $pn;
            $a = $available;
            $enc_email = $secObj->encryptURLParam(strtolower($email));
            $enc_l_name = $secObj->encryptURLParam(ucwords($ln));
            $enc_f_name = $secObj->encryptURLParam(ucwords($fn));
            $enc_m_name = $secObj->encryptURLParam(ucwords($mn));
            $enc_pn = $secObj->encryptURLParam(strtolower($pn));
            $enc_a = $secObj->encryptURLParam(strtolower($available));

            if(containsNumber($ln)) {
                $errLn = "Last name must not contain a number.";
            }else{
                if(containsNumber($fn)) {
                    $errFn = "First name must not contain a number.";
                }else{
                    if(containsNumber($mn)) {
                        $errMn = "Middle name must not contain a number.";
                    }else{
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
                            $continue = true;
                            if($select){
                                if(!($_SESSION['myID'] == $select[0]['id'])){
                                    $continue = false;
                                    $errEmail = 'email already in use';
                                }
                            }
                        }else{
                            $errEmail = 'invalid email';
                        }

                        if($continue){
                            if(containsString($pn)){
                                if(!(strlen($pn) < 7 || strlen($pn) > 15)){
                                    $tblquery = "UPDATE users SET ln = :ln, fn = :fn, mn = :mn, email = :email, pn = :pn, available = :available WHERE id = :id";
                                    $tblvalue = [
                                        ':ln' => htmlspecialchars($enc_l_name),
                                        ':fn' => htmlspecialchars($enc_f_name),
                                        ':mn' => htmlspecialchars($enc_m_name), 
                                        ':email' => htmlspecialchars($enc_email),
                                        ':pn' => htmlspecialchars($enc_pn),
                                        ':available' => htmlspecialchars($enc_a),
                                        ':id' => $_SESSION['myID']
                                    ];
                                    $update = $dbObj->tbl_update($tblquery, $tblvalue);
                                    if($update){
                                        // $e = $n = $errEmail = '';
                                        echo "<script>  window.location='user/profile/success' </script>";
                                    }
                                }else{
                                    $errP = "Invalid mobile number";
                                }
                            }else{
                                $errP = "must only be number";
                            }
                        }
                    }
                }
            }
        }
        if(!$a){
            $a = $available_details;
        }
        if(!$p){
            $p = $number_details;
        }
        if(!$lname){
            $lname = $ln;
        }
        if(!$mname){
            $mname = $mn;
        }
        if(!$fname){
            $fname = $fn;
        }

        if(!$e){
            $e = $email_details;
        }


        // password
        $errOld = $errNew = $errConfirm = '';
        if(isset($_POST['password'])){
            extract($_POST);
            $en_old_pwd = $secObj->encryptURLParam($oldPassword);
            $en_new_pwd = $secObj->encryptURLParam($newPassword);
            $en_cnew_pwd = $secObj->encryptURLParam($cnewPassword);

            $tblquery = "SELECT id FROM users WHERE id = :id AND password = :password";
            $tblvalue = [
                ':id' => htmlspecialchars($_SESSION['myID']),
                ':password' => htmlspecialchars($en_old_pwd)
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            if($select){
                if(strlen($newPassword) < 6){
                    $errNew = "Password should be at least 6 characters";
                }elseif($newPassword != $cnewPassword){
                    $errConfirm = "Password do not match";
                }else{
                    $tblquery = "UPDATE users SET password = :password WHERE id = :id";
                    $tblvalue = [
                        ':password' => htmlspecialchars($en_new_pwd),
                        ':id' => $_SESSION['myID']
                    ];
                    $update = $dbObj->tbl_update($tblquery, $tblvalue);
                    if($update){
                        $errOld = $errNew = $errConfirm = '';
                        echo "<script>  window.location='logout' </script>";
                    }
                }
            }else{
                $errOld = "Old password not correct";
            }

        }


        // image
        $errImage = '';
        if(isset($_POST['image'])){
            $pictureAllowed = array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF', 'webp', 'WEBP', 'jfif', 'JFIF');
            $fileName = $_FILES['img']['name'];
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
            $name = substr(str_shuffle($characters), 0, 10);
            $name = "$name.$ext";
            $enc_img_name = $secObj->encryptURLParam($name);
            if(in_array($ext, $pictureAllowed)){
                $tblquery = "UPDATE users SET img = :img WHERE id = :id";
                $tblvalue = [
                    ':img' => htmlspecialchars($enc_img_name),
                    ':id' => $_SESSION['myID']
                ];
                $update = $dbObj->tbl_update($tblquery, $tblvalue);
                if($update){
                    if($_SESSION['myImg']){
                        $delFile = $secObj->decryptURLParam($_SESSION['myImg']);
                        if(file_exists("uploads/$delFile")){
                            unlink("uploads/$delFile");
                        }
                    }

                    if(!is_dir("uploads")){
                        mkdir("uploads", 0777, true);
                    }
                    $location = "uploads/$name";
                    move_uploaded_file($_FILES['img']['tmp_name'], $location);
                    $_SESSION['myImg'] = $enc_img_name;
                }
            }else{
                $errImage = "invalid picture format";
            }
        }
    
    ?>
    <div class="row mt-5 px-2">
        <div class="col-md-3">
            <!-- Left column -->
            <div class="profile">
                <div class="profile-image">
                    <?php 
                        $imgFile = $secObj->decryptURLParam($_SESSION['myImg']);
                        $sex = $secObj->decryptURLParam($_SESSION['mySex']);
                        if(isset($_SESSION['myImg']) AND file_exists("uploads/$imgFile")){
                            echo "
                                <img src='uploads/$imgFile' alt='User Image'>
                            ";
                        }elseif($sex == "M"){
                            echo "
                                <img src='assets/images/profile.png' alt='User Image'>
                            ";
                        }else{
                            echo "
                                <img src='assets/images/female.jpg' alt='User Image'>
                            ";
                        }
                    
                    ?>
                    <p class="text-style"><?php echo $name_details; ?></p>
                </div>
                <div class="button-container">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#image">
                        Change image
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#password">
                        Change password
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Right column -->
            <div class="profile-details">
                <form>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" value="<?php echo $name_details; ?>" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" value="<?php echo $email_details; ?>" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Number:</label>
                        <input type="text" value="<?php echo $number_details; ?>" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>availability:</label>
                        <input type="text" value="<?php echo $available_details; ?>" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="text" value="<?php echo $date_details; ?>" class="form-control" disabled>
                    </div>

                    <div class="form-button">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#details">
                            update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- image -->
    <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <?php 

                                $imgFile = $secObj->decryptURLParam($_SESSION['myImg']);
                                if(file_exists("uploads/$imgFile")){
                                    echo "
                                        <img src='uploads/$imgFile' alt='User Image' style='border-radius: 50%; height: 50px; width: 50px;' class='mb-2' id='output'/>
                                    ";
                                }else{
                                    echo "
                                        <img src='assets/images/$imgFile' alt='User Image' style='border-radius: 50%; height: 50px; width: 50px;' class='mb-2' id='output'/>
                                    ";
                                }
                            
                            ?>
                            <input type="file" class="form-control" id="image" name="img" required onchange="loadFile(event)">
                            <span class="text-danger"><?php echo $errImage; ?></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="image" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- details -->
    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ln">LastName</label>
                            <input type="text" class="form-control" id="ln" name="ln" placeholder="Enter lastname" value="<?php echo $lname; ?>" required>
                            <span class="text-danger"><?php echo $errLn; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="fn">FirstName</label>
                            <input type="text" class="form-control" id="fn" name="fn" placeholder="Enter firstname" value="<?php echo $fname; ?>" required>
                            <span class="text-danger"><?php echo $errFn; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="mn">Middle Name</label>
                            <input type="text" class="form-control" id="mn" name="mn" placeholder="Enter middle name (Option)" value="<?php echo $mname; ?>">
                            <span class="text-danger"><?php echo $errMn; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Enter email" value="<?php echo $e; ?>" required>
                            <span class="text-danger"><?php echo $errEmail; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="pn">Phone Number</label>
                            <input type="text" class="form-control" id="pn" name="pn" placeholder="Enter phone number" value="<?php echo $number_details; ?>" required>
                            <span class="text-danger"><?php echo $errP; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="available">Availability and Preferences</label>
                            <select id="available" name="available" required>
                                <?php
                                    if($available_details){
                                        echo "
                                            <option value='" . $available_details . "'>" . $available_details . "</option>
                                            <option value='Contract'>Contract</option>
                                            <option value='Full-time'>Full-time</option>
                                            <option value='Part-time'>Part-time</option>
                                            <option value='Remote'>Remote</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="details" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- password -->
    <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="oldPassword">Old Password</label>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter old password" required>
                            <span class="text-danger"><?php echo $errOld; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" required>
                            <span class="text-danger"><?php echo $errNew; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="cnewPassword">Confirm New Password</label>
                            <input type="password" class="form-control" id="cnewPassword" name="cnewPassword" placeholder="Confirm new password" required>
                            <span class="text-danger"><?php echo $errConfirm; ?></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="password" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>