<?php include_once('inc/head.inc') ?>

<?php
    if(empty($_FILES['image']))
    {
        $_SESSION['err'] = "An error has occurred!";

        // Redirect back to login if fail
        header("Location:editprofile.php?failMessage=Image not found!");
        exit(0);
    }

    if($_FILES['image']['size'] == 0)
    {
        $_SESSION['err'] = "An error has occurred!";

        // Redirect back to login if fail
        header("Location:editprofile.php?failMessage=Image upload failed!");
        exit(0);
    }

    $tmpName = $_FILES['image']['tmp_name'];
    list($width, $height) = getimagesize($tmpName);

    if($width > 1000 || $height > 1000)
    {
        $_SESSION['err'] = "An error has occurred!";

        // Redirect back to editing profile if fail
        header("Location:editprofile.php?failMessage=Image dimensions too big!");
        exit(0);
    }

    if($width != $height)
    {
        $_SESSION['err'] = "An error has occurred!";

        // Redirect back to editing profile if fail
        header("Location:editprofile.php?failMessage=Image must be a square!");
        exit(0);
    }

    require 'inc/db_connect.inc';
    $result = $conn->query("SELECT * FROM accounts");
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $newname = $_SESSION['username'] . "_pfp." . $ext;
    $oldname;

    while($row = $result->fetch_assoc())
    {
        if($_SESSION['username'] == $row['username'])
        {
            $oldname = $row['profilepicture'];

            if($oldname == "default.png" || $newname != $oldname)
            {
                // Prevent injection and insert new data
                $sql = "UPDATE accounts SET profilepicture=? WHERE username = '" . $_SESSION['username'] . "'";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $newname);
                $stmt->execute();
            }
            else if($newname == $oldname)
            {
                // if extention is the same, only change the picture
                //unlink("profilepictures/" . $oldname);

                $tmpSaveName = "profilepictures/temp_" . $newname;
                move_uploaded_file($tmpName, $tmpSaveName);

                rename($tmpSaveName, "profilepictures/" . $newname);

                // Redirect to editprofile
                header("Location:editprofile.php");
                exit(0);
            }
        }
    }

    if ($stmt->affected_rows > 0)
    {
        if($oldname != "default.png")
        {
            // delete old profile picture if its not default
            unlink("profilepictures/" . $oldname);
        }

        move_uploaded_file($tmpName, "profilepictures/" . $newname);
    }

    // Redirect to editprofile
    header("Location:editprofile.php");
    exit(0);
?>