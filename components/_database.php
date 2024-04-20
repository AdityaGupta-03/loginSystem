<?php
$servername = "localhost";      // MySQL server address
$username = "root";             // MySQL username
$password = "";                 // MySQL password
$dbname = "dbaddy";             // Name of the database you want to create

// Create Mysql connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$result = $conn->query($sql);

if (!$result) {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Connect to the database without closing the connection
$conn->select_db($dbname);

// Creating the table
$tableName = 'logindetails';
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
        sno INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(50),
        username VARCHAR(50) NOT NULL,
        password_hash VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

// even if the table already exists query gets executed and $createTable will contain true;
$createTable = $conn->query($sql);

if (!$createTable) {
    echo "Error creating table: " . $conn->error;
}

?>
