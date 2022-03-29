
<?php
    include 'header.php';
?>
        <h2>Website</h2>
        <form action = "signupTest.php" class = "w3-center" method = "post">
            <h2>Sign Up</h2>
            <p><input type="text" class = "w3-center" name = "userFullName" placeholder="Full name" required></p>
            <p><input type="text" class = "w3-center"name = "userName" placeholder="Username" required></p>
            <p><input type="password" class = "w3-center"name = "userPassword" placeholder="Password" required></p>
            <button type="submit"class = "w3-center w3-green w3-round" name="submit">Register</button>
            </form>
    <?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "usernameExists") {
            echo "<p class = 'w3-center'>Username already taken. Try another one</p>";
        }
        if($_GET["error"] == "invalidUsername") {
            echo "<p class = 'w3-center>Choose a proper username</p>";
        }
        if($_GET["error"] == "signInFirst") {
            echo "<p class = 'w3-center>You must log in or sign up</p>";
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