<?php
    include 'header.php';
if(isset($_POST['submit'])) {
    $name = $_POST["userFullName"];
    $username = $_POST["userName"];
    $password = $_POST["userPassword"];
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
    function getUsername(){
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
        (userFullName , userName , userPassword)
    VALUES
        (?, ?, ?);";
    }
    function sqlSelectQuery() {
        return "SELECT * FROM users WHERE userName = :user;";
    }
    function inValidUsername($username) {
        $result;
        $regex = "/a-zA-Z0-9*$/";
        if (!preg_match($regex, $username)) {
            header("Location: signup.php?error=invalidUsername");
            die;
        }
        else{
            $result = false;
        }
    }
    function checkUsername($pdo, $user) {
        $sql = "SELECT * FROM users WHERE userName = '$user';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return !!$stmt->fetch(PDO::FETCH_ASSOC);
    }
    function insertData() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            try {
                $pdo = getPDO();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $user = getValue('userName');
                $exists = checkUsername($pdo, $user);
                if($exists) {
                    header("Location: signup.php?error=usernameExists");
                    die();
                }
                else{ 
                    $hashedPassword = password_hash(getValue('userPassword'), PASSWORD_BCRYPT);
                    $params = [getValue('userFullName'), getValue('userName'), $hashedPassword];
                    $pdoStatement = $pdo->prepare(sqlInsertQuery());
                    $pdoStatement->execute($params);
                    session_start();
                    $_SESSION["userName"] = $username;
                    header("Location: login.php?error=signedUp");
                }
                $pdo = null;
            } catch(PDOException $excep) {
                    echo $excep->getMessage();
            }
        }
    }
}
else {
    header("Location: signup.php?error=signInFirst");
    die();
}
?>
<?php echo insertData(); ?>
<?php
    include 'footer.php';
?> 

