<?php
    session_start();
    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = "Trading_floor";
    
    $conn = mysqli_connect($dbhost,$dbUsername,$dbpassword, $dbname);
    $userid = $_SESSION['userid'];

    $tran_query = "SELECT * FROM c_transactions WHERE id = '$userid'";
    $result = mysqli_query($conn, $tran_query);

    $data = [];    
    while($row = mysqli_fetch_array($result)) {
        $data[] = array("symbol"=>$row['symbol'], "shares"=> $row["shares"], "price"=>$row["price"], "action"=>$row["action"], "transacted"=>$row["transacted"]);
    }
    echo json_encode($data);
?>