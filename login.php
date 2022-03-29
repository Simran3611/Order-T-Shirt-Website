<?php
    include 'header.php';
?>
    <p><section class="signup-form w3-center"></p>
        <h2>Website</h2>
        <form action = "loginTest.php" class = "w3-center" method = "post">
        <h2>Log in</h2>
            <p><input type="text" class = "w3-center"name = "userName" placeholder="Username" required></p>
            <p><input type="password" class = "w3-center"name = "userPassword" placeholder="Password" required></p>
            <button type="submit"class = "w3-center w3-green w3-round" name="submit">Log In</button>
        </form>
<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "wrongUser") {
            echo "<p class = 'w3-center'>Incorrect username</p>";
        }
        if($_GET["error"] == "wrongPass") {
            echo "<p class = 'w3-center'>Incorrect password</p>";
        }
        if($_GET["error"] == "signedUp") {
            echo "<p class = 'w3-center>You have signed up!</p>";
        }
    }
?>
    </section>
<?php
    include 'footer.php';
?>

