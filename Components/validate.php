<?php

if(isset($_POST["log-submit"]))
{
    $useremail = $_POST["email"];
    $pwd = $_POST["pass"];

    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = 'Trading_floor';

    //Creating Database connection
    $conn  = mysqli_connect($dbhost, $dbUsername, $dbpassword, $dbname);
    if (!$conn)
    {
        die('Connection Failed: '.mysqli_connect_error());
    }

    $sql = "SELECT * FROM c_users WHERE email = '$useremail'";
    if($result = mysqli_query($conn, $sql))
    {
        if(mysqli_num_rows($result) == 0)
        {
            header("location:login.php?error=eruser");
        }
        else{
            $row = mysqli_fetch_array($result);
            //var_dump ($row);
            $pwdhashed = $row["phash"];
            $checkpass = password_verify($pwd, $pwdhashed);
            if($checkpass == false)
            {
                header("location:login.php?error=erpass");
            }
            else if($checkpass == true)
            {
                session_start();
                $_SESSION["userid"] = $row["userid"];
                header("location:dashboard.php");
            }
        }
    }
}
?>