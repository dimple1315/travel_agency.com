<?php
// Establish connection to MySQL database
$conn = new mysqli('localhost', 'root', '', 'tms');

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}
?>
