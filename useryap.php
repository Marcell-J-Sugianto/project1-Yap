<?php $title = 'Home'?>
<?php include_once('inc/head.inc')?>

<?php
    if(!isset($_GET['userid']) && !isset($_GET['failMessage']))
    {
        $_SESSION['err'] = "An error has occurred!";

        // reload with errorMessage if no userid specified
        header("Location:useryap.php?failMessage=User unspecified!");
        exit(0);
    }
?>

<div class="side-bar"></div>
<div class="main-section">
    <?php
        if(isset($_GET['failMessage']) && $_GET['failMessage'] == "User unspecified!")
        {
            $_SESSION['err'] = "An error has occurred!";

            echo "no user specified";
            exit(0);
        }

        require 'inc/db_connect.inc';
        $result = $conn->query("SELECT * FROM accounts");

        $userFound = false;
        $userdata;

        while($row = $result->fetch_assoc())
        {
            if($_GET['userid'] == $row['userid'])
            {
                $userdata = $row;
                $userFound = true;

                break;
            }
        }

        if(!$userFound)
        {
            $_SESSION['err'] = "An error has occurred!";

            echo "user not found";
            exit(0);
        }

        echo "<div class='banner'>";
            echo $userdata['welcomemessage'];
        echo "</div><br>";

        if(isset($_SESSION['username']) && $userdata['username'] == $_SESSION['username'])
        {
            echo $_SESSION['userid'];
            echo "<form action='postyap_processing.php' method='post' enctype='multipart/form-data'>";
                echo '<label for="yappost">What\'s on your mind today ' . $userdata['username'] . '?</label><br>';
                echo '<textarea name="yappost" maxlength="2000" placeholder="Yap here..." required></textarea><br>';
                echo '<input type="submit" value="Yap!">';
            echo "</form><br>";
        }
    ?>
</div>

<?php include_once('inc/footer.inc')?>