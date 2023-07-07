<section class="home">
    <?php 
        $e = $n = $errEmail = '';
        $validate_email = true;
        if($_POST){
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
                $tblquery = "SELECT * FROM referral WHERE email = :email";
                $tblvalue = [
                    ':email' => htmlspecialchars($enc_email)
                ];
                $select = $dbObj->tbl_select($tblquery, $tblvalue);
                if(!$select){
                    $password = $secObj->encryptPassword('123456');
                    $code = $secObj->encryptURLParam(substr(time(), -5));
                    $date = date('Y-m-d');
                    $date = $secObj->encryptURLParam($date);
                    $status = $secObj->encryptURLParam('1');

                    $tblquery = "INSERT INTO referral VALUES(:id, :name, :email, :password, :code, :img, :date, :status)";
                    $tblvalue = [
                        ':id' => NULL, 
                        ':name' => htmlspecialchars($enc_name),
                        ':email' => htmlspecialchars($enc_email), 
                        ':password' => htmlspecialchars($password), 
                        ':code' => htmlspecialchars($code),
                        ':img' => htmlspecialchars(""),
                        ':date' => htmlspecialchars($date),
                        ':status' => htmlspecialchars($status)
                    ];
                    $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
                    if($insert){
                        $e = $n = $errEmail = '';
                        echo "<script>  window.location='a/referrals/success' </script>";
                    }
                }else{
                    $errEmail = 'email already in use';
                }
            }else{
                $errEmail = 'invalid email';
            }
        }

    ?>
    <div id="dynamicContent">
        <div class="button-section">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add referral
            </button>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Referral Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter referral name" value="<?php echo $n; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Enter referral email" value="<?php echo $e; ?>" required>
                                <span class="text-danger"><?php echo $errEmail; ?></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="table-section">
            <?php 
            
                if(isset($url[2]) AND $url[2] == 'success'){
                    echo "<p class='text-success'>referral have been added</p>";
                }elseif(isset($errEmail)){
                    echo "<p class='text-danger'>$errEmail</p>";
                }
            
            ?>
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>view</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $tblquery = "SELECT referral.id, referral.name, referral.email, referral.code, referral.img, referral.date, referral.status, COUNT(users.id) AS user_count FROM referral LEFT JOIN users ON referral.code = users.ref GROUP BY referral.code ORDER BY referral.name";
                        $tblvalue = [];
                        $select = $dbObj->tbl_select($tblquery, $tblvalue);
                        if($select){
                            foreach($select as $data){
                                extract($data);
                                $name = $secObj->decryptURLParam($name);
                                $email = $secObj->decryptURLParam($email);
                                $code = $secObj->decryptURLParam($code);
                                $date = $secObj->decryptURLParam($date);
                                $status = $secObj->decryptURLParam($status);
                                if($status == '1'){
                                    $status = 'active';
                                    $color = 'btn-success';
                                }else{
                                    $status = 'disable';
                                    $color = 'btn-danger';
                                }

                                if($img){
                                    $img = $secObj->decryptURLParam($img);
                                    $imgPath = "uploads/referrals/" . $id . "/$img";
                                }else{
                                    $imgPath = "assets/images/profile.png";
                                }
                                echo "
                                    <tr>
                                        <td>
                                            <img src='$imgPath' alt='referral image' style='border-radius: 50%;height:30px; width:30px;'>
                                        </td>
                                        <td>$name</td>
                                        <td> " . $user_count . "</td>
                                        <td>$email</td>
                                        <td>$code</td>
                                        <td>$date</td>
                                        <td>
                                            <span class='btn $color btn-sm'>$status</span>
                                        </td>
                                        <td>
                                            <form>
                                                <input type='submit' class='btn btn-info btn-sm' value='view'>
                                            </form>
                                        </td>
                                    </tr>
                                ";
                            }
                        }
                    
                    ?>                    
				</tbody>
            </table>
        </div>
    </div>
</section>