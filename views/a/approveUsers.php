<section class="home">
    <?php 

        if(isset($_POST['add'])){
            extract($_POST);
            $tblquery = "INSERT INTO users VALUES(:id, :ln, :fn, :mn, :email, :password, :sex, :dob, :pn, :ms, :ref_name, :ref_email, :ref_number, :skills, :salary, :nationality, :soo, :country, :state, :cty, :ads, :ssn, :img, :cv, :bio, :last_seen, :update_date, :available, :date, :status)";
            $tblvalue = [
                ':id' => NULL, 
                ':ln' => htmlspecialchars($secObj->encryptURLParam($ln)),
                ':fn' => htmlspecialchars($secObj->encryptURLParam($fn)),
                ':mn' => htmlspecialchars($secObj->encryptURLParam($mn)),
                ':email' => htmlspecialchars($secObj->encryptURLParam($email)), 
                ':password' => htmlspecialchars($password), 
                ':sex' => htmlspecialchars($secObj->encryptURLParam($sex)),
                ':dob' => htmlspecialchars($dob),
                ':pn' => htmlspecialchars($pn),
                ':ms' => htmlspecialchars($ms),
                ':ref_name' => htmlspecialchars($ref_name),
                ':ref_email' => htmlspecialchars($ref_email),
                ':ref_number' => htmlspecialchars($ref_number),
                ':skills' => htmlspecialchars($skills), 
                ':salary' => htmlspecialchars($salary), 
                ':nationality' => htmlspecialchars($nationality),
                ':soo' => htmlspecialchars($soo),
                ':country' => htmlspecialchars($country),
                ':state' => htmlspecialchars($state),
                ':cty' => htmlspecialchars($cty),
                ':ads' => htmlspecialchars($ads),
                ':ssn' => htmlspecialchars($ssn),
                ':img' => htmlspecialchars($img),
                ':cv' => htmlspecialchars(""),
                ':bio' => htmlspecialchars($bio),
                ':last_seen' => htmlspecialchars($secObj->encryptURLParam($date)),
                ':update_date' => htmlspecialchars($secObj->encryptURLParam($date)),
                ':available' => htmlspecialchars($available),
                ':date' => htmlspecialchars($secObj->encryptURLParam($date)),
                ':status' => htmlspecialchars($secObj->encryptURLParam('1'))
            ];
            $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
            if($insert){
                $tblquery = "UPDATE not_verify SET verify = :verify WHERE id = :id";
                $tblvalue = [
                    ':verify' => htmlspecialchars($secObj->encryptURLParam('1')),
                    ':id' => $id
                ];
                $update = $dbObj->tbl_update($tblquery, $tblvalue);
                if($update){
                    echo "<script>  window.location='a/approveUsers/success' </script>";
                }
            }
        }
        if(isset($_POST['remove'])){
            extract($_POST);
            $tblquery = "UPDATE not_verify SET verify = :verify WHERE id = :id";
            $tblvalue = [
                ':verify' => htmlspecialchars($secObj->encryptURLParam('2')),
                ':id' => $id
            ];
            $update = $dbObj->tbl_update($tblquery, $tblvalue);
            if($update){
                echo "<script>  window.location='a/approveUsers/delete' </script>";
            }
        }

    ?>
    <div id="dynamicContent">        
        <div class="table-section">
            <?php 
            
                if(isset($url[2]) AND $url[2] == 'success'){
                    echo "<p class='text-success'>user account has been approved</p>";
                }elseif(isset($url[2]) AND $url[2] == 'delete'){
                    echo "<p class='text-danger'>account removed</p>";
                }
            
            ?>
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $tblquery = "SELECT * FROM not_verify WHERE verify = :verify";
                        $tblvalue = [
                            ':verify' => htmlspecialchars($secObj->encryptURLParam('0'))
                        ];
                        $select = $dbObj->tbl_select($tblquery, $tblvalue);
                        if($select){
                            foreach($select as $data){
                                extract($data);

                                $img = $secObj->decryptURLParam($img);
                                $ln = $secObj->decryptURLParam($ln);
                                $fn = $secObj->decryptURLParam($fn);
                                $mn = $secObj->decryptURLParam($mn);
                                $email = $secObj->decryptURLParam($email);
                                $sex = $secObj->decryptURLParam($sex);
                                $date = $secObj->decryptURLParam($date);

                                if(file_exists("uploads/$img")){
                                    $imgPath = "uploads/$img";
                                }elseif($sex == 'M'){
                                    $imgPath = "assets/images/profile.png";
                                }else{
                                    $imgPath = "assets/images/female.png";
                                }
                                echo "
                                    <tr>
                                        <td>
                                            <img src='$imgPath' alt='user image' style='border-radius: 50%;height:30px; width:30px;'>
                                        </td>
                                        <td>$ln $fn $mn</td>
                                        <td>$email</td>
                                        <td>$date</td>
                                        <td>
                                            <form method='POST'>
                                                <input type='hidden' name='id' value='" . $id . "'>
                                                <input type='hidden' name='ln' value='$ln'>
                                                <input type='hidden' name='fn' value='$fn'>
                                                <input type='hidden' name='mn' value='$mn'>
                                                <input type='hidden' name='email' value='$email'>
                                                <input type='hidden' name='password' value='" . $password . "'>
                                                <input type='hidden' name='sex' value='$sex'>
                                                <input type='hidden' name='dob' value='" . $dob . "'>
                                                <input type='hidden' name='pn' value='" . $pn . "'>
                                                <input type='hidden' name='ms' value='" . $ms . "'>
                                                <input type='hidden' name='ref_name' value='" . $ref_name . "'>
                                                <input type='hidden' name='ref_email' value='" . $ref_email . "'>
                                                <input type='hidden' name='ref_number' value='" . $ref_number . "'>
                                                <input type='hidden' name='skills' value='" . $skills . "'>
                                                <input type='hidden' name='salary' value='" . $salary . "'>
                                                <input type='hidden' name='nationality' value='" . $nationality . "'>
                                                <input type='hidden' name='soo' value='" . $soo . "'>
                                                <input type='hidden' name='country' value='" . $country . "'>
                                                <input type='hidden' name='state' value='" . $state . "'>
                                                <input type='hidden' name='cty' value='" . $cty . "'>
                                                <input type='hidden' name='ads' value='" . $ads . "'>
                                                <input type='hidden' name='ssn' value='" . $ssn . "'>
                                                <input type='hidden' name='img' value='$img'>
                                                <input type='hidden' name='bio' value='" . $bio . "'>
                                                <input type='hidden' name='available' value='" . $available . "'>
                                                <input type='hidden' name='date' value='$date'>
                                                <input name='add' type='submit' class='btn btn-success btn-sm' value='approve'>
                                            </form>
                                        </td>
                                        <td>
                                            <form method='POST'>
                                                <input type='hidden' name='id' value='" . $id . "'>
                                                <input name='remove' type='submit' class='btn btn-danger btn-sm' value='delete'>
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