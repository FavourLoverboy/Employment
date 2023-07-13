<section class="home">
    <div class="text">admin Dashboard</div>
    <div class="wrapper-div">
        <?php
            if(isset($_POST['delete'])){
                extract($_POST);

                $tblquery = "DELETE FROM users WHERE id = :id";
                $tblvalue = [
                    ':id' => $_SESSION['cl_id']
                ];
                $delete = $dbObj->tbl_delete($tblquery, $tblvalue);
                if($delete){
                    $tblquery = "DELETE FROM not_verify WHERE email = :email";
                    $tblvalue = [
                        ':email' => $secObj->encryptURLParam($_SESSION['cl_email'])
                    ];
                    $delete = $dbObj->tbl_delete($tblquery, $tblvalue);
                    echo "<script>  window.location='a/clients' </script>";
                }
            }
            echo "
                <div class='grid-container'>
                    <div class='profile-box'>
                        <img class='profile-image' src='$_SESSION[cl_img]' alt='User Image'>
                    </div>
                    <div class='profile-box'>
                        <h2>$_SESSION[cl_name]</h2>
                        <p><b>Email:</b> $_SESSION[cl_email]</p>
                        <p><b>Password:</b> $_SESSION[cl_password]</p>
                        <p><b>Phone Number:</b> $_SESSION[cl_pn]</p>
                    </div>
                    <div class='profile-box'>
                        <h2>Personal Details</h2>
                        <p><b>Sex:</b> $_SESSION[cl_sex]</p>
                        <p><b>Date of Birth:</b> $_SESSION[cl_dob]</p>
                        <p><b>Marital Status:</b> $_SESSION[cl_ms]</p>
                        <p><b>SSN:</b> $_SESSION[cl_ssn]</p>
                        <p><b>Nationality:</b> $_SESSION[cl_nationality]</p>
                        <p><b>State of Origin:</b> $_SESSION[cl_soo]</p>
                    </div>
                </div>
                <div class='grid-container'>
                    <div class='profile-box'>
                        <h2>Location</h2>
                        <p><b>Country:</b> $_SESSION[cl_country]</p>
                        <p><b>State:</b> $_SESSION[cl_state]</p>
                        <p><b>City:</b> $_SESSION[cl_cty]</p>
                        <p><b>Address:</b> $_SESSION[cl_ads]</p>
                    </div>
                    <div class='profile-box'>
                        <h2>Additional Information</h2>
                        <p><b>Bio:</b> $_SESSION[cl_bio]</p>
                        <p><b>Last Seen:</b> $_SESSION[cl_last_seen]</p>
                        <p><b>Update Date:</b> $_SESSION[cl_update_date]</p>
                        <p><b>Availability:</b> $_SESSION[cl_available]</p>
                        <p><b>Date of Registration:</b> January 1, 2023</p>
                        <p><b>Status:</b> $_SESSION[cl_status]</p>
                    </div>
                    <div class='profile-box'>
                        <h2>Referral Details</h2>
                        <p><b>Referral Name:</b> $_SESSION[cl_ref_name]</p>
                        <p><b>Referral Email:</b> $_SESSION[cl_ref_email]</p>
                        <p><b>Referral Number:</b> $_SESSION[cl_ref_number]</p>
                    </div>
                </div>
                <div class='grid-container'>
                    <div class='profile-box'>
                        <h2><b>Skills</b></h2>
                        <p>$_SESSION[cl_skills]</p>
                    </div>
                    <div class='profile-box'>
                        <h2><b>Salary</b></h2>
                        <p>$_SESSION[cl_salary]</p>
                    </div>
                    <div class='profile-box'>
                        <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete'>Delete</button>
                    </div>
                </div>
            ";
        
        ?>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <p class='text-justify'><b>Warning:</b> Are you sure you want to DELETE this User?</p>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-success' data-dismiss='modal'>Close</button>
                        <button name='delete' type='submit' class='btn btn-danger'>Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>