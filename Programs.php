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
    <link rel="stylesheet" type="text/css" href="CSS/admin-style.css">
    <title>Programs</title>
</head>

<body>
<?php include 'header.php'; ?>

    <div class="page-wrapper">
    <?php include 'sidebar.php'; ?>

        <div class="page-content">
            <div class="admin-container">
                <div class="admin-table lg-box">
                    <h1 class="center">Programs </h1>
                    <hr>

                    

                    <div class="table-actions">
                        <div class="table-filter-group">
                            <!-- <input type="search" name="search-term" id="search-post-input" placeholder="Search...">
                            <select name="filter-post" id="filter-post">
                                <option value="all">---Filter---</option>
                                <option value="all">All</option>
                                <option value="oldest">Oldest</option>
                                <option value="newest">Newest</option>
                                <option value="popular">Popular</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select> -->
                        </div>
                        <div class="table-buttons">
                           
                            <a href="createPrograms.php" class="btn primary-btn small-btn">
                                <ion-icon name="add-circle-outline" class="icon"></ion-icon>
                                Add Project
                            </a>
                        </div>
                    </div>

                    <div class="responsive-table">
                        <table>
                            <!-- <thead>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Topic</th>
                                <th>Author</th>
                                
                                <th>Published</th>
                            </thead> -->
                            <tbody>
                                <tr>
                                <?php
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
                    
                    // Query the database to fetch posts
                    $sql = "SELECT id, title, topic, published, username FROM programs";
                    $result = $conn->query($sql);
                    
                    // Check if there are results
                    if ($result->num_rows > 0) {
                        // Output the data in a table
                        echo '<table>';
                        echo '<thead><th>ID</th><th>Title</th><div class="td-action-links">
                        

                        
                       
                        
                    </div><th>Topic</th><th>Published</th><th>Username</th><th>Update</th><th>Delete</th><th>Publish</th></thead>';
                        echo '<tbody>';
                    
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['title'] . '</td>';
                            echo '<td><a href="#" target="_blank">' . $row['topic'] . '</a></td>';
                           
                            echo '<td>' . ($row['published'] == 1 ? 'Published' : 'Not Published') . '</td>';
                            echo '<td>' . $row['username'] . '</td>';

                            echo "<td><a href='showupdatePrograms.php?id=" . $row["id"] . "' class='edit'>Update</a></td>";
                            echo "<td><a href='deletePrograms.php?id=" . $row["id"] . "' class='delete'>Delete</a></td>";
                            echo "<td><a href='publishPrograms.php?id=". $row["id"] . "' class='publish'>Publish</a></td>";

                            echo '</tr>';
                        }
                    
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo 'No posts found.';
                    }
                    
                    // Close the database connection
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

    <script>
        // Featured Post
        const changeFeaturedPostBtn = document.querySelector('.change-featured-post');
        const inputWrapper = document.querySelector('.input-wrapper');
        const titleWrapper = document.querySelector('.title-wrapper');

        changeFeaturedPostBtn.addEventListener('click', function () {
            inputWrapper.classList.toggle('hide');
            titleWrapper.classList.toggle('hide');
        });
    </script>
</body>

</html>