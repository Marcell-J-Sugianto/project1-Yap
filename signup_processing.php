<?php $title = 'Sign Up'?>
<?php include_once("inc/db_connect.inc")?>

<?php
$username = $_POST['username'];
$userpassword = $_POST['userpassword'];

$profilepicture = "default.png";
$welcomemessage = "Hey, I'm $username. Welcome to my Yap page!";

// Prevent injection and insert new data
$sql = "insert into accounts (username, userpassword, profilepicture, welcomemessage) values (?, SHA(?), ?, ?)";
$stmt = $conn->prepare($sql);

// Prevent duplicate usernames from being used
$usernameExists = false;
$result = $conn->query("SELECT * FROM accounts");

while($row = $result->fetch_assoc())
{
    if(strcmp($row['username'], $username) == 0)
    {
        $usernameExists = true;
    }
}

if(!$usernameExists)
{
    // Add to database
    $stmt->bind_param("ssss", $username, $userpassword, $profilepicture, $welcomemessage);
    $stmt->execute();
}
else
{
    $_SESSION['err'] = "An error has occurred!";

    // If unavailabe username
    header("Location:signup.php?failMessage=Username unavailable!");
    exit(0);
}

// Start session
session_start();

if ($stmt->affected_rows > 0)
{
    $_SESSION['usrmsg'] = "You have successfully signed up!";

    $conn->close();
    
    header("Location:signin.php");
    exit(0);
}
else
{
    // If fail for any other reason
    $_SESSION['err'] = "An error has occurred!";

    header("Location:register.php?failMessage=Sign up failed!");
    exit(0);
}
?>