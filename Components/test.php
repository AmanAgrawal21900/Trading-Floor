<?php
    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = "Trading_floor";
    $conn = mysqli_connect($dbhost,$dbUsername,$dbpassword, $dbname);
    $userid = 1;

    //Sql Queries 
    //For fetching bought stocks data
    $purchase = "SELECT symbol, shares FROM c_purchase where id='$userid'";
    if($stocks = mysqli_query($conn, $purchase)){ 
        if(mysqli_num_rows($stocks) > 0)
        while($row = mysqli_fetch_array($stocks))
            //print_r ($row);
            $stock_info[] = $row;
        mysqli_free_result($stocks); 
    }
    $stock_json = json_encode($stock_info);
    //print_r ($stock_json);
?>

<html>
    <scrip src="../JS/share-list.js"></script>
    <?php echo "<span> {{ get_json_object_buy(JSON.parse(".json_encode($stock_json).")); }}</span>";?>
</html>