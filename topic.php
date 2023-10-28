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
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://celionatti.github.io/blog-template/assets/css/admin-style.css">
    <title>Admin Topics | New Blog Template 2023</title>
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

        <div class="page-content">
            <div class="admin-container">
                <div class="admin-table sm-box">
                    <h1 class="center">Topics</h1>
                    <hr>

                    <div class="table-actions">
                        <span></span>
                        <a href="createTOPIC.php" class="btn primary-btn small-btn">
                            <ion-icon name="add-circle-outline" class="icon"></ion-icon>
                            Add Topic
                        </a>
                    </div>

                    <div class="responsive-table">
                        <table>
                            <thead>
                                <th>S/N</th>
                                <th>Topic</th>
                                <th>Description</th>
                                <th>Update</th>
                                <th>Delete</th>
                           
                            </thead>
                            <tbody>
                                <tr>
                                <?php


$servername = "localhost";
$username = "root";
$password = "";
$database = "blogingwebsite_internship";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username from the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Handle the case where the username is not in the session
    echo "Session username not set.";
    exit();
}

// Query the database to fetch topics associated with the username
$sql = "SELECT id, topic, info FROM topic WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

// Check if there are results
if ($result->num_rows > 0) {
    // Output the data in a table
    // echo '<table>';
    // echo '<thead><th>S/N</th><th>Topic</th><th>Description</th><th>Update</th><th>Delete</th></thead>';
    // echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['topic'] . '</td>';
        echo '<td>' . $row['info'] . '</td>';
        echo "<td><a href='showupdatetopic.php?id=" . $row["id"] . "' class='edit'>Update</a></td>";
        echo "<td><a href='deletetopic.php?id=" . $row["id"] . "' class='delete'>Delete</a></td>";

        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "No topics found " .$username. " add topic .";
}

// Close the database connection
$stmt->close();
$conn->close();
?>


                                    
                            </tbody>
                            <tfoot>
                                <td colspan="6">
                                    <div class="pagination-links">
                                        <a href="#" class="link active">1</a>
                                        <a href="#" class="link">2</a>
                                        <a href="#" class="link">3</a>
                                        <a href="#" class="link">4</a>
                                        <a href="#" class="link">5</a>
                                        <a href="#" class="link">6</a>
                                        <a href="#" class="link">7</a>
                                    </div>
                                </td>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://celionatti.github.io/blog-template/assets/js/admin.js"></script>

</body>

</html>