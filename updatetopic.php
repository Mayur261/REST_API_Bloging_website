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
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Use prepared statements to protect against SQL injection
        $sql = "UPDATE topic SET topic = ?, info = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $description, $id); // "ssi" represents two strings and an integer, adjust the types if needed

        if ($stmt->execute()) {
            // Topic updated successfully
            header("Location: topic.php"); // Redirect to the topics page or another appropriate location
            exit();
        } else {
            echo "Error updating the topic: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }
}

$conn->close();
?>
