<?php $title = 'Home'?>
<?php include_once('inc/head.inc')?>

<?php
    if(!isset($_GET['username']))
    {
        $_SESSION['err'] = "An error has occurred!";

        // Redirect back to index if username to view is not specified
        header("Location:index.php?failMessage=User unspecified!");
        exit(0);
    }
?>

<div class="side-bar"></div>
<div class="main-section">
<?php

    require 'inc/db_connect.inc';
    $result = $conn->query("SELECT * FROM accounts");

    $userFound = false;

    while($row = $result->fetch_assoc())
    {
        if($_GET['username'] == $row['username'])
        {
            echo "<img src=profilepictures/" . $row['profilepicture'] . " alt=" . ($row['username'] . "_profile_picture") . ">";
            echo "<h1>" . $row['username'] . "</h1>";

            echo "<p>";
                echo "Welcome message: " . $row['welcomemessage'] . "<br>";
                echo "About: <br>" . $row['about'];
            echo "</p>";

            $userFound = true;

            break;
        }
    }

    if(!$userFound)
    {
        $_SESSION['err'] = "An error has occurred!";

        // Redirect back to index if username is not found
        header("Location:index.php?failMessage=User not found!");
        exit(0);
    }

    if($_GET['username'] == $_SESSION['username'])
    {
        echo "<br><br><a href='editprofile.php'>Edit your profile</a>";
    }
?>
</div>

<?php include_once('inc/footer.inc')?>