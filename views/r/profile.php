<section class="home">
    <?php 
                    
        $tblquery = "SELECT * FROM referral WHERE id = :id";
        $tblvalue = [
            ':id' => htmlspecialchars($_SESSION['myID'])
        ];
        $select = $dbObj->tbl_select($tblquery, $tblvalue);
        if($select){
            foreach($select as $data){
                extract($data);
                $name_details = $secObj->decryptURLParam($name);
                $email_details = $secObj->decryptURLParam($email);
                $date_details =  $secObj->decryptURLParam($date);
            }
        }

        // details
        $e = $n = $errEmail = '';
        $validate_email = true;
        if(isset($_POST['details'])){
            extract($_POST);
            $e = $email;
            $enc_email = $secObj->encryptURLParam(strtolower($email));
            $n = $name;
            $enc_name = $secObj->encryptURLParam(ucfirst($name));

             // Validating Email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $validate_email = false;
            }
            if($validate_email){
                // Checking for email
                $tblquery = "SELECT id FROM referral WHERE email = :email";
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
                if($continue){
                    $tblquery = "UPDATE referral SET name = :name, email = :email WHERE id = :id";
                    $tblvalue = [
                        ':name' => htmlspecialchars($enc_name), 
                        ':email' => htmlspecialchars($enc_email),
                        ':id' => $_SESSION['myID']
                    ];
                    $update = $dbObj->tbl_update($tblquery, $tblvalue);
                    if($update){
                        $e = $n = $errEmail = '';
                        echo "<script>  window.location='r/profile/success' </script>";
                    }
                }
            }else{
                $errEmail = 'invalid email';
            }
        }
        if(!$n){
            $n = $name_details;
        }

        if(!$e){
            $e = $email_details;
        }


        // password
        $errOld = $errNew = $errConfirm = '';
        if(isset($_POST['password'])){
            extract($_POST);
            $en_old_pwd = $secObj->encryptPassword($oldPassword);
            $en_new_pwd = $secObj->encryptPassword($newPassword);
            $en_cnew_pwd = $secObj->encryptPassword($cnewPassword);

            $tblquery = "SELECT id FROM referral WHERE id = :id AND password = :password";
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
                    $tblquery = "UPDATE referral SET password = :password WHERE id = :id";
                    $tblvalue = [
                        ':password' => htmlspecialchars($en_new_pwd),
                        ':id' => $_SESSION['myID']
                    ];
                    $update = $dbObj->tbl_update($tblquery, $tblvalue);
                    if($update){
                        $errOld = $errNew = $errConfirm = '';
                        echo 'done';
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
                $tblquery = "UPDATE referral SET img = :img WHERE id = :id";
                $tblvalue = [
                    ':img' => htmlspecialchars($enc_img_name),
                    ':id' => $_SESSION['myID']
                ];
                $update = $dbObj->tbl_update($tblquery, $tblvalue);
                if($update){
                    if($_SESSION['img']){
                        $delFile = $secObj->decryptURLParam($_SESSION['img']);
                        if(file_exists("uploads/referrals/$_SESSION[myID]/$delFile")){
                            unlink("uploads/referrals/$_SESSION[myID]/$delFile");
                        }
                    }

                    if(!is_dir("uploads/referrals/$_SESSION[myID]")){
                        mkdir("uploads/referrals/$_SESSION[myID]", 0777, true);
                    }
                    $location = "uploads/referrals/$_SESSION[myID]/$name";
                    move_uploaded_file($_FILES['img']['tmp_name'], $location);
                    $_SESSION['img'] = $enc_img_name;
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
                        $imgFile = $secObj->decryptURLParam($_SESSION['img']);
                        if($_SESSION['img'] AND file_exists("uploads/referrals/$_SESSION[myID]/$imgFile")){
                            echo "
                                <img src='uploads/referrals/$_SESSION[myID]/$imgFile' alt='User Image'>
                            ";
                        }else{
                            echo "
                                <img src='assets/images/profile.png' alt='User Image'>
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
                    
                                if($_SESSION['img']){
                                    $imgFile = $secObj->decryptURLParam($_SESSION['img']);
                                    echo "
                                        <img src='uploads/referrals/$_SESSION[myID]/$imgFile' alt='User Image' style='border-radius: 50%; height: 50px; width: 50px;' class='mb-2' id='output'/>
                                    ";
                                }else{
                                    echo "
                                        <img src='assets/images/profile.png' alt='User Image' style='border-radius: 50%; height: 50px; width: 50px;' class='mb-2' id='output'/>
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
                    <h5 class="modal-title" id="exampleModalLabel">Update Admin Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter name" value="<?php echo $n; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter email" value="<?php echo $e; ?>" required>
                            <span class="text-danger"><?php echo $errEmail; ?></span>
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