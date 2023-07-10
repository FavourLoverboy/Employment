<section class="home">
    <div class="text">Job Details</div>
    <?php
        if(isset($_POST['delete'])){
            extract($_POST);
            $tblquery = "UPDATE jobs SET status = :status WHERE id = :id";
            $tblvalue = [
                ':status' => htmlspecialchars($secObj->encryptURLParam('2')),
                ':id' => $_SESSION['job_id']
            ];
            $update = $dbObj->tbl_update($tblquery, $tblvalue);
            if($update){
                echo "<script>  window.location='a/job/delete' </script>";
            }
        }

        if(isset($_POST['terminate'])){
            extract($_POST);
            $tblquery = "UPDATE jobs SET status = :status WHERE id = :id";
            $tblvalue = [
                ':status' => htmlspecialchars($secObj->encryptURLParam('0')),
                ':id' => $_SESSION['job_id']
            ];
            $update = $dbObj->tbl_update($tblquery, $tblvalue);
            if($update){
                echo "<script>  window.location='a/job/terminate' </script>";
            }
        }
    ?>
    <div class="job-container">
        <form method="POST">
            <div class="job-details">
                <p><label>Job Title:</label> <?php echo $_SESSION['job_name']; ?></p>
                <p><label>Enrolled Users:</label> <?php echo $_SESSION['job_users']; ?></p>
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
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#terminate">Terminate</button>
            </div>
        </form>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST">
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Caution</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <div class='job-description'>
                            <p class='text-justify'><b>Warning:</b> Are you sure you want to delelte this job?</p>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                        <button name='delete' type='submit' class='btn btn-primary'>Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="terminate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST">
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Caution</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <div class='job-description'>
                            <p class='text-justify'><b>Warning:</b> Are you sure you want to TERMINATE this job?</p>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                        <button name='terminate' type='submit' class='btn btn-primary'>Terminate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>