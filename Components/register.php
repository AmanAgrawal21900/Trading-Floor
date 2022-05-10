<!-- MYSQL QUERIES -->

<?php
    if(isset($_POST["reg-finish"]))
    {
        $uname = $_POST["username"];
        $newemail = $_POST["email"];
        $pwd = $_POST["password"];
        $cpwd = $_POST["confirmation"];

        $dbhost = 'localhost';
        $dbUsername = 'root';
        $dbpassword = '';
        $dbname = 'Trading_floor';
    
        if (strcmp($pwd, $cpwd) == 0)
        {
            //Creating Database connection
            $conn  = mysqli_connect($dbhost,$dbUsername,$dbpassword,$dbname);
            if (!$conn)
            {
                die('Connection Failed: '.mysqli_connect_error());
            }
        
            $sql = "SELECT * FROM c_users WHERE email = '$newemail'";
            if($result = mysqli_query($conn, $sql))
            { 
                if(mysqli_num_rows($result) == 0)
                { 
                    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $sql = 'INSERT INTO c_users (username, email, phash, cash) VALUES("'.$uname.'","'.$newemail.'","'.$hashedpwd.'", 10000)';
                    mysqli_query($conn, $sql);
                    header("location:login.php");
                }
            }
        }
    } 
?>

<!-- PAGE CONTENT -->

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, width=device-width">

        <title>Trading Floor - Register</title>

        <!-- CSS -->
        <link rel="stylesheet" href="../CSS/register.css">

        <!-- Including Bootstrap -->
        <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" rel="stylesheet">
        <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"></script>
        
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/vanta@0.5.21/vendor/three.r119.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vanta@0.5.21/dist/vanta.net.min.js"></script>
    </head>

    <body>
        <!-- Navbar -->
        <div class="outerdiv">
            <div class="reg_div" id="vanta-el">

                <form class="reg-container" method="post">
                    <h4 style="color:white; font-size:2rem;">Register</h4>
                    <input name="username" placeholder="Username" type="text">
                    <input name="email" placeholder="Email" type="text">
                    <input name="password" placeholder="Password" type="password">
                    <input name="confirmation" placeholder="Password (again)" type="password">
                    <button class="btn btn-primary" type="submit" style="display: inline-block;" id="reg-finish" name="reg-finish">Register</button>
                </form>

                <script type="text/javascript">
                    VANTA.NET({
                        el: "#vanta-el",
                        mouseControls: true,
                        touchControls: true,
                        gyroControls: false,
                        minHeight: 200.00,
                        minWidth: 200.00,
                        scale: 1.00,
                        scaleMobile: 1.00,
                        color: 0x3f55ff,
                        backgroundColor: 0x0,
                        points: 16.00,
                        maxDistance: 22.00
                        })
                </script>

            </div>
        </div>
    </body>
</html>