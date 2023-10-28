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
    if (isset($_POST['title']) && isset($_POST['editor']) && isset($_POST['topic'])) {
        $title = $_POST['title'];
        $body = $_POST['editor'];
        $topic = $_POST['topic'];

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_destination = "uploads/" . $image_name; // Set the destination directory

            // Move the uploaded image to the destination folder
            if (move_uploaded_file($image_tmp_name, $image_destination)) {
                // Image uploaded successfully
            } else {
                echo "Error uploading image.";
                exit();
            }
        } else {
            $image_name = ''; // Default value if no image is uploaded
        }

        // You can add additional fields like "published" as needed.

        // Use prepared statements to protect against SQL injection
        $sql = "INSERT INTO posts (title, body, topic, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $body, $topic, $image_name);

        if ($stmt->execute()) {
            // Post added to the "posts" table successfully
            header("Location: post.php"); // Redirect to a post list page or another appropriate location
            exit();
        } else {
            echo "Error adding the post to the 'posts' table: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid request.";
    }
}

$conn->close();
?>
