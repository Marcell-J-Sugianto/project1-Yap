<?php include_once("inc/db_connect.inc")?>

<?php
$sql = "select * from accounts where username=? and userpassword=SHA(?)";
$username = $_POST['username'];
$userpassword = $_POST['userpassword'];

// Prevent injection and insert new data
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $userpassword);
$stmt->execute();

// Start session
$result = $stmt->get_result();
session_start();


if ($result->num_rows > 0)
{
    $_SESSION['username'] = $username;

    require 'inc/db_connect.inc';
    $result = $conn->query("SELECT * FROM accounts");

    while($row = $result->fetch_assoc())
    {
        if($_SESSION['username'] == $row['username'])
        {
            $_SESSION['userid'] = $row['userid'];

            break;
        }
    }

    $conn->close();
    
    // Redirect to home
    header("Location:index.php");
    exit(0);
}
else
{
    $_SESSION['err'] = "An error has occurred!";

    // Redirect back to sign in if fail
    header("Location:signin.php?failMessage=Sign in failed!");
    exit(0);
}
?>