<!-- Creating database -->
<?php //require_once 'make_db.php'?>

<!-- LOGIN PAGE -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trading Floor - Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js"></script>

</head>
<body>
    <main id="globe">
        <!-- Vanta Globe -->
        <script>
            VANTA.GLOBE({
                el: "#globe",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                scale: 1.00,
                scaleMobile: 1.00,
                size: 2.00,
                color: 0x773fff
            })
        </script>

        <div class="alert alert-danger erpass" role="alert">
            Incorrect Password!
        </div>

        <div class="alert alert-danger eruser" role="alert">
            User Not Found!
        </div>
        <div class="login-container">
            <div class="login-logo">
                <img id="trdlogo" src="../Images/trdlogo.png" alt="logo">
            </div>
                                
            <div class="login">
                <p class="title">Login</p>
                <form class="login-form" method="POST" action="validate.php">
                    <label id="email-lab" for="email">Email</label>
                    
                    <input type="email" id="email" name="email" required placeholder="Your email">

                    <div class="input-error">
                        <!--Div for email errors-->
                    </div>
                    
                    <label id="pass-lab" for="pass">Password</label>
                    
                    <input type="password" id="pass" name="pass" required placeholder="Your password">

                    <input type="submit" id="log-submit" name="log-submit" value="Login">

                    <input type="button" id="reg" onclick="location.href='register.php'" value="New user? Register Now!">
                </form>              
            </div>
        </div>

        <!-- ERROR MESSAGES -->
        <?php
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if(strpos($url, "error=eruser") == true){
                echo "<script> document.querySelector('.eruser').style.display = 'flex' </script>";
            }
            if(strpos($url, "error=erpass") == true){
                echo "<script> document.querySelector('.erpass').style.display = 'flex' </script>";
            }
        ?>
    </main>
</body>
</html>