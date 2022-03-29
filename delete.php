<?php
session_start();
    include 'header.php';
?>
<?php
    // Turn on error reporting.
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

if(isset($_SESSION["userName"])) {
    // Type your code here
    $year = date('Y');
    function getValue($key) {
        if (!isset($_POST[$key])) {
            $data = "";
        }
        else {
            $data = trim($_POST[$key]);
            $data = htmlspecialchars($data);
         }
        return $data;
    }
    function getPostback() {
        return (getValue($_SERVER['PHP_SELF']));
    }
    function getDSN() {
        $dsn = "mysql:host=localhost;port=8889;dbname=project";
        return $dsn;
    }
    function getUsername() {
        return "root";
    }
    function getPassword() {
        return "root";
    }
    function getPDO() {
            $pdo = new PDO(getDSN(), getUsername(), getPassword());
            return $pdo;
    }
    function sqlDeleteQuery() {
        return "DELETE FROM users
        WHERE userId=?";
    }
    function deleteRecords() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $pdo = getPDO();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM users WHERE userId = ?";
                $statement = $pdo->prepare($sql);
                $statement->execute([getValue('userId')]);
                echo "<p>Deleted " . $statement->rowCount() . " rows.</p>";
                $id = $statement->rowCount();
                if($id == 0) {
                    echo "<p class = 'w3-center w3-red'>No user exists with the entered ID</p>";
                }
                $pdo = null;
            } catch(PDOException $excep) {
                echo $excep->getMessage();
            }
        }
    }
}
else {
    header("Location: admin.php?error=logInFirst");
    exit();
}    
?>
    <body>
           <p><h1 class = "w3-center">Website</h1></p>
           <?php 
                    if(isset($_SESSION["userName"])) {
                        $name = $_SESSION["userName"];
                        echo "<a href = 'retrieve.php' class='w3-bar-item w3-button w3-left'>Retrieve</a></li>";
                        echo "<a href = 'update.php' class='w3-bar-item w3-button w3-left'>Update</a></li>";
                        echo "<a href = 'insert.php' class='w3-bar-item w3-button w3-left'>Insert</a></li>";
                        echo "<a href = 'delete.php' class='w3-bar-item w3-button w3-left'>Delete</a></li>";
                    }
                    else {
                        echo "<a href='signup.php'>Sign up</a>";
                        echo "<a href='login.php'>Log in</a>";
                    }
            ?>
           <section class="w3-panel">
               <?php 
                    if(isset($_SESSION["userName"])) {
                        echo "<p>Hello there " . $_SESSION["userName"] . "</p>";
                    }
                ?>
               <!-- <header class="w3-container w3-center w3-khaki">
                   <h2>The Introduction</h2>
               </header>

               <div class="w3-cell-row">
            
                <aside class = "w3-container w3-black w3-cell">
                    <h2>Fun Stuff</h2>
                </aside>
                <aside class = "w3-container w3-gray w3-cell">
                    <h2>Serious Stuff</h2>
                </aside>
                <aside class = "w3-container w3-black w3-cell">
                    <h2>Boring Stuff</h2>
                </aside>
                <aside class = "w3-container w3-gray w3-cell">
                    <h2>Exicting Stuff</h2>
                </aside>
            </div> -->
            <header class="w3-container w3-center w3-black">
                   <h2>Delete</h2>
               </header>
            <p>You can delete a user from the database. </p>
            <p>You will be informed if the user ID does not exists within the database and then asked to enter an existing ID</p>

        <main class="w3-panel">
            <div>
                <?php deleteRecords(); ?>
            </div>

            <form action="<?php getPostback(); ?>" method="POST">
                <p>
                    <label>Delete record for id: </label>
                    <input class="w3-input w3-border w3-light-gray" name="userId">
                </p>
                <p>
                    <button class="w3-button w3-green w3-block w3-round">Delete Record</button>
                </p>
            </form>
        </main>
           </section>
           
<?php
    include 'footer.php';
?>

