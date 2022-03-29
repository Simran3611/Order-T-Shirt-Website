<?php
    include 'header.php';
if(isset($_POST['submit'])) {
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
                echo $user;
                $exists = checkUsername($pdo, $user);
                if(getValue('userName') != "admin") {
                    header("Location: admin.php?error=wrongUser");
                    exit();
                }
                if(getValue('userPassword') == "admin") {
                    session_start();
                    $_SESSION["userName"] = getValue('userName');
                    header("Location: profile.php");
                    exit();
                }
                 else {
                    header("Location: admin.php?error=wrongPass");
                    exit();
                 }
                $pdo = null;
            } catch(PDOException $excep) {
                    echo $excep->getMessage();
            }
        }
    }
}
else {
    header("Location: login.php?error=logInFirst");
    exit();
}
?>
<?php echo insertData(); ?>
<?php
    include 'footer.php';
?> 

