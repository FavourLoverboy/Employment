<section class="home">
    <div class="text">Clients</div>
    <?php 

        if(isset($_POST['view'])){
            extract($_POST);
            
            $_SESSION['cl_available'] = $available;
            $_SESSION['cl_status'] = $status;
            $_SESSION['cl_update_date'] = $update_date;
            $_SESSION['cl_last_seen'] = $last_seen;
            $_SESSION['cl_bio'] = $bio;
            $_SESSION['cl_ssn'] = $ssn;
            $_SESSION['cl_ads'] = $ads;
            $_SESSION['cl_cty'] = $cty;
            $_SESSION['cl_state'] = $state;
            $_SESSION['cl_country'] = $country;
            $_SESSION['cl_soo'] = $soo;
            $_SESSION['cl_nationality'] = $nationality;
            $_SESSION['cl_salary'] = $salary;
            $_SESSION['cl_skills'] = $skills;
            $_SESSION['cl_ref_name'] = $ref_name;
            $_SESSION['cl_ref_email'] = $ref_email;
            $_SESSION['cl_ref_number'] = $ref_number;
            $_SESSION['cl_id'] = $id;
            $_SESSION['cl_name'] = $name;
            $_SESSION['cl_email'] = $email;
            $_SESSION['cl_password'] = $password;
            $_SESSION['cl_img'] = $img;
            $_SESSION['cl_sex'] = $sex;
            $_SESSION['cl_dob'] = $dob;
            $_SESSION['cl_pn'] = $pn;
            $_SESSION['cl_ms'] = $ms;
    
            echo "<script>  window.location='a/view' </script>";
        }

    ?>
    <div id="dynamicContent">        
        <div class="table-section">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $tblquery = "SELECT * FROM users";
                        $tblvalue = [];
                        $select = $dbObj->tbl_select($tblquery, $tblvalue);
                        if($select){
                            foreach($select as $data){
                                extract($data);

                                $img = $secObj->decryptURLParam($img);
                                $ln = $secObj->decryptURLParam($ln);
                                $fn = $secObj->decryptURLParam($fn);
                                $mn = $secObj->decryptURLParam($mn);
                                $email = $secObj->decryptURLParam($email);
                                $password = $secObj->decryptURLParam($password);
                                $sex = $secObj->decryptURLParam($sex);
                                $dob = $secObj->decryptURLParam($dob);
                                $pn = $secObj->decryptURLParam($pn);
                                $ms = $secObj->decryptURLParam($ms);
                                $ref_name = $secObj->decryptURLParam($ref_name);
                                $ref_email = $secObj->decryptURLParam($ref_email);
                                $ref_number = $secObj->decryptURLParam($ref_number);
                                $skills = $secObj->decryptURLParam($skills);
                                $salary = $secObj->decryptURLParam($salary);
                                $nationality = $secObj->decryptURLParam($nationality);
                                $soo = $secObj->decryptURLParam($soo);
                                $country = $secObj->decryptURLParam($country);
                                $state = $secObj->decryptURLParam($state);
                                $cty = $secObj->decryptURLParam($cty);
                                $ads = $secObj->decryptURLParam($ads);
                                $ssn = $secObj->decryptURLParam($ssn);
                                $bio = $secObj->decryptURLParam($bio);
                                $last_seen = $secObj->decryptURLParam($last_seen);
                                $update_date = $secObj->decryptURLParam($update_date);
                                $available = $secObj->decryptURLParam($available);
                                $status = $secObj->decryptURLParam($status);
                                $date = $secObj->decryptURLParam($date);

                                if($status == "1"){
                                    $status = "active";
                                    $color = "btn-success";
                                }else{
                                    $status = "non active";
                                    $color = "btn-secondary";
                                }
                                

                                if(file_exists("uploads/$img")){
                                    $imgPath = "uploads/$img";
                                }elseif($sex == 'M'){
                                    $imgPath = "assets/images/profile.png";
                                }else{
                                    $imgPath = "assets/images/female.jpg";
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
                                            <button type='button' class='btn btn-sm $color'>$status</button>
                                        </td>
                                        <td>
                                            <form method='POST'>
                                                <input type='hidden' name='status' value='" . $status . "'>
                                                <input type='hidden' name='available' value='" . $available . "'>
                                                <input type='hidden' name='update_date' value='" . $update_date . "'>
                                                <input type='hidden' name='last_seen' value='" . $last_seen . "'>
                                                <input type='hidden' name='bio' value='" . $bio . "'>
                                                <input type='hidden' name='ssn' value='" . $ssn . "'>
                                                <input type='hidden' name='ads' value='" . $ads . "'>
                                                <input type='hidden' name='cty' value='" . $cty . "'>
                                                <input type='hidden' name='state' value='" . $state . "'>
                                                <input type='hidden' name='country' value='" . $country . "'>
                                                <input type='hidden' name='soo' value='" . $soo . "'>
                                                <input type='hidden' name='nationality' value='" . $nationality . "'>
                                                <input type='hidden' name='salary' value='" . $salary . "'>
                                                <input type='hidden' name='skills' value='" . $skills . "'>
                                                <input type='hidden' name='ref_name' value='" . $ref_name . "'>
                                                <input type='hidden' name='ref_email' value='" . $ref_email . "'>
                                                <input type='hidden' name='ref_number' value='" . $ref_number . "'>
                                                <input type='hidden' name='id' value='" . $id . "'>
                                                <input type='hidden' name='name' value='" . $ln . ", " . $fn . " " . $mn . "'>
                                                <input type='hidden' name='email' value='" . $email . "'>
                                                <input type='hidden' name='password' value='" . $password . "'>
                                                <input type='hidden' name='img' value='" . $imgPath . "'>
                                                <input type='hidden' name='sex' value='" . $sex . "'>
                                                <input type='hidden' name='dob' value='" . $dob . "'>
                                                <input type='hidden' name='pn' value='" . $pn . "'>
                                                <input type='hidden' name='ms' value='" . $ms . "'>
                                                <input name='view' type='submit' class='btn btn-info btn-sm' value='view'>
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