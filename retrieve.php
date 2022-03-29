<?php
session_start();
    include 'header.php';
?>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
if(isset($_SESSION["userName"])) {
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
    function buildTable($pdoStatement) {
        $count = 1;
        $table = "<table class = 'w3-table-all'>
        <caption class = 'w3-large'>Registered Users</caption>
        <thead>
        <th>User ID</th>
        <th>Name</th>
        <th>Username</th>
        </thead>
        <tbody>
        <tr>";
        foreach($pdoStatement as $row) {
            $table .= "<tr><td>$row[userId]</td> <td>$row[userFullName]</td> <td>$row[userName]</td></tr>";
            $count++;
        }
        $table .= "
        </tbody>
        </table>";
        return $table;
    }

    function sqlSelectQuery() {
        return "SELECT * FROM users";
    }

    function displayRecords() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $pdo = getPDO();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdoStatement = $pdo->prepare(sqlSelectQuery());
                $pdoStatement->execute();
                echo buildTable($pdoStatement);
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
               <header class="w3-container w3-center w3-black">
                   <h2>Retrieve</h2>
               </header>
               <p> You can retrieve all existing users in the database</p>
        <main class="w3-container">
            <div>
                <?php echo displayRecords(); ?>
            </div>

            <form action="<?php getPostback(); ?>" method="POST">
                <p>
                    <button class="w3-button w3-green w3-block w3-round">Retrieve data</button>
                </p>
            </form>
        </main>
           </section>
           
<?php
    include 'footer.php';
?>

