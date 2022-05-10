<!-- SESSIONS -->
<?php

    if(!isset($_SESSION['userid']) || $_SESSION['userid']==false){
        header('location:login.php');
    }

    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = "Trading_floor";
    
    $conn = mysqli_connect($dbhost,$dbUsername,$dbpassword, $dbname);
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM c_users WHERE userid = '$userid'";
    $share_table = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($share_table);
    $uname = $row['username'];
?>

<!-- NAVBAR COMPONENT -->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/index.css">

    <!-- Angular -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular-route.min.js"></script> -->

    <!-- JS -->
    <script src="../JS/share-list.js"></script>

</head>

<body>
    <div class="navbar">
        <a href="./dashboard.php">Home</a>
        <a href="./quote.php">Quote Price</a>
        <a href="./buy.php">Buy Shares</a>
        <a href="./sell.php">Sell Shares</a>
        <a href="./history.php">History</a>

        <span>&nbsp;&nbsp;Welcome<span class='uname'><?php echo $uname?></span></span>
        <a id="logout-btn" href="logout.php">Logout</a>
    </div>
</body>
</html>