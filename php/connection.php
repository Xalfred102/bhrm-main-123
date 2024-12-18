<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
$host = "localhost"; // e.g., "localhost" or database IP
$username = "root"; // your database username
$pass = ""; // your database password
$database = "bhrm"; // your database name

// Create a database connection
$conn = mysqli_connect($host, $username, $pass, $database);

// Check connection
if (!$conn) {
    die("Connection failed. something went wrong.");
}

?>