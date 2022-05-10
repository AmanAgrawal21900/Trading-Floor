<!--Making Session dashboard.php-->
<?php
    session_start();
    
    if(!isset($_SESSION['userid']) || $_SESSION['userid']==false){
        header('location:login.php');
    }
    
    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = "Trading_floor";

    $conn = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
    $userid = $_SESSION['userid'];

    $cash = 0;
    //Fetching Cash Data
    $cash_query = "SELECT cash FROM c_users where userid='$userid'";
    if($cash_info = mysqli_query($conn, $cash_query)){
        $row = mysqli_fetch_array($cash_info);
        $cash = $row["cash"];
    }
?>

<!DOCTYPE html>
<html lang="en">

<!--Page-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.dots.min.js"></script>

        
        <title>Trading Floor - Dashboard</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="../CSS/index.css">
        <link rel="stylesheet" href="../CSS/dashboard.css">
        <link rel="stylesheet" href="../CSS/quote.css">

    </head>

    <body>
    <!-- Adding Navbar -->
        <?php require_once 'navbar.php'?>
        
        
        <!-- Content -->
        <br><br><br>
            <?php
                $query = "SELECT * FROM c_purchase WHERE id='$userid'";
                $rows = mysqli_query($conn, $query);
                if (mysqli_num_rows($rows) > 0){
                    $price = 0;
                    echo "<table class='stock_table' id='dashtable'><tr><th>Symbol</th><th>Company Name</th><th>Shares</th></tr>";
                        while($row = mysqli_fetch_array($rows)){
                            echo "<tr id='row3'><td>".$row["symbol"]."</td><td>".$row["cname"]."</td><td>".$row["shares"]."</td></tr>";
                        }
                    echo "<tr id='irow3'><td></td><td id='irow1'>Balance in Your Wallet</td><td id='irow2'>$".$cash."</td></tr>";    
                    echo "</table>";  
                }
                else{
                    echo "<div class='alert alert-primary' style='display:flex; justify-content:center' role='alert'>
                        You Don't have any shares, Buy Now!
                    </div>";
                }
            ?>
<!-- 
    <script>
        VANTA.DOTS({
        // el: "#veledash",
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