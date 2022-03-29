<?php
    session_start();
?>
<!DOCTYPE html>
 <html>
     <head>
         <title>Website</title>
         <meta charset="utf-8">
         <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     </head>
     <nav>
         <div class = "wrapper">
             <a href = "signup.php"></a>
                <a href = "index.php" class="w3-bar-item w3-button w3-right">Home</a></li>
                <a href = "discover.php" class="w3-bar-item w3-button w3-right">About Us</a></li>

                <?php 
                    if(isset($_SESSION["userName"])) {
                        echo "<a href='logout.php'  class='w3-bar-item w3-button w3-left'>Log out</a>";
                    }
                ?>
                <a href = "login.php" class="w3-bar-item w3-button w3-right">Log in</a></li>
                <a href = "admin.php" class="w3-bar-item w3-button w3-right">Admin Log in</a></li>
                <a href = "signup.php" class="w3-bar-item w3-button w3-right">Sign up</a></li>
        </div>
    </nav>