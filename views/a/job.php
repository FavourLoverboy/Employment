<section class="home">
    <?php 
        $title = $available = $slut = $amt = $pt = $des = "";
        if($_POST){
            extract($_POST);
            $tblquery = "INSERT INTO jobs VALUES(:id, :title, :ava, :slut, :amt, :payment, :des, :date, :status)";
            $tblvalue = [
                ':id' => NULL, 
                ':title' => htmlspecialchars($secObj->encryptURLParam(ucwords($title))),
                ':ava' => htmlspecialchars($secObj->encryptURLParam($available)), 
                ':slut' => htmlspecialchars($secObj->encryptURLParam(ucwords($slut))), 
                ':amt' => htmlspecialchars($secObj->encryptURLParam($amt)),
                ':payment' => htmlspecialchars($secObj->encryptURLParam($pt)),
                ':des' => htmlspecialchars($secObj->encryptURLParam($des)),
                ':date' => htmlspecialchars($secObj->encryptURLParam(date('Y-m-d'))),
                ':status' => htmlspecialchars($secObj->encryptURLParam('1'))
            ];
            $insert = $dbObj->tbl_insert($tblquery, $tblvalue);
            if($insert){
                echo "<script>  window.location='a/job/success' </script>";
            }
        }

    ?>
    <div id="dynamicContent">
        <div class="button-section">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add Job
            </button>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Job Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Job Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter job title" value="<?php echo $title; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="available">Availability and Preferences</label>
                                <select id="available" name="available" required>
                                    <?php
                                        if($available){
                                            echo "
                                                <option value='" . $available . "'>" . $available . "</option>
                                                <option value='Contract'>Contract</option>
                                                <option value='Full-time'>Full-time</option>
                                                <option value='Part-time'>Part-time</option>
                                                <option value='Remote'>Remote</option>
                                            ";
                                        }else{
                                            echo "
                                                <option value=''>Choose</option>
                                                <option value='Contract'>Contract</option>
                                                <option value='Full-time'>Full-time</option>
                                                <option value='Part-time'>Part-time</option>
                                                <option value='Remote'>Remote</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sluts">Sluts</label>
                                <input type="number" class="form-control" id="sluts" name="slut" placeholder="Enter slunt number" value="<?php echo $slut; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="amt">Amount</label>
                                <input type="number" class="form-control" id="amt" name="amt" placeholder="Enter amt" value="<?php echo $amt; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="pt">Payment Time</label>
                                <select id="pt" name="pt" required>
                                    <?php
                                        if($pt){
                                            echo "
                                                <option value='" . $pt . "'>" . $pt . "</option>
                                                <option value='Hourly'>Hourly</option>
                                                <option value='Daily'>Daily</option>
                                                <option value='Contract'>Contract</option>
                                                <option value='Weekly'>Weekly</option>
                                                <option value='Monthly'>Monthly</option>
                                            ";
                                        }else{
                                            echo "
                                                <option value=''>Choose</option>
                                                <option value='Hourly'>Hourly</option>
                                                <option value='Daily'>Daily</option>
                                                <option value='Contract'>Contract</option>
                                                <option value='Weekly'>Weekly</option>
                                                <option value='Monthly'>Monthly</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="des">Description</label>
                                <textarea id="des" name="des" rows="4" placeholder="enter job description" required><?php echo $des; ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button name='add' type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="table-section">
            <?php 
            
                if(isset($url[2]) AND $url[2] == 'success'){
                    echo "<p class='text-success'>Job have been added</p>";
                }
            
            ?>
            <table id="dataTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Users</th>
                        <th>Title</th>
                        <th>Sluts</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>view</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        $tblquery = "SELECT jobs.title, jobs.ava, jobs.slut, jobs.amt, jobs.payment, jobs.des, jobs.date, jobs.status, COUNT(enroll.job_id) AS user_count FROM jobs LEFT JOIN enroll ON jobs.id = enroll.job_id GROUP BY jobs.id, jobs.title, jobs.ava, jobs.slut, jobs.amt, jobs.payment, jobs.des";
                        $tblvalue = [];
                        $select = $dbObj->tbl_select($tblquery, $tblvalue);
                        if($select){
                            foreach($select as $data){
                                extract($data);
                                $title = $secObj->decryptURLParam($title);
                                $ava = $secObj->decryptURLParam($ava);
                                $slut = $secObj->decryptURLParam($slut);
                                $amt = $secObj->decryptURLParam($amt);
                                $payment = $secObj->decryptURLParam($payment);
                                $des = $secObj->decryptURLParam($des);
                                $date = $secObj->decryptURLParam($date);
                                $status = $secObj->decryptURLParam($status);
                                if($status == '1'){
                                    $status = 'active';
                                    $color = 'btn-success';
                                }else{
                                    $status = 'disable';
                                    $color = 'btn-danger';
                                }
                                echo "
                                    <tr>
                                        <td> " . $user_count . "</td>
                                        <td>$title</td>
                                        <td>$slut</td>
                                        <td>$$amt</td>
                                        <td>$payment</td>
                                        <td>$ava</td>
                                        <td>$date</td>
                                        <td>
                                            <span class='btn $color btn-sm'>$status</span>
                                        </td>
                                        <td>
                                            <form>
                                                <input type='submit' class='btn btn-info btn-sm' value='view'>
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