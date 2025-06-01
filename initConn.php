<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "webdevproject");
if (!$conn) {
    // Attempt to create the database if it doesn't exist
    $conn = mysqli_connect("localhost", "root", "");
    if ($conn) {
        $createDbSql = "CREATE DATABASE IF NOT EXISTS webdevproject";
        if (mysqli_query($conn, $createDbSql)) {
            $conn = mysqli_connect("localhost", "root", "", "webdevproject");
        } else {
            die("Database creation failed: " . mysqli_error($conn));
        }
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
}

if ($conn) {
    // Create the table if it doesn't exist
    $createTableSql = "CREATE TABLE IF NOT EXISTS student (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        age INT NOT NULL,
        major VARCHAR(100),
        email VARCHAR(100) UNIQUE NOT NULL,
        entry_date DATE NOT NULL,
        profile_picture VARCHAR(255)
    )";
    // Execute the query to create the table
    if (!mysqli_query($conn, $createTableSql)) {
        echo "Error creating table: " . mysqli_error($conn);
    }
}
?>