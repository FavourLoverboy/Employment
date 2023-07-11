<section class="home">
    <?php 
        if(isset($_POST['approve'])){
            extract($_POST);
            $tblquery = "UPDATE enroll SET status = :status WHERE id = :id";
            $tblvalue = [
                ':status' => htmlspecialchars($secObj->encryptURLParam('2')),
                ':id' => htmlspecialchars($id)
            ];
            $update = $dbObj->tbl_update($tblquery, $tblvalue);
            if($update){
                echo "<script>  window.location='a/payment/success' </script>";
            }
        }

        if(isset($_POST['delete'])){
            extract($_POST);
            $tblquery = "UPDATE enroll SET status = :status WHERE id = :id";
            $tblvalue = [
                ':status' => htmlspecialchars($secObj->encryptURLParam('0')),
                ':id' => htmlspecialchars($id)
            ];
            $update = $dbObj->tbl_update($tblquery, $tblvalue);
            if($update){
                echo "<script>  window.location='a/payment/delete' </script>";
            }
        }

    ?>
    <div id="dynamicContent">
        <div class="text">Enrolled</div>
        <div class="table-section">
            <?php 
                
                if(isset($url[2]) AND $url[2] == 'success'){
                    echo "<p class='text-success'>Payment have been approve</p>";
                }elseif(isset($url[2]) AND $url[2] == 'delete'){
                    echo "<p class='text-danger'>Payment have been removed</p>";
                }
            
            ?>
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Delete</th>
                        <th>Appove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $tblquery = "SELECT users.ln, users.fn, users.mn, users.email, enroll.id, enroll.amt, enroll.date FROM users LEFT JOIN enroll ON users.id = enroll.userId WHERE enroll.status = :status";
                        $tblvalue = [
                            ':status' => htmlspecialchars($secObj->encryptURLParam('1'))
                        ];
                        $select = $dbObj->tbl_select($tblquery, $tblvalue);
                        if($select){
                            foreach($select as $data){
                                extract($data);
                                $ln = $secObj->decryptURLParam($ln);
                                $fn = $secObj->decryptURLParam($fn);
                                $mn = '';
                                if($mn){
                                    $mn = $secObj->decryptURLParam($mn);
                                }
                                
                                $email = $secObj->decryptURLParam($email);
                                $amt = $secObj->decryptURLParam($amt);
                                $date = $secObj->decryptURLParam($date);
                                
                                echo "
                                    <tr>
                                        <td>$ln " . $fn . " $mn</td>
                                        <td>$email</td>
                                        <td>$$amt</td>
                                        <td>$date</td>
                                        <td>
                                            <form method='POST'>
                                                <input type='hidden' name='id' value='" . $id . "'>
                                                <button name='delete' type='submit' class='btn btn-sm btn-danger'>Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method='POST'>
                                                <input type='hidden' name='id' value='" . $id . "'>
                                                <button name='approve' type='submit' class='btn btn-sm btn-success'>Approve</button>
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
