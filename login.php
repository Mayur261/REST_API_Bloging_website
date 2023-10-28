<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "blogingwebsite_internship";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["username"];
    $password = $_POST["password"];

    // You should add more input validation and error handling here.

    // Check user credentials in the database
    $sql = "SELECT id, username, password FROM userregistration WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId, $username, $hashedPassword);
        $stmt->fetch();

        // Verify the entered password
        if (password_verify($password, $hashedPassword)) {
            // Login successful
            // Set session variables for user authentication (example)
            session_start();
            $_SESSION["user_id"] = $userId;
            $_SESSION["username"] = $username;

            // Redirect to dashboard.php
            header("Location: Dashboard.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found. Please try again.";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
