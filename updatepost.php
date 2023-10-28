<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$database = "blogingwebsite_internship";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $body = $_POST['editor'];
        $topic = $_POST['topic'];

        // You can update other fields like image and published as needed.

        // Use prepared statements to protect against SQL injection
        $sql = "UPDATE posts SET title = ?, body = ?, topic = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $body, $topic, $id); // "sssi" represents two strings and an integer, adjust the types if needed

        if ($stmt->execute()) {
            // Post updated successfully
            header("Location: post.php"); // Redirect to a post list page or another appropriate location
            exit();
        } else {
            echo "Error updating the post: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }
}

$conn->close();
?>
