<?php $title = 'Home'?>
<?php include_once('inc/head.inc')?>

<?php
    if(!isset($_SESSION['username']))
    {
        $_SESSION['err'] = "An error has occurred!";

        // Redirect to signin if not signed in
        header("Location:signin.php?");
        exit(0);
    }
?>

<div class="side-bar"></div>
<div class="main-section">
<?php

    require 'inc/db_connect.inc';
    $result = $conn->query("SELECT * FROM accounts");

    $userData;

    while($row = $result->fetch_assoc())
    {
        if($_SESSION['username'] == $row['username'])
        {
            $userData = $row;
        }
    }
?>

<?php
    echo "<img src=profilepictures/" . $userData['profilepicture'] . " alt=" . ($userData['username'] . "_profile_picture") . ">";;
    echo "<h1>" . $userData['username'] . "</h1><br>";
?>

<form action="profilepicture_processing.php" method="post" enctype="multipart/form-data">
    <label>Upload new profile picture: </label>
    <input type="file" name="image" required><label>max image size: 1000px</label><br>
    <input type="submit" value="Change profile picture"><br><br>
</form>

<form action="editprofile_processing.php" method="post" enctype="multipart/form-data">
    <label>Edit your welcome messages (max: 80 characters):<br></label>
    <textarea name="welcomemessage" maxlength="80" required><?php echo $userData['welcomemessage']; ?></textarea><br><br>
    
    <label>Edit your about (max: 500 characters):<br></label>
    <textarea name="about" maxlength="500" required><?php echo $userData['about']; ?></textarea><br><br>

    <input type="submit" value="Confirm changes"><br><br>
</form>
</div>

<?php include_once('inc/footer.inc')?>