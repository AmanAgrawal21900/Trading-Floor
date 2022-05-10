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

    // Sql Queries 
    
    $shares_bought = (float)$price_new * $qty_new;

    if ($shares_bought > $cash){
        echo "Not enough Money in The wallet!";
    }
    else {
        $query = "SELECT symbol FROM c_purchase WHERE id='$userid' AND symbol='$symbol'";
        $rows = mysqli_query($conn, $query);
        if (mysqli_num_rows($rows) == 0){
            $query = 'INSERT INTO c_purchase (id, symbol, cname, shares) VALUES ("'.$userid.'", "'.$symbol.'", "'.$sname_new.'", "'.$qty_new.'")';
            $row = mysqli_query($conn, $query);
        }

        else{
            $before = "SELECT shares FROM c_purchase where id='$userid' AND symbol='$symbol'";
            $before_rows = mysqli_query($conn, $before);                          
            $before_arr = mysqli_fetch_array($before_rows); 
            
            $new_shares= $before_arr["shares"] + $qty_new; 

            $upd = 'UPDATE c_purchase SET shares="'.$new_shares.'" WHERE id="'.$userid.'" AND symbol="'.$symbol.'"';
            $upd_rows = mysqli_query($conn, $upd);
        }

        (float)$new_cash = (float)$cash - (float)$shares_bought;
        $cash_upd = 'UPDATE c_users SET cash="'.$new_cash.'" WHERE userid="'.$userid.'"'; 
        $cash_row = mysqli_query($conn, $cash_upd);  

        $trans = 'INSERT INTO c_transactions (symbol, shares, price, id, action, transacted) VALUES ("'.$symbol.'", +"'.$qty_new.'", "'.$price_new.'", "'.$userid.'", "Bought", "'.date('Y/m/d H:i:s').'")';
        $trans_row = mysqli_query($conn, $trans);  
        echo $qty_new." shares of Company ".$sname_new." of price $".$price_new." each bought successfully!";
    }

    mysqli_close($conn);

    // 
    // For fetching bought stocks data
    //$purchase = "SELECT * FROM c_purchase where id='$userid'";


    // $li = "";
    // if($stocks = mysqli_query($conn, $purchase)){ 
    //     if(mysqli_num_rows($stocks) > 0)
    //     while($row = mysqli_fetch_array($stocks))
    //         print_r ($row);
    //         $symbol = $row['symbol'];
    //         $sname = $sname_new;
    //         $shares = $row['shares'];
    //         $price = $price_new;
    //         $amt = $price * $shares;
    //         $li .=  
    //         "<tr>
    //             <td>$symbol</td>
    //             <td>$sname</td>
    //             <td>$shares</td>
    //             <td>$price</td>
    //             <td class='total-label'>$amt</td>
    //         </tr>";
    // }
    // echo $li;
?>