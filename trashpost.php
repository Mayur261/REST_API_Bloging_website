<?php
// Include your database connection code here

// Assuming you have a database connection, you can fetch data from your posts table
// Replace the following with your actual database credentials
$servername = "localhost";
$db_username = "root";
$db_password = "";
$database = "blogingwebsite_internship";
// Create a connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the database to fetch posts  
//$sql = "SELECT id, author, title, topic, views, published FROM posts";
$sql = "SELECT id, title, topic, published ,username FROM posts";
$result = $conn->query($sql);

// Check if there are results    
// id
// title
//        body
// topic
// published
// username
// created_at
if ($result->num_rows > 0) {
    // Output the data in a table
    echo '<table>';
    echo '<thead><th>id</th><th>Title</th><th>Topic</th><th>published</th><th>username</th></thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['title'] . '</td>';
        echo '<td><a href="#" target="_blank">' . $row['topic'] . '</a></td>';
        echo '<td>' . $row['published'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        //echo '<td><a href="#">' . $row['published'] . '</a></td>';
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
