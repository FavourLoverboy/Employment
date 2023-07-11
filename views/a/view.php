<section class="home">
    <div class="text">admin Dashboard</div>
    <div class="wrapper-div">
        <?php

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
                </div>
                <div class='grid-container'>
                    <div class='profile-box'>
                        <h2>Personal Details</h2>
                        <p><b>Sex:</b> $_SESSION[cl_sex]</p>
                        <p><b>Date of Birth:</b> $_SESSION[cl_dob]</p>
                        <p><b>Marital Status:</b> $_SESSION[cl_ms]</p>
                        <p><b>SSN:</b> $_SESSION[cl_ssn]</p>
                        <p><b>Nationality:</b> $_SESSION[cl_nationality]</p>
                        <p><b>State of Origin:</b> $_SESSION[cl_soo]</p>
                    </div>
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
                </div>
                <div class='grid-container'>
                    <div class='profile-box'>
                        <h2>Referral Details</h2>
                        <p><b>Referral Name:</b> $_SESSION[cl_ref_name]</p>
                        <p><b>Referral Email:</b> $_SESSION[cl_ref_email]</p>
                        <p><b>Referral Number:</b> $_SESSION[cl_ref_number]</p>
                    </div>
                    <div class='profile-box'>
                        <h2><b>Skills</b></h2>
                        <p>$_SESSION[cl_skills]</p>
                    </div>
                    <div class='profile-box'>
                        <h2><b>Salary</b></h2>
                        <p>$_SESSION[cl_salary]</p>
                    </div>
                </div>
            ";
        
        ?>
    </div>
</section>