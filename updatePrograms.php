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

        // Handle image update
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_destination = "uploads/" . $image_name; // Set the destination directory

            // Move the uploaded image to the destination folder
            if (move_uploaded_file($image_tmp_name, $image_destination)) {
                // Image uploaded successfully, update it in the database
                $sql = "UPDATE programs SET title = ?, body = ?, topic = ?, image = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssi", $title, $body, $topic, $image_name, $id);

                if ($stmt->execute()) {
                    // Post updated successfully
                    header("Location: Programs.php"); // Redirect to a post list page or another appropriate location
                    exit();
                } else {
                    echo "Error updating the post: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error uploading image.";
            }
        } else {
            // If no new image is uploaded, update other fields without changing the image
            $sql = "UPDATE programs SET title = ?, body = ?, topic = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $title, $body, $topic, $id);

            if ($stmt->execute()) {
                // Post updated successfully
                header("Location: Programs.php"); // Redirect to a post list page or another appropriate location
                exit();
            } else {
                echo "Error updating the post: " . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        echo "Invalid request.";
    }
}

$conn->close();
?>
