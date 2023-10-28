<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$database = "blogingwebsite_internship";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['description'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Get the username from the session
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        } else {
            // Handle the case where the username is not in the session
            echo "Session username not set.";
            exit();
        }

        // Use prepared statements to protect against SQL injection
        $sql = "INSERT INTO topic (topic, info, username) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $description, $username);

        if ($stmt->execute()) {
            // Topic added to the 'topic' table successfully
            header("Location: topic.php"); // Redirect to a topic list page or another appropriate location
            exit();
        } else {
            echo "Error adding the topic to the 'topic' table: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }
}

$conn->close();
?>