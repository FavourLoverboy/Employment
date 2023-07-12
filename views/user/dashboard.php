<section class="home">
    <div class="text">Dashboard</div>
    <div class="container-dashboard">

        <?php 
            
            $tblquery = "SELECT COUNT(id) AS totalJobs FROM jobs WHERE status = :status";
            $tblvalue = [
                ':status' => htmlspecialchars($secObj->encryptURLParam('1'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>Jobs</h2>
                        <p>" . $select[0]['totalJobs'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>
        
        <?php 
            
            $tblquery = "SELECT COUNT(id) AS totalEnroll FROM enroll WHERE userId = :id AND status = :status";
            $tblvalue = [
                ':id' => $_SESSION['myID'],
                ':status' => htmlspecialchars($secObj->encryptURLParam('1'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>Pending</h2>
                        <p>" . $select[0]['totalEnroll'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>

        <?php 
            
            $tblquery = "SELECT COUNT(id) AS totalEnroll FROM enroll WHERE userId = :id AND status = :status";
            $tblvalue = [
                ':id' => $_SESSION['myID'],
                ':status' => htmlspecialchars($secObj->encryptURLParam('2'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>Processing</h2>
                        <p>" . $select[0]['totalEnroll'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>

        <?php 
            
            $tblquery = "SELECT COUNT(id) AS totalEnroll FROM enroll WHERE userId = :id AND status = :status";
            $tblvalue = [
                ':id' => $_SESSION['myID'],
                ':status' => htmlspecialchars($secObj->encryptURLParam('4'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>not selected</h2>
                        <p>" . $select[0]['totalEnroll'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>

        <?php 
            
            $tblquery = "SELECT COUNT(id) AS totalEnroll FROM enroll WHERE userId = :id AND status = :status";
            $tblvalue = [
                ':id' => $_SESSION['myID'],
                ':status' => htmlspecialchars($secObj->encryptURLParam('3'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>employed</h2>
                        <p>" . $select[0]['totalEnroll'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>
        
    </div>

    <div id="dynamicContent">
        <div class="text" style="font-size: 25px;">Recent Jobs</div>
        <div class="table-section">
            <table id="" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sluts</th>
                        <th>Fee</th>
                        <th>Payment</th>
                        <th>Time</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $tblquery = "SELECT * FROM jobs WHERE status = :status ORDER BY id DESC LIMIT 7";
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