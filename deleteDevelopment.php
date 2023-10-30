<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blogingwebsite_internship";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    // Validate and sanitize the input
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $dd = $_GET['id'];
        // You can add further validation if needed (e.g., check if the username exists in the database)
    } else {
        throw new Exception("Invalid or missing 'id' parameter.");
    }

    $stmt = $conn->prepare("DELETE FROM development  WHERE id= ?");
    $stmt->bind_param("s", $dd); 

    if ($stmt->execute()) {
        // Data deleted successfully, now redirect to show.php to display the updated user data
        header("Location:Development.php");
        exit; // Ensure the script terminates after the redirect
    } else {
        throw new Exception("Error deleting data: " . $stmt->error);
    }

    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>