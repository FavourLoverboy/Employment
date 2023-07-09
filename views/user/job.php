<section class="home">
    <?php 
        if($_POST){
            extract($_POST);

            $_SESSION['job_id'] = $id;
            $_SESSION['job_name'] = $name;
            $_SESSION['job_slut'] = $slut;
            $_SESSION['job_amt'] = $amt;
            $_SESSION['job_payment'] = $payment;
            $_SESSION['job_ava'] = $ava;
            $_SESSION['job_des'] = $des;
            $_SESSION['job_date'] = $date;

            echo "<script>  window.location='user/enroll' </script>";
        }

    ?>
    <div id="dynamicContent">
        <div class="text">Jobs</div>
        <div class="table-section">
            <?php 
            
                if(isset($url[2]) AND $url[2] == 'success'){
                    echo "<p class='text-success'>Job have been added</p>";
                }
            
            ?>
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sluts</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Enroll</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $tblquery = "SELECT * FROM jobs WHERE status = :status ORDER BY id DESC";
                        $tblvalue = [
                            ':status' => $secObj->encryptURLParam('1')
                        ];
                        $select = $dbObj->tbl_select($tblquery, $tblvalue);
                        if($select){
                            foreach($select as $data){
                                extract($data);
                                $name = $secObj->decryptURLParam($title);
                                $slut = $secObj->decryptURLParam($slut);
                                $amt = $secObj->decryptURLParam($amt);
                                $payment = $secObj->decryptURLParam($payment);
                                $ava = $secObj->decryptURLParam($ava);
                                $des = $secObj->decryptURLParam($des);
                                $date = $secObj->decryptURLParam($date);
                                echo "
                                    <tr>
                                        <td>$name</td>
                                        <td>$slut</td>
                                        <td>$$amt</td>
                                        <td>$payment</td>
                                        <td>$ava</td>
                                        <td>$date</td>
                                        <td>
                                            <form method='POST'>
                                                <input type='hidden' name='id' value='" . $id . "'>
                                                <input type='hidden' name='name' value='" . $name . "'>
                                                <input type='hidden' name='slut' value='" . $slut . "'>
                                                <input type='hidden' name='amt' value='" . $amt . "'>
                                                <input type='hidden' name='payment' value='" . $payment . "'>
                                                <input type='hidden' name='ava' value='" . $ava . "'>
                                                <input type='hidden' name='des' value='" . $des . "'>
                                                <input type='hidden' name='date' value='" . $date . "'>
                                                <input name='enroll' type='submit' class='btn btn-info btn-sm' value='enroll'>
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