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

<html>
<head>
    <title>Trading Floor - Buy</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.dots.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/quote.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">

</head>

<body>
    <!-- Adding Navbar -->
        <?php require_once 'navbar.php'?>
        
        <!-- Main content -->
        <div class="quoteContainer">
            <form  class="quoteForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="buyform">
                <input type="text" placeholder="Share Symbol" name="sym"><br>
                <input type="text" placeholder="Shares to Buy" name="qty"><br>
                <input type="submit" value="Buy">
                <input onclick="location.href='https://iextrading.com/trading/eligible-symbols/'" id="view-btn" type="button" value="View Symbol List">
            </form>
        </div>

        <!-- Getting data from form - same page post -->
        <?php
            // Same page post data
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // collect value of input field
                $sym = $_POST['sym'];
                $qty = $_POST['qty'];
            }
        ?>

        <!-- making ajax call to get remaining data from API-->
        <script>
                document.getElementById("buyform").reset(); 
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

                        var ajx = new XMLHttpRequest();
                        ajx.onreadystatechange = function () {
                            if (ajx.readyState == 4 && ajx.status == 200) {
                                //console.log(ajx.responseText);
                                document.getElementById("buylist").innerHTML = ajx.responseText;
                                document.getElementById("buylist").style.display = "flex";
                            }
                        };

                        ajx.open("POST", "http://localhost/t/Components/buydata.php", true);
                        ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        ajx.send(creds);
                    }
                );
        </script>

        <div id="buylist">

        </div>



    <!-- <script>
        VANTA.DOTS({
        el: "#velebuy",
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
    
    <!-- <div ng-controller="shareCtrl">
        
        <h5 id="buytabletitle">Your Shares</h5>

        <table class="stock_table">
            <tr>
                <th>Stock Symbol</th>
                <th>Stock Name</th>
                <th>Shares</th>
                <th>Price</th>
                <th class="total-label">Total</th>
            </tr>
            <tr id="buylist"></tr>
        </table>
    </div> -->
</body>
</html>