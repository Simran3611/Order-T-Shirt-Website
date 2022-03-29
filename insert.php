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

    function sqlInsertQuery() {
        return "INSERT INTO users
        (userFullName, userName, userPassword)
    VALUES
        (?, ?, ?);";
    }
    function checkUsername($pdo, $user) {
        $sql = "SELECT * FROM users WHERE userName = '$user';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return !!$stmt->fetch(PDO::FETCH_ASSOC);
    }
    function insertData() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $pdo = getPDO();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $params = [getValue('userFullName'), getValue('userName'), password_hash(getValue('userPassword'), PASSWORD_BCRYPT)];
                $user = getValue('userName');
                $exists = checkUsername($pdo, $user);
                if(!$exists) {
                    $pdoStatement = $pdo->prepare(sqlInsertQuery());
                    $pdoStatement->execute($params);
                    $id = $pdo->lastInsertId();
                    echo "<br>Inserted record with id " . $id;
                }
                else {
                    echo "<p class = 'w3-center w3-red'>Username taken</p>";
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
            <header class="w3-container w3-center w3-black">
                   <h2>Insert</h2>
               </header>
            <p> You can insert a new user into the database. </p>
            <p>You might be asked to insert again if the username has already been taken</p>
        <main class="w3-container">
            <div>
                <?php echo insertData(); ?>
            </div>

            <form action="<?php getPostback(); ?>" method="POST">
                <p>
                    <label>User's Fullname</label>
                    <input class="w3-input w3-border w3-light-gray" name="userFullName" required>
                </p>

                <p>
                    <label>Username</label>
                    <input class="w3-input w3-border w3-light-gray" name="userName" required>
                </p>

                <p>
                    <label>Password</label>
                    <input type="password" class="w3-input w3-border w3-light-gray" name="userPassword" required>
                </p>
                <p>
                    <button class="w3-button w3-green w3-block w3-round">Insert data</button>
                </p>
            </form>

        </main>
        <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "usernameTaken") {
                echo "<p class = 'w3-center w3-red'>Username taken</p>";
            }
        }
        ?>
           </section>
           
<?php
    include 'footer.php';
?>

