<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Handle the form submission to add a new post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the MySQL database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "blogingwebsite_internship";

    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $title = $_POST["title"];
    $body = $_POST["editor"];
    $topic = $_POST["topic"];
    $published = isset($_POST["published"]) ? 1 : 0;
    $username = $_SESSION['username'];

    // You should add validation and sanitization for these inputs

    // Insert the data into the database
    $sql = "INSERT INTO posts (title, body, topic, published, username) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $title, $body, $topic, $published, $username);

    if ($stmt->execute()) {
        // Successful insertion
        //echo "Post added successfully!";
        header("Location: post.php");
    } else {
        // Error during insertion
        echo "Error adding the post.";
    }

    $stmt->close();
    $conn->close();
}
?>