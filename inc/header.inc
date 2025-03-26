<header>
    <nav>
        <div class="nav-logo"></div>

        <div class="nav-search-wrapper">
            <div class="nav-search-bar"></div>
            
            <div class="nav-search-icon"></div>
            <div class="nav-subscribed-icon"></div>
        </div>

        <div class="nav-button-wrapper">
        <?php
            if(isset($_SESSION['username']))
            {
                echo "<div class='user-profile-nav'></div>";
            }
            else
            {
                echo "<div class='nav-login'></div>";
                echo "<div class='nav-signup'></div>";
            }
        ?>
        </div>
    </nav>
</header>