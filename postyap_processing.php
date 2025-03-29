<?php include_once('inc/head.inc')?>

<?php
$id = $_SESSION['userid'];
$yap = $_POST['yappost'];
$now = strval(date("Y-m-d H:i:s"));
$defaultlikecount = 0;

// Prevent injection and insert new data
$sql = "insert into posts (userid, content, likecount, timecreated) values (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Add to database
$stmt->bind_param("isis", $id, $yap, $defaultlikecount, $now);
$stmt->execute();

// Start session
session_start();

if ($stmt->affected_rows > 0)
{
    $conn->close();
    
    header("Location:useryap.php?userid=" . $_SESSION['userid']);
    exit(0);
}
else
{
    // If fail for any other reason
    $_SESSION['err'] = "An error has occurred!";

    header("Location:register.php?failMessage=Yap failed!");
    exit(0);
}
?>