<?php include_once('inc/head.inc') ?>
<?php
    $welcomemessage = $_POST['welcomemessage'];
    $about = $_POST['about'];

    // Prevent injection and insert new data
    $sql = "UPDATE accounts SET welcomemessage=?, about=? WHERE username = '" . $_SESSION['username'] . "'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$welcomemessage, $about);
    $stmt->execute();

    // Redirect to gallery
    header("Location:editprofile.php");
    exit(0);
?>