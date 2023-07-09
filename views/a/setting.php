<section class="home">
    <div class="text">Setting</div>
    <?php
        $pym_mth = '';

        // payment method
        $tblquery = "SELECT content FROM setting WHERE type = :type";
        $tblvalue = [
            ':type' => $secObj->encryptURLParam('pm'),
        ];
        $select = $dbObj->tbl_select($tblquery, $tblvalue);
        if($select){
            $pym_mth = $secObj->decryptURLParam($select[0]['content']);
        }
    
    ?>

    <?php 
            
        if(isset($url[2]) AND $url[2] == 'success'){
            echo "<p class='text-success'>Updated</p>";
        }
    
    ?>
    <div class="job-container">
        <?php
        
            if(isset($_POST['pm_btn'])){
                extract($_POST);
                $tblquery = "DELETE FROM setting WHERE type = :type";
                $tblvalue = [
                    ':type' => $secObj->encryptURLParam('pm'),
                ];
                $delete = $dbObj->tbl_delete($tblquery, $tblvalue);
                $tblquery = "INSERT INTO setting VALUES(:id, :type, :content, :date)";
                $tblvalue = [
                    ':id' => NULL, 
                    ':type' => htmlspecialchars($secObj->encryptURLParam("pm")),
                    ':content' => htmlspecialchars($secObj->encryptURLParam($pm)),
                    ':date' => htmlspecialchars($secObj->encryptURLParam(date('Y-m-d')))
                ];
                $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
                if($insert){
                    echo "<script>  window.location='a/setting/success' </script>";
                }
            }
        
        ?>
        <form method="POST">
            <div class="form-group">
                <label>Payment Method</label>
            </div>
            <div class="form-group">
                <label>Current Method</label>
                <input type="text" value="<?php echo $pym_mth; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="pm">Payment Method</label>
                <select id="pm" name="pm" required>
                    <option value=''>Choose</option>
                    <option value='Bank'>Bank</option>
                    <option value='Cash App'>Cash App</option>
                    <option value='Crypto Currency'>Crypto Currency</option>
                    <option value='PayPal'>PayPal</option>
                </select>
            </div>
            <div class="job-footer">
                <button name="pm_btn" type="submit" class="btn btn-secondary">Save</button>
            </div>
        </form>
    </div>

    <div class="job-container">
        <?php
        
            if(isset($_POST['bank'])){
                extract($_POST);
                $tblquery = "DELETE FROM setting WHERE type = :type";
                $tblvalue = [
                    ':type' => $secObj->encryptURLParam('bank'),
                ];
                $delete = $dbObj->tbl_delete($tblquery, $tblvalue);

                $bankDetails = ucwords($name) . "," . $an . "," . ucwords($ac) . "," . $rn . "," . $sc;
                $tblquery = "INSERT INTO setting VALUES(:id, :type, :content, :date)";
                $tblvalue = [
                    ':id' => NULL, 
                    ':type' => htmlspecialchars($secObj->encryptURLParam("bank")),
                    ':content' => htmlspecialchars($secObj->encryptURLParam($bankDetails)),
                    ':date' => htmlspecialchars($secObj->encryptURLParam(date('Y-m-d')))
                ];
                $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
                if($insert){
                    echo "<script>  window.location='a/setting/success' </script>";
                }
            }
            if(isset($_POST['crypto'])){
                extract($_POST);
                $tblquery = "DELETE FROM setting WHERE type = :type";
                $tblvalue = [
                    ':type' => $secObj->encryptURLParam('crypto'),
                ];
                $delete = $dbObj->tbl_delete($tblquery, $tblvalue);

                $cDetails = $cc. "," . $wa;
                $tblquery = "INSERT INTO setting VALUES(:id, :type, :content, :date)";
                $tblvalue = [
                    ':id' => NULL, 
                    ':type' => htmlspecialchars($secObj->encryptURLParam("crypto")),
                    ':content' => htmlspecialchars($secObj->encryptURLParam($cDetails)),
                    ':date' => htmlspecialchars($secObj->encryptURLParam(date('Y-m-d')))
                ];
                $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
                if($insert){
                    echo "<script>  window.location='a/setting/success' </script>";
                }
            }
            if(isset($_POST['cashapp'])){
                extract($_POST);
                $tblquery = "DELETE FROM setting WHERE type = :type";
                $tblvalue = [
                    ':type' => $secObj->encryptURLParam('Cash App'),
                ];
                $delete = $dbObj->tbl_delete($tblquery, $tblvalue);

                $cDetails = ucwords($can) . "," . $cat;
                $tblquery = "INSERT INTO setting VALUES(:id, :type, :content, :date)";
                $tblvalue = [
                    ':id' => NULL, 
                    ':type' => htmlspecialchars($secObj->encryptURLParam("Cash App")),
                    ':content' => htmlspecialchars($secObj->encryptURLParam($cDetails)),
                    ':date' => htmlspecialchars($secObj->encryptURLParam(date('Y-m-d')))
                ];
                $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
                if($insert){
                    echo "<script>  window.location='a/setting/success' </script>";
                }
            }
            if(isset($_POST['paypal'])){
                extract($_POST);
                $tblquery = "DELETE FROM setting WHERE type = :type";
                $tblvalue = [
                    ':type' => $secObj->encryptURLParam('PayPal'),
                ];
                $delete = $dbObj->tbl_delete($tblquery, $tblvalue);

                $payPayDetails = ucwords($ppn) . "," . strtolower($ppe);
                $tblquery = "INSERT INTO setting VALUES(:id, :type, :content, :date)";
                $tblvalue = [
                    ':id' => NULL, 
                    ':type' => htmlspecialchars($secObj->encryptURLParam("PayPal")),
                    ':content' => htmlspecialchars($secObj->encryptURLParam($payPayDetails)),
                    ':date' => htmlspecialchars($secObj->encryptURLParam(date('Y-m-d')))
                ];
                $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
                if($insert){
                    echo "<script>  window.location='a/setting/success' </script>";
                }
            }

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
                        $routingNubmer = $bankDetails[3];
                        $swiftCode = $bankDetails[4];
                    }
                    echo "
                        <form method='POST'>
                            <div class='form-group'>
                                <label>Bank Details</label>
                            </div>
                            <div class='form-group'>
                                <label for='name'>Bank Name</label>
                                <input type='text' name='name' id='name' placeholder='enter bank name' value='" . $bankName . "' required>
                            </div>
                            <div class='form-group'>
                                <label for='an'>Account Name</label>
                                <input type='text' name='an' id='an' placeholder='enter account name' value='" . $accountName . "' required>
                            </div>
                            <div class='form-group'>
                                <label for='ac'>Account Number</label>
                                <input type='number' name='ac' id='ac' placeholder='enter account number' value='" . $accountNumber . "' required>
                            </div>
                            <div class='form-group'>
                                <label for='rn'>Routing Number</label>
                                <input type='number' name='rn' id='rn' placeholder='enter routing number' value='" . $routingNubmer . "'>
                            </div>
                            <div class='form-group'>
                                <label for='sc'>Swift Code</label>
                                <input type='text' name='sc' id='sc' placeholder='enter swift code' value='" . $swiftCode . "' required>
                            </div>
                            
                            <div class='job-footer'>
                                <button name='bank' type='submit' class='btn btn-secondary'>Save</button>
                            </div>
                        </form>
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
                        $walletAds= $cryptoDetails[1];
                    }
                    echo "
                        <form method='POST'>
                            <div class='form-group'>
                                <label>Crypto Details</label>
                            </div>
                            <div class='form-group'>
                                <label for='cc'>Crypto Currencies</label>
                                <select id='cc' name='cc' required>
                                    <option value=''>$cryptoType</option>
                                    <option value='Bitcoin (BTC)'>Bitcoin (BTC)</option>
                                    <option value='BNB (Binance Coin)'>BNB (Binance Coin)</option>
                                    <option value='Dogecoin (DOGE)'>Dogecoin (DOGE)</option>
                                    <option value='Ethereum (ETH)'>Ethereum (ETH)</option>
                                    <option value='USD Coin (USDC)'>USD Coin (USDC)</option>
                                    <option value='Solana (SOL)'>Solana (SOL)</option>
                                    <option value='Tether (USDT)'>Tether (USDT)</option>
                                    <option value='XRP (Ripple)'>XRP (Ripple)</option>
                                </select>
                            </div>
                            <div class='form-group'>
                                <label for='wa'>Wallet Address</label>
                                <input type='text' name='wa' id='wa' placeholder='enter wallet address' value='" . $walletAds . "' required>
                            </div>
                            
                            <div class='job-footer'>
                                <button name='crypto' type='submit' class='btn btn-secondary'>Save</button>
                            </div>
                        </form>
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
                        <form method='POST'>
                            <div class='form-group'>
                                <label>Cash App Details</label>
                            </div>

                            <div class='form-group'>
                                <label for='can'>Cash App Name</label>
                                <input type='text' name='can' id='can' placeholder='enter cash app name' value='" . $cashAppName . "' required>
                            </div>

                            <div class='form-group'>
                                <label for='cat'>Cash App Tag</label>
                                <input type='text' name='cat' id='cat' placeholder='enter cash app tag' value='" . $cashAppTag . "' required>
                            </div>
                            
                            <div class='job-footer'>
                                <button name='cashapp' type='submit' class='btn btn-secondary'>Save</button>
                            </div>
                        </form>
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
                        <form method='POST'>
                            <div class='form-group'>
                                <label>PayPal Details</label>
                            </div>

                            <div class='form-group'>
                                <label for='ppn'>PayPal Name</label>
                                <input type='text' name='ppn' id='ppn' placeholder='enter paypal name' value='" . $payPalName . "' required>
                            </div>

                            <div class='form-group'>
                                <label for='ppe'>PayPal Email</label>
                                <input type='email' name='ppe' id='ppe' placeholder='enter paypal email' value='" . $payPalEmail . "' required>
                            </div>
                            
                            <div class='job-footer'>
                                <button name='paypal' type='submit' class='btn btn-secondary'>Save</button>
                            </div>
                        </form>
                    ";
                }
            }else{
                echo "
                    <p>No payment method choosen</p>
                ";
            }
        
        ?>
    </div>
</section>