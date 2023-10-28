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
    if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['editor']) && isset($_POST['topic'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $body = $_POST['editor'];
        $topic = $_POST['topic'];

        // You can add additional fields as needed.

        // Use prepared statements to protect against SQL injection
        $sql = "INSERT INTO publish (id, title, body, topic) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $id, $title, $body, $topic); // "isss" represents an integer and three strings, adjust the types if needed

        if ($stmt->execute()) {
            // Data inserted into the "publish" table successfully
            header("Location: publish_list.php"); // Redirect to a publish list page or another appropriate location
            exit();
        } else {
            echo "Error inserting data into the 'publish' table: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }
}

$conn->close();
?>
