<!-- SESSIONS -->
<?php
    session_start();
    if(!isset($_SESSION['userid']) || $_SESSION['userid']==false){
        header('location: login.php');
    }
    $dbhost = 'localhost';
    $dbUsername = 'root';
    $dbpassword = '';
    $dbname = "Trading_floor";
    
    $conn = mysqli_connect($dbhost,$dbUsername,$dbpassword, $dbname);
    $userid = $_SESSION['userid'];

?>

<!-- PAGE CONTENT -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trading Floor - History</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/dashboard.css">

    <!-- Angular -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular-route.min.js"></script>


</head>
<body ng-app="trad">
    <?php require_once 'navbar.php'?>

    <div id="content" ng-controller="data_ctrl">
        <br><br><br>
        <table class="stock_table">
            <tr>
                <th>Symbol</th>
                <th>Shares</th>
                <th>Price</th>
                <th>Action</th>
                <th>Transacted</th>
            </tr>
            <tr ng-repeat="x in transact">
                <td>{{ x.symbol }}</td><td>{{ x.shares }}</td><td>{{ x.price }}</td><td>{{ x.action }}</td><td>{{ x.transacted }}</td>
            </tr>
        </table>
    </div>
    <script>
        var fetch = angular.module('trad', []);
        fetch.controller('data_ctrl', ['$scope', '$http', function ($scope, $http) {
        $http({
            method: 'get',
            url: 'tran_fetch.php'
            }).then(function successCallback(response) {
            // Store response data
            $scope.transact = response.data;
            });
        }]);
    </script>
</body>
</html>