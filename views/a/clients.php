<section class="home">
    <div class="text">Clients</div>
    <?php 

        if(isset($_POST['view'])){
            extract($_POST);
            echo 'viewed';
            // $tblquery = "UPDATE users SET status = :status WHERE id = :id";
            // $tblvalue = [
            //     ':status' => htmlspecialchars($secObj->encryptURLParam('1')),
            //     ':id' => $id
            // ];
            // $update = $dbObj->tbl_update($tblquery, $tblvalue);
            // if($update){
            //     echo "<script>  window.location='a/suspend/success' </script>";
            // }
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
                        <th colspan="2">Action</th>
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