<?php
    include 'header.php';
if(isset($_POST['submit'])) {
    echo"<p>&nbsp;</p>";
    echo"<p>&nbsp;</p>";
    echo "<p>&nbsp;Congrats! Your order has just been confirmed. Order more shirts if you like or feel free to log out</p>";
}
else {
    header("Location: login.php?error=logInFirst");
    exit();
}
?>
<form action = "index.php" class = "w3-left" method = "post">
    <p><button type="submit" class = "w3-green w3-round" name="submit">Return Home</button></p>
</form>
<?php
    include 'footer.php';
?> 

