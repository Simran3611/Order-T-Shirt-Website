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
    function sqlJoinQuery() {
        return "SELECT *
        FROM shirts, userShirtOrder
        WHERE shirts.shirtID=userShirtOrder.shirtID;";
    }
    function insertOrder($id) {
        return "INSERT INTO userShirtOrder VALUES ($id)";
    }
    function buildTable($pdoStatement) {
        $table = "<table class = 'w3-table-all'>
        <caption class = 'w3-large'>Your Order</caption>
        <thead>
        <th>Shirt ID</th>
        <th>Shirt Name</th>
        <th>Price</th>
        </thead>
        <tbody>
        <tr>";
        foreach($pdoStatement as $row) {
            $table .= "<tr><td>$row[shirtID]</td> <td>$row[shirtName]</td> <td>$row[price]</td></tr>";
         }
         $table .= "
        </tbody>
        </table>";
        return $table;
    }
    function deleteValues($id) {
        return "DELETE FROM userShirtOrder WHERE shirtID = $id;";
    }
    function insertData() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            try {
                $pdo = getPDO();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if(isset($_POST['blackShirt'])) {
                    $pdoStatement = $pdo->query(insertOrder(1));
                }
                if(isset($_POST['redShirt'])) {
                    $pdoStatement = $pdo->query(insertOrder(2));
                }
                if(isset($_POST['whiteShirt'])) {
                    $pdoStatement = $pdo->query(insertOrder(3));
                }
                if(isset($_POST['blueShirt'])) {
                    $pdoStatement = $pdo->query(insertOrder(4));
                }
                if(isset($_POST['greenShirt'])) {
                    $pdoStatement = $pdo->query(insertOrder(5));
                }
                $pdoStatement = $pdo->query(sqlJoinQuery());
                echo buildTable($pdoStatement);
                if(isset($_POST['blackShirt'])) {
                    $pdoStatement = $pdo->query(deleteValues(1));
                }
                if(isset($_POST['redShirt'])) {
                    $pdoStatement = $pdo->query(deleteValues(2));
                }
                if(isset($_POST['whiteShirt'])) {
                    $pdoStatement = $pdo->query(deleteValues(3));
                }
                if(isset($_POST['blueShirt'])) {
                    $pdoStatement = $pdo->query(deleteValues(4));
                }
                if(isset($_POST['greenShirt'])) {
                    $pdoStatement = $pdo->query(deleteValues(5));
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
<form action = "confirmOrder.php" class = "w3-left" method = "post">
    <p><button type="submit" class = "w3-green w3-round" name="submit">Confirm Order</button></p>
</form>
<?php
    include 'footer.php';
?> 

