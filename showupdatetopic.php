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

$topic = ""; // Initialize the $topic variable

// Check if the user is logged in and a session variable 'username' is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statements to protect against SQL injection
    $sql = "SELECT topic, info FROM topic WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "s" represents a string

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $topic = $row['topic'];
            $info = $row['info'];
        } else {
            echo "No topic found for the given username.";
        }
    } else {
        echo "Error executing the query: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "User is not logged in or username not set in the session.";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://celionatti.github.io/blog-template/assets/css/admin-style.css">
    <title>Admin Create Topic | New Blog Template 2023</title>
</head>

<body>
    <header>
        <div class="nav-overlay"></div>
        <span role="button" class="menu-icon">
            <ion-icon name="menu-outline"></ion-icon>
        </span>
        <a href="#" class="logo-wrapper td-none">
            <div><span>B</span>LOG</div>
        </a>

        <nav>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#">
                        <ion-icon name="person-circle-outline" class="nav-icon"></ion-icon>
                        Celio Natti
                        <ion-icon name="chevron-down-outline" class="nav-icon"></ion-icon>
                    </a>
                    <ul class="dropdown">
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <div class="page-wrapper">
        <div class="sidebar">
            <div class="sidebar-author-mobile">
                <img class="avatar" src="/assets/images/avatar/user.webp" alt="">
                <h3 class="author-name">Celio Natti</h3>
                <a href="#" class="logout-link">Logout</a>
            </div>
            <ul class="list-menu">
                <li>
                    <a href="#">
                        <ion-icon name="speedometer-outline" class="menu-icon"></ion-icon>
                        Dashboard
                        <ion-icon name="chevron-forward-outline" class="chevron-forward"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="reader-outline" class="menu-icon"></ion-icon>
                        Post
                        <ion-icon name="chevron-forward-outline" class="chevron-forward"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="grid-outline" class="menu-icon"></ion-icon>
                        Topics
                        <ion-icon name="chevron-forward-outline" class="chevron-forward"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="people-outline" class="menu-icon"></ion-icon>
                        Users
                        <ion-icon name="chevron-forward-outline" class="chevron-forward"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="lock-closed-outline" class="menu-icon"></ion-icon>
                        Roles
                        <ion-icon name="chevron-forward-outline" class="chevron-forward"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="key-outline" class="menu-icon"></ion-icon>
                        Permissions
                        <ion-icon name="chevron-forward-outline" class="chevron-forward"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="reader-outline" class="menu-icon"></ion-icon>
                        Collections
                        <ion-icon name="chevron-forward-outline" class="chevron-forward"></ion-icon>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ==== PAGE CONTENT ==== -->
        <div class="page-content">
            <div class="admin-container">
                <form action="updatetopic.php" method="post" class="admin-form sm-box">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <h1 class="center form-title">Create Topic</h1>

                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?php echo $topic; ?>" class="input-control">
                    </div>
                    <div class="input-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="input-control"><?php echo $info; ?></textarea>
                    </div>

                    <div class="input-group">
                        <button type="submit" class="btn primary-btn big-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://celionatti.github.io/blog-template/assets/js/admin.js"></script>
</body>

</html>

