<?php $title = 'Sign in'?>
<?php include_once('inc/head.inc') ?>

<div>
    <br>
    <h3>
        Login
    </h3>
    <br>

    <form action="signin_processing.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <br><br>

        <label for="userpassword">Password</label>
        <input type="password" name="userpassword" required>
        <br><br>

        <input type="submit" value="Sign in">
        <br><br>
    </form>

    Don't have and account? <a href="signup.php">sign up</a> today!

    <?php
        if(isset($_GET['failMessage']))
        {
            echo $_GET['failMessage'];
            echo "<br><br>";
        }
    ?>
</div>

<?php include('inc/footer.inc') ?>