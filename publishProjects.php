<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection credentials
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "blogingwebsite_internship";

    // Create a new database connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $id = $_POST['id'];

    // Update the 'published' column in the database
    $sql = "UPDATE projets SET published = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Post published successfully!";
        header("Location: Projects.php");
    } else {
        echo "Error publishing the post: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish Post | Blog Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            margin: 20px;
            color: #333;
        }
        form {
            text-align: center;
        }
        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #258cd1;
        }
    </style>
</head>
<body>
    <h1>Publish Post</h1>
    <form action="publishProjects.php" method="post" id="publishForm">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <button type="button" onclick="confirmPublish()">Publish</button>
    </form>

    <script>
        function confirmPublish() {
            if (confirm("Do you really want to publish this post?")) {
                document.getElementById("publishForm").submit();
            }
        }
    </script>
</body>
</html>

