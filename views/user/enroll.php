<section class="home">
    <div class="text">Job Details</div>
    <?php
        $tblquery = "SELECT * FROM enroll WHERE job_id = :job_id AND userId = :userId";
        $tblvalue = [
            ':job_id' => $_SESSION['job_id'],
            ':userId' => $_SESSION['myID']
        ];
        $select = $dbObj->tbl_select($tblquery, $tblvalue);
        if($select){
            echo "<script>  window.location='user/job' </script>";
        }

        if(isset($_POST['enroll'])){
            extract($_POST);
            $tblquery = "INSERT INTO enroll VALUES(:id, :job_id, :userId, :pm, :amt, :date, :status)";
            $tblvalue = [
                ':id' => NULL,
                ':job_id' => htmlspecialchars($_SESSION['job_id']),
                ':userId' => htmlspecialchars($_SESSION['myID']),
                ':pm' => htmlspecialchars($secObj->encryptURLParam($kind)),
                ':amt' => htmlspecialchars($secObj->encryptURLParam($_SESSION['job_amt'])),
                ':date' => htmlspecialchars($secObj->encryptURLParam(date('Y-m-d'))),
                ':status' => htmlspecialchars($secObj->encryptURLParam('1'))
            ];
            $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
            if($insert){
                echo "<script>  window.location='user/enroll/success' </script>";
            }
        }
    
    ?>
    <div class="job-container">
        <form method="POST">
            <div class="job-details">
                <p><label>Job Title:</label> <?php echo $_SESSION['job_name']; ?></p>
                <p><label>Sluts:</label> <?php echo $_SESSION['job_slut']; ?></p>
                <p><label>Fee:</label> $<?php echo $_SESSION['job_amt']; ?></p>
                <p><label>Time:</label> <?php echo $_SESSION['job_ava']; ?></p>
                <p><label>Payment Time:</label> <?php echo $_SESSION['job_payment']; ?></p>
                <p><label>Date:</label> <?php echo $_SESSION['job_date']; ?></p>
            </div>
            <div class="job-description">
                <label>Description:</label>
                <p class="text-justify"><?php echo $_SESSION['job_des']; ?></p>
            </div>
            
            <div class="job-footer">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">Enroll</button>
            </div>
        </form>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST">
                    <?php
                    
                        $tblquery = "SELECT content FROM setting WHERE type = :type";
                        $tblvalue = [
                            ':type' => $secObj->encryptURLParam('pm'),
                        ];
                        $select = $dbObj->tbl_select($tblquery, $tblvalue);
                        if($select){
                            if($secObj->decryptURLParam($select[0]['content']) == "Bank"){
                                $bankName = $accountName = $accountNumber = $routingNubmer = $swiftCode = "";
                                $tblquery = "SELECT content FROM setting WHERE type = :type";
                                $tblvalue = [
                                    ':type' => $secObj->encryptURLParam('bank'),
                                ];
                                $selectBank = $dbObj->tbl_select($tblquery, $tblvalue);
                                if($selectBank){
                                    $bankDetails = explode(',', $secObj->decryptURLParam($selectBank[0]['content']));
                                    $bankName = $bankDetails[0];
                                    $accountName = $bankDetails[1];
                                    $accountNumber = $bankDetails[2];
                                    $routingNumber = $bankDetails[3];
                                    $swiftCode = $bankDetails[4];
                                }
                                echo "
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>Account Details</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <div class='job-details'>
                                            <p><label>Bank Name:</label> $bankName</p>
                                            <p><label>Account Name:</label> $accountName</p>
                                            <p><label>Account Number:</label> $accountNumber</p>
                                            <p><label>Routing Number:</label> " . $routingNumber . "</p>
                                            <p><label>Swift Code</label> $swiftCode</p>
                                        </div>
                                        <div class='job-description'>
                                            <p class='text-justify'><b>Warning:</b> Please make sure to send your payment to the correct bank account number and routing number.</p>
                                        </div>
                                        <div class='form-group'>
                                            <label for='sst'>Screen Shot (Optional)</label>
                                            <input type='file' name='sst' id='sst'>
                                        </div>
                                        <div class='job-description'>
                                            <p class='text-justify'>Click on Apply after the payment.</p>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <input type='hidden' name='kind' value='Bank'>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                        <button name='enroll' type='submit' class='btn btn-primary'>Apply</button>
                                    </div>
                                ";
                            }elseif($secObj->decryptURLParam($select[0]['content']) == "Crypto Currency"){
                                $cryptoType = $walletAds = "";
                                $tblquery = "SELECT content FROM setting WHERE type = :type";
                                $tblvalue = [
                                    ':type' => $secObj->encryptURLParam('crypto'),
                                ];
                                $selectCrypto = $dbObj->tbl_select($tblquery, $tblvalue);
                                if($selectCrypto){
                                    $cryptoDetails = explode(',', $secObj->decryptURLParam($selectCrypto[0]['content']));
                                    $cryptoType = $cryptoDetails[0];
                                    $walletAds = $cryptoDetails[1];
                                }
                                echo "
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>Crypto Details</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <div class='job-details'>
                                            <p><label>Crypto:</label> $cryptoType</p>
                                            <p><label>Wallet Address:</label> $walletAds</p>
                                        </div>
                                        <div class='job-description'>
                                            <p class='text-justify'><b>Warning:</b> Please make sure to send your payment to the correct crypto wallet address. If you send your payment to the wrong address, you will not be able to recover your funds.</p>
                                        </div>
                                        <div class='form-group'>
                                            <label for='sst'>Screen Shot (Optional)</label>
                                            <input type='file' name='sst' id='sst'>
                                        </div>
                                        <div class='job-description'>
                                            <p class='text-justify'>Click on Apply after the payment.</p>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <input type='hidden' name='kind' value='Crypto: $cryptoType'>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                        <button name='enroll' type='submit' class='btn btn-primary'>Apply</button>
                                    </div>
                                ";
                            }elseif($secObj->decryptURLParam($select[0]['content']) == "Cash App"){
                                $cashAppName = $cashAppTag = "";
                                $tblquery = "SELECT content FROM setting WHERE type = :type";
                                $tblvalue = [
                                    ':type' => $secObj->encryptURLParam('Cash App'),
                                ];
                                $selectCashApp = $dbObj->tbl_select($tblquery, $tblvalue);
                                if($selectCashApp){
                                    $cashAppDetails = explode(',', $secObj->decryptURLParam($selectCashApp[0]['content']));
                                    $cashAppName = $cashAppDetails[0];
                                    $cashAppTag = $cashAppDetails[1];
                                }
                                echo "
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>Cash App Details</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <div class='job-details'>
                                            <p><label>Cash App Name:</label> $cashAppName</p>
                                            <p><label>Cash App Tag:</label> $cashAppTag</p>
                                        </div>
                                        <div class='job-description'>
                                            <p class='text-justify'><b>Warning:</b> Please make sure to send your payment to the correct Cash App Cashtag.</p>
                                        </div>
                                        <div class='form-group'>
                                            <label for='sst'>Screen Shot (Optional)</label>
                                            <input type='file' name='sst' id='sst'>
                                        </div>
                                        <div class='job-description'>
                                            <p class='text-justify'>Click on Apply after the payment.</p>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <input type='hidden' name='kind' value='Cash App'>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                        <button name='enroll' type='submit' class='btn btn-primary'>Apply</button>
                                    </div>
                                ";
                            }elseif($secObj->decryptURLParam($select[0]['content']) == "PayPal"){
                                $payPalName = $payPalEmail = "";
                                $tblquery = "SELECT content FROM setting WHERE type = :type";
                                $tblvalue = [
                                    ':type' => $secObj->encryptURLParam('PayPal'),
                                ];
                                $selectPayPal = $dbObj->tbl_select($tblquery, $tblvalue);
                                if($selectPayPal){
                                    $payPalDetails = explode(',', $secObj->decryptURLParam($selectPayPal[0]['content']));
                                    $payPalName = $payPalDetails[0];
                                    $payPalEmail = $payPalDetails[1];
                                }
                                echo "
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>PayPal Details</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <div class='job-details'>
                                            <p><label>PayPal Name:</label> $payPalName</p>
                                            <p><label>PayPal Email:</label> $payPalEmail</p>
                                        </div>
                                        <div class='job-description'>
                                            <p class='text-justify'><b>Warning:</b> Please make sure to send your payment to the correct PayPal email address.</p>
                                        </div>
                                        <div class='form-group'>
                                            <label for='sst'>Screen Shot (Optional)</label>
                                            <input type='file' name='sst' id='sst'>
                                        </div>
                                        <div class='job-description'>
                                            <p class='text-justify'>Click on Apply after the payment.</p>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <input type='hidden' name='kind' value='PayPal'>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                        <button name='enroll' type='submit' class='btn btn-primary'>Apply</button>
                                    </div>
                                ";
                            }
                        }
                    
                    ?>
                </form>
            </div>
        </div>
    </div>
</section>