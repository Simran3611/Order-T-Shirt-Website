<?php
    include 'header.php';
    session_start();
    function showHome() {
        if(isset($_SESSION["userName"])) {
            $user = $_SESSION["userName"];
            echo "Welcome $user";
            return "<form action = 'order.php' class = 'w3-left' method = 'post'>
            <h2 class = 'w3-container w3-black'>Order your shirts now!</h2>
                <label>Order your shirts now!</label>
                <p>
                    <input type='checkbox' class = 'w3-center' name='blackShirt' value='blackShirt'> Black Shirt &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type='checkbox' class = 'w3-center' name='redShirt' value='redShirt'> Red Shirt &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type='checkbox' class = 'w3-center' name='whiteShirt' value='whiteShirt'> White Shirt&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type='checkbox' class = 'w3-center' name='blueShirt' value='blueShirt'> Blue Shirt&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type='checkbox' class = 'w3-center' name='greenShirt' value='greenShirt'> Green Shirt&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </p>
                <p>
                    <img src='blackShirt.jpg' class = 'w3-center' alt='blackShirt' style='width:10%'>
                    <img src='redShirt.jpg' class = 'w3-center' alt='redShirt' style='width:10%'>
                    <img src='whiteShirt.jpg' class = 'w3-center' alt='whiteShirt' style='width:10%'>
                    <img src='blueShirt.jpg' class = 'w3-center' alt='blueShirt' style='width:10%'>
                    <img src='greenShirt.jpg' class = 'w3-center' alt='greenShirt' style='width:10%'>
                </p>
                <p><button type='submi' class ='w3-green w3-round' name='submit'>Order</button></p>
            </form>";
        }
        else {
            header("Location: login.php?error=logInFirst");
            exit();
        }
    }
    
?>
    <p><section class="signup-form w3-center"></p>
        <h2>Website</h2>
        <?php echo showHome(); ?>
    </section>
<?php
    include 'footer.php';
?>

