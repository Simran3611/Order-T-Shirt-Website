<?php
    session_start();
    // $_SESSION["userName"] = $_POST['userName'];
    if(!isset($_SESSION["userName"])) {
        //$username = $_POST["userName"];
        header("Location: admin.php?error=notInSession");
        exit();
    }
    // else {
    //     header("Location: admin.php?error=notInSession");
    //     exit();
    // }

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
             <a href = "admin.php"></a>
                <a href = "index.php" class="w3-bar-item w3-button w3-right">Home</a></li>
                <a href = "discover.php" class="w3-bar-item w3-button w3-right">About Us</a></li>
                <a href = "login.php" class="w3-bar-item w3-button w3-right">Log in</a></li>
                <a href = "admin.php" class="w3-bar-item w3-button w3-right">Admin Log in</a></li>
                <a href = "signup.php" class="w3-bar-item w3-button w3-right">Sign up</a></li>
                <?php 
                    if(isset($_SESSION["userName"])) {
                        $name = $_SESSION["userName"];
                        echo "<a href='logout.php'  class='w3-bar-item w3-button w3-left'>Log out</a>";
                        echo "<a href = 'retrieve.php' class='w3-bar-item w3-button w3-left'>Retrieve</a></li>";
                        echo "<a href = 'update.php' class='w3-bar-item w3-button w3-left'>Update</a></li>";
                        echo "<a href = 'insert.php' class='w3-bar-item w3-button w3-left'>Insert</a></li>";
                        echo "<a href = 'delete.php' class='w3-bar-item w3-button w3-left'>Delete</a></li>";
                        echo "<p>&nbsp;</p>";
                        echo "<p>&nbsp;</p>";
                        echo "Welcome " . $name ;
                        echo "<p>To retrieve data, go into the retrieve section<p>";
                        echo "<p>To update data, go into the update section<p>";
                        echo "<p>To insert data, go into the insert section<p>";
                        echo "<p>To delete data, go into the delete section<p>";
                    }
                    else {
                        echo "<a href='signup.php'>Sign up</a>";
                        echo "<a href='login.php'>Log in</a>";
                    }
                ?>
                
        </div>
    </nav>