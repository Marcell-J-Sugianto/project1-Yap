<?php $title = 'Sign Up'?>
<?php include_once('inc/head.inc')?>

<div>
    <br>
    <h3>
        New User Registration
    </h3>
    <br>

    <form action="signup_processing.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <br><br>

        <label for="userpassword">Password</label>
        <input type="password" name="userpassword" required>
        <br><br>

        <input type="submit">
        <br><br>
    </form>

    <?php
        if(isset($_GET['failMessage']))
        {
            echo $_GET['failMessage'];
            echo "<br><br>";
        }
    ?>
</div>

<?php include_once('inc/footer.inc')?>