<section class="home">
    <div class="text">Job Details</div>
    <?php
    
        if(isset($_POST['enroll'])){

            echo $_SESSION['job_id'];
            echo 'boy';
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
                            <label for="des">Description</label>
                            <textarea id="des" name="des" rows="4" placeholder="enter job description" required><?php echo $des; ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button name='enroll' type="submit" class="btn btn-primary">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>