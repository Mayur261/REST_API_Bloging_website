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

// Handle the registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // You should add more input validation and error handling here.

    // Hash the password (you should use a more secure hashing method)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO userregistration (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful. You can now <a href='login.html'>login</a>.";
    } else {
        // Registration failed
        echo "Registration failed. Please try again.";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
