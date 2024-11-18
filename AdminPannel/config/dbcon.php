<!-- this code for create the connection from the phpmyadmin using databasename  -->
 <?php
 $host="localhost";
 $username="root";
 $password="";
$database="phpecom";
// creating database connection 
$con=mysqli_connect($host,$username,$password,$database);

//check database connection
if(!$con)
{
    die("connection failed". mysqli_connect_error());
 }

      
?> 

