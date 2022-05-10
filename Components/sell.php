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

    $cash = 0;
    //Fetching Cash Data
    $cash_query = "SELECT cash FROM c_users where userid='$userid'";
    if($cash_info = mysqli_query($conn, $cash_query)){
        $row = mysqli_fetch_array($cash_info);
        $cash = $row["cash"];
    }
?>

<!-- PAGE CONTENT -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trading Floor - Sell</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/quote.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">

</head>
<body>
    <!-- INCLUDING NAVBAR -->
    <?php require_once 'navbar.php'?>

    <!-- Main content -->
    <div class="quoteContainer">
        <form  class="quoteForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="sellform">
            <?php 
                $query = "SELECT * FROM c_purchase WHERE id='$userid'";
                $rows = mysqli_query($conn, $query);

                if (mysqli_num_rows($rows) > 0){
                    echo "<select name='sell_shares' id='sell_shares'>";
                        //echo "<option>--Select Symbol--</option>";
                        while($row = mysqli_fetch_array($rows)){
                            echo "<option value=".$row["symbol"].">".$row["symbol"]."</option>";
                        }
                    echo "</select>";  
                }          
            ?>
            <input type="text" placeholder="Shares to Sell" name="qty"><br>
            <input type="submit" value="Sell">
            <input onclick="location.href='https://iextrading.com/trading/eligible-symbols/'" id="view-btn" type="button" value="View Symbol List">
        </form>
    </div>

    <!-- Getting data from form - same page post -->
    <?php
        // Same page post data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field
            $sym = filter_input(INPUT_POST, 'sell_shares', FILTER_SANITIZE_STRING);
            $qty = $_POST['qty'];
        }
    ?>

    <!-- making ajax call to get remaining data from API-->
    <script>
            document.getElementById("sellform").reset(); 
            var sym = "<?php echo "$sym"?>";
            var qty = "<?php echo "$qty"?>";
            var uid = "<?php echo "$userid"?>";
            var cash = "<?php echo "$cash"?>";
            var sname = "";
            var price = 0;
            get_price(sym).then(
                function(value){
                    sname = value['sname'];
                    price = value['price'];
                    var creds = "sname="+sname+"&price="+price+"&qty="+qty+"&userid="+uid+"&cash="+cash+"&sym="+sym;
                    console.log(creds);
                    var ajx = new XMLHttpRequest();
                    ajx.onreadystatechange = function () {
                        if (ajx.readyState == 4 && ajx.status == 200) {
                            //console.log(ajx.responseText);
                            document.getElementById("selllist").innerHTML = ajx.responseText;
                            document.getElementById("selllist").style.display = "flex";
                        }
                    };
                    ajx.open("POST", "http://localhost/t/Components/selldata.php", true);
                    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    ajx.send(creds);
                }
            );
    </script>

    <div id="selllist">

    </div>
</body>
</html>