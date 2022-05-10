<?php

$dbhost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';

//Creating Database connection
$conn  = mysqli_connect($dbhost,$dbUsername,$dbpassword);
if (!$conn){
    die('Connection Failed: '.mysqli_connect_error());
}
echo "Connected Successfully";

//Create database
$sql = "CREATE DATABASE if not exists Trading_floor";

if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

//Connecting to created database
mysqli_select_db($conn,"Trading_floor");


$sql = "CREATE TABLE if not exists c_purchase(
    id int NOT NULL,
    symbol varchar(10) NOT NULL,
    cname varchar(255) NOT NULL,
    shares int NOT NULL)";

if(mysqli_query($conn, $sql))
{
    echo "<br>Table created successfully</br>";
} 
else
{
    echo "ERROR: Could not create table " . mysqli_error($conn);
}

$sql = "CREATE TABLE if not exists c_transactions(
    id int NOT NULL,
    symbol varchar(10) NOT NULL,
    shares int NOT NULL,
    price decimal(10,2) NOT NULL,
    action VARCHAR(50) NOT NULL,
    transacted timestamp NOT NULL)";

if(mysqli_query($conn, $sql))
{
    echo "<br>Table created successfully</br>";
} 
else
{
    echo "ERROR: Could not create table " . mysqli_error($conn);
}

$sql = "CREATE TABLE if not exists c_users(
    userid int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phash VARCHAR(255) NOT NULL, 
    cash decimal(10,2) NOT NULL)";
    
if(mysqli_query($conn, $sql))
{
    echo "<br>Table created successfully</br>";
} 
else
{
    echo "ERROR: Could not create table " . mysqli_error($conn);
}

mysqli_close($conn);
?>