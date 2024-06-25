<?php
// Create a connection to the database
$con = new mysqli("localhost", "root", "", "testing");

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
