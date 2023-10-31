<?php
session_start();

if (isset($_GET['topic'])) {
    $selectedTopic = $_GET['topic'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "blogingwebsite_internship";

    // Perform a database query to retrieve data based on the selected topic
    // Example code for a MySQL database using PDO:
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM posts WHERE topic = :selectedTopic";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':selectedTopic', $selectedTopic, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['body']) . "</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Topic parameter is required.";
}
?>
