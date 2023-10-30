
<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

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
    $sql = "SELECT title, body, image FROM posts";
    $result = $conn->query($sql);
    // Query the database to get the user's profile name
    $sql = "SELECT username FROM userregistration WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username);

    // Fetch the profile name
    if ($stmt->fetch()) {
        // Display the user's profile name
        $userProfileName = $username;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: access.html");
    exit();
}
?>



<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/admin-style.css">
    <title>Admin Dashboard | New Blog Template 2023</title>

    <style>
    .post-card-container-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 37px; /* Adjust the gap as needed */
        overflow: auto; /* Add overflow property to allow scrolling if content is too long */
    }

    .post-card-container {
        background-color: #039196;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
        max-width: 350px;
        width: calc(33.33% - 20px); /* Adjust the width and gap as needed for the desired layout */
        margin-left: 5px; /* Add space to the left side */
        max-height: 400px; /* Set a maximum height for the containers */
        overflow: hidden; /* Hide overflow content */
    }

    .post-title {
        margin-bottom: 10px; /* Adjust this value as needed for the desired spacing between title and image */
    }

    .post-content img {
        margin: 10px 0; /* Adjust this value to control spacing between image and title, and image and body */
    }

    .post-body {
        margin-top: 10px; /* Adjust this value as needed for the desired spacing between image and body */
        overflow: auto; /* Add overflow property to allow scrolling if content is too long */
    }
</style>
</head>

<body>
<?php include 'header.php'; ?>

    <div class="page-wrapper">
        
    <?php include 'sidebar.php'; ?>

        <div class="page-content">
            <!-- <div class="admin-container">
                <h1 class="center">Admin Dashboard</h1>
            </div> -->
        

        <!-- <u><h2 class="page-title">Blog Posts</h2></u> -->
        <h1 class="center">Admin Dashboard</h1>
        <div class="post-card-container-wrapper">
            <?php
            while ($row = $result->fetch_assoc()) {
                // Retrieve data from the database result
                $title = $row['title'];
                $body = $row['body'];
                $image = $row['image'];
            ?>
            <div class="post-card-container">
                <div class="post-content">
                    <h2 class="post-title"><u><?php echo $title; ?></u></h2>
                    <img src="uploads/<?php echo $image; ?>">
                    <p class="post-body"><?php echo $body; ?></p>
                </div>
            </div>
            <?php
            }
            ?>

        </div>
    </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://celionatti.github.io/blog-template/assets/js/admin.js"></script>
</body>
</html>