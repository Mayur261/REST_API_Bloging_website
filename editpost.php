<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

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

    // Fetch data from the database based on the username (assuming username is the primary key)
    $sql = "SELECT * FROM posts WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();


    // if ($result->num_rows == 1) {
    //     $row = $result->fetch_assoc();
    //     $title = $row['title'];
    //     $body = $row['body'];
    //     $image = $row['image'];
    //     $topic = $row['topic'];
    // } else {
    //     echo "No post found with the given ID.";
    //     exit();
    // }

    // Check if there are results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $body = $row['body'];
            $topic = $row['topic'];
        // Display the data for editing
            echo "Post ID: " . $row['id'] . "<br>";
            echo "Title: " . $row['title'] . "<br>";
            // Add other fields here as needed
        }
    } else {
        echo 'No posts found for editing.';
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
