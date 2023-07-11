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
        <div class="text">Enrolled</div>
        <div class="table-section">
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sluts</th>
                        <th>Fee</th>
                        <th>Payment</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $tblquery = "SELECT jobs.title, jobs.ava, jobs.slut, jobs.amt, jobs.payment, jobs.des, jobs.date, enroll.status AS enStatus FROM jobs LEFT JOIN enroll ON jobs.id = enroll.job_id WHERE enroll.userId = :id AND jobs.status != :status GROUP BY jobs.id, jobs.title, jobs.ava, jobs.slut, jobs.amt, jobs.payment, jobs.des";
                        $tblvalue = [
                            ':id' => $_SESSION['myID'],
                            ':status' => htmlspecialchars($secObj->encryptURLParam('2'))
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
                                $status = $secObj->decryptURLParam($enStatus);
                                if($status == "1"){
                                    $text = 'Pending';
                                    $color = 'btn-warning';
                                }elseif($status == "1"){

                                }
                                
                                echo "
                                    <tr>
                                        <td>$name</td>
                                        <td>$slut</td>
                                        <td>$$amt</td>
                                        <td>$payment</td>
                                        <td>$ava</td>
                                        <td>$date</td>
                                        <td>
                                            <button class='btn btn-sm $color'>$text</button>
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
