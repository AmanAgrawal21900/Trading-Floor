<?php
if(isset($_POST['submit']))
{ 
if(empty($_POST['name']) || empty($_POST['age']) || empty($_POST['pass']) || empty($_POST['check_list']))
	header("location:formdatabase.html");
else
{
	$a=$_POST['name'];
	$b=$_POST['age'];
	$c=$_POST['pass'];
$d=[];
if(!empty($_POST['check_list'])) 

	//Checking of checkboxes are not empty

	{
		// Loop to store and display values of individual checked checkbox.
		$i=0;
		foreach($_POST['check_list'] as $s)
		{
			$d[$i]=$s;
			$i++;
         }
    }
$e=implode(',',$d);
}
$dbHost = '127.0.0.1';//or localhost
$dbName = 'trading floor'; // your db_name
$dbUsername = 'root'; // root by default for localhost 
$dbPassword = '';  // by default empty for localhost

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected Successfully";




$sql = "CREATE TABLE if not exists purchase(
    id int NOT NULL,
    symbol varchar(1) NOT NULL,
    age int NOT NULL)";
if(mysqli_query($conn, $sql))
{
    echo "<br>Table created successfully</br>";
} 
else
{
    echo "ERROR: Could not create table " . mysqli_error($conn);
}



$sql = "CREATE TABLE if not exists transactions(
    id int NOT NULL,
    symbol varchar(1) NOT NULL,
    shares int NOT NULL,
    price numeric NOT NULL,
    action VARCHAR(30) NOT NULL,
    transacted timestamp NOT NULL)";
if(mysqli_query($conn, $sql))
{
    echo "<br>Table created successfully</br>";
} 
else
{
    echo "ERROR: Could not create table " . mysqli_error($conn);
}



$sql = "CREATE TABLE if not exists users(
    id int NOT NULL PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password varchar(30) NOT NULL, 
    cash numeric NOT NULL)";
if(mysqli_query($conn, $sql))
{
    echo "<br>Table created successfully</br>";
} 
else
{
    echo "ERROR: Could not create table " . mysqli_error($conn);
}



mysqli_close($conn);

 }
 else
 {
 	header("location:formdatabase.html");
 }
?>
