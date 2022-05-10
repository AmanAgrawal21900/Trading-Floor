<?php
    header("Refresh:0");
    $new_shares = 0;
    date_default_timezone_set("Asia/Kolkata");

    if (isset($_POST['sname'])) {
        $sname_new = $_POST['sname'];
    }

    if (isset($_POST['price'])) {
        $price_new = $_POST['price'];
    }

    if (isset($_POST['qty'])) {
        $qty_new = $_POST['qty'];
    }

    if (isset($_POST['userid'])) {
        $userid = $_POST['userid'];
    }

    if (isset($_POST['cash'])) {
        $cash = $_POST['cash'];
    }

    if (isset($_POST['sym'])) {
        $symbol = $_POST['sym'];
    }

    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = "Trading_floor";
    
    $conn = mysqli_connect($dbhost,$dbUsername,$dbpassword, $dbname);

    //SQL Queries
    $shares_check = "SELECT shares FROM c_purchase WHERE id='$userid' AND symbol='$symbol'";
    $row = mysqli_query($conn, $shares_check);    
    $shares_check_arr = mysqli_fetch_array($row);                         
    $share_quantity = $shares_check_arr["shares"];
    
    if ($share_quantity < $qty_new){
        echo "Not enough shares to sell";
    }
    else{
        //Calculating the price of sale, decrease in stocks and updating purchase database
        $sale_price = (float)$price_new * $qty_new;

        $before = "SELECT shares FROM c_purchase where id='$userid' AND symbol='$symbol'";
        $row = mysqli_query($conn, $before);    
        $before_arr = mysqli_fetch_array($row); 
        // if shares reaches 0 delete the entry or reduce the number of shares

        $new_shares = (int)$before_arr["shares"] - $qty_new;
        if ($new_shares == 0){
            $del = "DELETE FROM c_purchase WHERE id='$userid' AND symbol='$symbol'";
            $row = mysqli_query($conn, $del); 
        }
        else{
            $upd = 'UPDATE c_purchase SET shares="'.$new_shares.'" WHERE id="'.$userid.'" AND symbol="'.$symbol.'"';
            $row = mysqli_query($conn, $upd); 
        }

        $new_cash = (float)$cash + $sale_price;

        //Updating user cash in users
        $upd_cash = 'UPDATE c_users SET cash="'.$new_cash.'" WHERE userid="'.$userid.'"';
        $row = mysqli_query($conn, $upd_cash); 

        //Keeping track of transactions in transactions table
        $tran = 'INSERT INTO c_transactions (symbol, shares, price, id, action, transacted) VALUES ("'.$symbol.'", -"'.$qty_new.'", "'.$price_new.'", "'.$userid.'", "Sold", "'.date('Y/m/d H:i:s').'")';
        $row = mysqli_query($conn, $tran); 

        echo $qty_new." shares of Company ".$sname_new." of price $".$price_new." each sold successfully!";
    }
?>