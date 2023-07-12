<section class="home">
    <div class="text">Dashboard</div>
    <div class="container-dashboard">
        
        <?php 
        
            $tblquery = "SELECT COUNT(id) AS totalUsers FROM users";
            $tblvalue = [];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>Users</h2>
                        <p>" . $select[0]['totalUsers'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";
        
        ?>

        <?php 
            
            $tblquery = "SELECT COUNT(id) AS totalUsers FROM not_verify WHERE verify = :verify";
            $tblvalue = [
                ':verify' => htmlspecialchars($secObj->encryptURLParam('0'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>New Users</h2>
                        <p>" . $select[0]['totalUsers'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>

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
            
            $tblquery = "SELECT COUNT(id) AS totalEnroll FROM enroll WHERE status = :status";
            $tblvalue = [
                ':status' => htmlspecialchars($secObj->encryptURLParam('1'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>Payments</h2>
                        <p>" . $select[0]['totalEnroll'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>

        <?php 
            
            $tblquery = "SELECT COUNT(id) AS totalEnroll FROM enroll WHERE status = :status";
            $tblvalue = [
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
        
            $tblquery = "SELECT COUNT(id) AS totalUsers FROM users WHERE status = :status";
            $tblvalue = [
                ':status' => htmlspecialchars($secObj->encryptURLParam('1'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>Active</h2>
                        <p>" . $select[0]['totalUsers'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>

        <?php 
            
            $tblquery = "SELECT COUNT(id) AS totalUsers FROM users WHERE status = :status";
            $tblvalue = [
                ':status' => htmlspecialchars($secObj->encryptURLParam('0'))
            ];
            $select = $dbObj->tbl_select($tblquery, $tblvalue);
            echo "
                <div class='box'>
                    <div>
                        <h2>Suspend</h2>
                        <p>" . $select[0]['totalUsers'] . "</p>
                    </div>
                    <div>
                        <i class='bx bx-log-out'></i>
                    </div>
                </div>
            ";

        ?>
        
    </div>
</section>