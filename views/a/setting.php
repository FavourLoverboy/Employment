<section class="home">
    <div class="text">Setting</div>
    <?php
        $pym_mth = '';

        $tblquery = "SELECT content FROM setting WHERE type = :type";
        $tblvalue = [
            ':type' => $secObj->encryptURLParam('pm'),
        ];
        $select = $dbObj->tbl_select($tblquery, $tblvalue);
        if($select){
            $pym_mth = $secObj->decryptURLParam($select[0]['content']);
        }

        if(isset($_POST['pm_btn'])){
            extract($_POST);
            $tblquery = "DELETE FROM setting WHERE type = :type";
            $tblvalue = [
                ':type' => $secObj->encryptURLParam('pm'),
            ];
            $delete = $dbObj->tbl_delete($tblquery, $tblvalue);
            if($delete){
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
        }
    
    ?>

    <?php 
            
        if(isset($url[2]) AND $url[2] == 'success'){
            echo "<p class='text-success'>Updated</p>";
        }
    
    ?>
    <div class="job-container">
        <?php
        
            if(isset($_POST['pm'])){
                extract($_POST);
                
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
                    <option value='Crypto Currency'>Crypto Currency</option>
                </select>
            </div>
            <div class="job-footer">
                <button name="pm_btn" type="submit" class="btn btn-secondary">Save</button>
            </div>
        </form>
    </div>
</section>