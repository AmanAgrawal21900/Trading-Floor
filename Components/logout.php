<!-- DESTROY SESSION -->

<?php
    session_start();
    if(!isset($_SESSION['userid']) || $_SESSION['userid']==false){
        header('location: login.php');
    }else{
        session_unset();
        session_destroy();
        header('location: login.php');
    }
?>