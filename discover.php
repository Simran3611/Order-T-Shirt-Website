<?php
session_start();
  function discover() {
      if(isset($_SESSION["userName"])) {
        return "<div class='about-section'>
          <h1 class = 'w3-black'>About Us Page</h1>
          <p>Some text about who we are and what we do.</p>
          <p>We are pleased to have you visit our website. Meet the creators of this website and this little clothing Company</p>
          <p>We are a little clothing company selling handmade shirts. Our shirts come in various colors</p>
        </div>
        
        <h2 style='text-align:center' class = 'w3-gray'>Our Team</h2>
              <img src='person1.jpg' class = 'w3-center' alt='Jane' style='width:25%>
              <div class='container'>
                <h2 class = 'w3-center' >Jane Brown</h2>
                <p class='w3-title w3-center' >CEO & Founder</p>
                <p class = 'w3-center' >This is the CEO of this website</p>
                <p class = 'w3-center' >ceo@example.com</p>
                <p class = 'w3-center ><button class='button'>Contact</button></p>
              </div>  
              </div>
              <img src='person1.jpg' class = 'w3-center'  alt='Mike' style='width:25%'>
              <div class='container'>
                <h2 class = 'w3-center' >Mike Jade</h2>
                <p class='w3-title w3-center'>Manager</p>
                <p class = 'w3-center' >This is the manager of this website</p>
                <p class = 'w3-center' >manager@example.com</p>
                <p class = 'w3-center' ><button class='button'>Contact</button></p>
              </div>
            </div>
          </div>
              <img src='person1.jpg' class = 'w3-center'  alt='John' style='width:25%'>
              <div class='container'>
                <h2 class = 'w3-center' >John Smith</h2>
                <p class='w3-title w3-center'>Designer</p>
                <p class = 'w3-center' > This is the designer of this website</p>
                <p class = 'w3-center' >designer@example.com</p>
                <p class = 'w3-center' ><button class='button'>Contact</button></p>
              </div>
            </div>
          </div>
            </div>";
      }
      else {
        header("Location: login.php?error=loginFirst");
        exit();
      }
  }
?>
<head>
         <title>Website</title>
         <meta charset="utf-8">
         <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     </head>
     <nav>
         <div class = "wrapper">
             <a href = "index.php"></a>
                <a href = "index.php" class="w3-bar-item w3-button w3-right">Home</a></li>
                <a href = "discover.php" class="w3-bar-item w3-button w3-right">About Us</a></li>
                <a href = "login.php" class="w3-bar-item w3-button w3-right">Log in</a></li>
                <a href = "admin.php" class="w3-bar-item w3-button w3-right">Admin Log in</a></li>
                <a href = "signup.php" class="w3-bar-item w3-button w3-right">Sign up</a></li>
        </div>
    </nav>
    <?php 
      if(isset($_SESSION["userName"])){
        $name = $_SESSION["userName"];
        echo "<a href= 'logout.php'  class='w3-bar-item w3-button w3-left'>Log out</a>";
        if($name == "admin") {
          echo "<a href='profile.php' class='w3-bar-item w3-button w3-left'>Profile page</a>";
          echo "<a href = 'retrieve.php' class='w3-bar-item w3-button w3-left'>Retrieve</a></li>";
          echo "<a href = 'update.php' class='w3-bar-item w3-button w3-left'>Update</a></li>";
          echo "<a href = 'insert.php' class='w3-bar-item w3-button w3-left'>Insert</a></li>";
          echo "<a href = 'delete.php' class='w3-bar-item w3-button w3-left'>Delete</a></li>";
        }
        echo "<p>&nbsp;</p>";
        echo "<p>&nbsp;</p>";
        echo "Welcome " . $name ;
      }
      else {
        echo "<a href='signup.php'>Sign up</a>";
        echo "<a href='login.php'>Log in</a>";
      }
    ?>
<?php echo discover(); ?>