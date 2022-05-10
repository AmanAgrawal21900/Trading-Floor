<!-- SESSIONS -->

<?php
    session_start();
    if(!isset($_SESSION['userid']) || $_SESSION['userid']==false){
        header('location:login.php');
    }

    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = "Trading_floor";
    $conn = mysqli_connect($dbhost,$dbUsername,$dbpassword, $dbname);
    $userid = $_SESSION['userid'];
?>

<!-- PAGE CONTENT -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trading Floor - Quote</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/quote.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <!-- Link JavaScript file -->
	<script src="./fetchapi.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.dots.min.js"></script>

</head>
<body>
        <!-- ADDING NAVBAR -->
        <?php require_once 'navbar.php'?>

        <!-- MAIN CONTENT -->
        <div class="quoteContainer quoteForm">
            <input type="text" placeholder="Share Symbol" name="sym" id="sym"><br>
            <input type="submit" value="Lookup" onclick="get_price_from_api()">
            <input onclick="location.href='https://iextrading.com/trading/eligible-symbols/'" id="view-btn" type="button" value="View Symbol List">
        </div>
        <div class="showcontent">
            <table id="users" class="tabshow">
                
            </table>
        </div>
    

    <!-- <script>
        VANTA.DOTS({
        el: "#velem",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 730.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color: 0x2c13eb,
        color2: 0x222222,
        size: 2.60,
        spacing: 29.00
        })
    </script> -->
</body>
</html>