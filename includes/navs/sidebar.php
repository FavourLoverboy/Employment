<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="assets/images/1.png" alt="logo">
            </span>

            <div class="text header-text">
                <span class="name">Nack</span>
                <span class="profrssion">
                    <?php 
                    
                        $ema = $secObj->decryptURLParam($_SESSION['email']);
                        if(strlen($ema) > 16){
                            echo substr($ema, 0, 16) . "...";
                        }else{
                            echo $ema;
                        }
                    
                    ?>
                </span>
            </div>
        </div>

        <i class="bx bx-chevron-right toggle"></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <li class="search-box">
                <i class="bx bx-search icon"></i>
                <input type="search" placeholder="Search...">
            </li>
            <?php
                if($_SESSION['level'] == 'admin'){
                    include('levels/admin.php');
                }else if($_SESSION['level'] == 'referral'){
                    include('levels/referral.php');
                }else if($_SESSION['level'] == 'user'){
                    include('levels/user.php');
                }
            ?>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="logout">
                    <i class="bx bx-log-out icon"></i>
                    <span class="text nav-text">Logout</span>
                </a>
            </li>
            <li class="mode">
                <div class="moon-sun">
                    <i class="bx bx-moon icon moon"></i>
                    <i class="bx bx-sun icon sun"></i>
                </div>
                <span class="mode-text text">Dark Mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>