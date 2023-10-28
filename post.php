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
    <title>Admin Posts | New Blog Template 2023</title>
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
                        <?php echo $userProfileName; ?>
                        <ion-icon name="chevron-down-outline" class="nav-icon"></ion-icon>
                    </a>
                    <ul class="dropdown">
                        <li><a href="logout.php">Logout</a></li>
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
                <div class="admin-table lg-box">
                    <h1 class="center">Posts</h1>
                    <hr>

                    <!-- <div class="message success">
                        <ion-icon name="checkmark-circle" class="message-icon"></ion-icon>
                        <span>This is a sample message...!</span>
                    </div> -->

                    <!-- <form action="" class="featured-post-form">
                        <strong>Featured Post: </strong>
                        <span class="title-wrapper">
                            <span>This is a sample post title</span>
                            <button type="button" class="change-featured-post">Change</button>
                        </span>
                        <span class="input-wrapper hide">
                            <input type="text" name="title" class="input-control input-control-sm"
                                placeholder="Enter post title">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </span>
                    </form> -->

                    <div class="table-actions">
                        <div class="table-filter-group">
                            <input type="search" name="search-term" id="search-post-input" placeholder="Search...">
                            <select name="filter-post" id="filter-post">
                                <option value="all">---Filter---</option>
                                <option value="all">All</option>
                                <option value="oldest">Oldest</option>
                                <option value="newest">Newest</option>
                                <option value="popular">Popular</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="table-buttons">
                            <a href="trashpost.php" class="btn warning-btn small-btn">
                                <ion-icon name="trash-outline" class="icon"></ion-icon>
                                Trash
                            </a>
                            <a href="createpost.php" class="btn primary-btn small-btn">
                                <ion-icon name="add-circle-outline" class="icon"></ion-icon>
                                Add Post
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
                    $sql = "SELECT id, title, topic, published, username FROM posts";
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
                            echo '<td>' . $row['published'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';

                            echo "<td><a href='showupdatepost.php?id=" . $row["id"] . "' class='edit'>Update</a></td>";
                            echo "<td><a href='delete.php?id=" . $row["id"] . "' class='delete'>Delete</a></td>";
                            echo "<td><a href='publish.php?id=". $row["id"] . "' class='publish'>Publish</a></td>";

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