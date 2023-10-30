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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statements to protect against SQL injection
    $sql = "SELECT title, body, topic, image FROM programs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "i" represents an integer, adjust the type if needed

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $editor = $row['body'];
            $topic = $row['topic'];
            $image = $row['image'];
        } else {
            echo "No post found with the given ID.";
            exit();
        }
    } else {
        echo "Error executing the query: " . $stmt->error;
        exit();
    }

    $stmt->close();
} else {
    echo "Invalid request.";
    $conn->close();
    exit();
}

$conn->close();
?>

<?php


// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "blogingwebsite_internship";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$topics = array(); // Initialize an array to store topics

// Check if the user is logged in and a session variable 'username' is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Use prepared statements to protect against SQL injection
    $sql = "SELECT topic FROM topic WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // "s" represents a string

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $topics[] = $row['topic'];
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
    <script src="https://cdn.ckeditor.com/4.17.0/standard/ckeditor.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/admin-style.css">
    <title>Admin Create Post | New Blog Template 2023</title>
</head>

<body>
<?php include 'header.php'; ?>

    <div class="page-wrapper">
    <?php include 'sidebar.php'; ?>

        <!-- ==== PAGE CONTENT ==== -->
        <div class="page-content">
            <div class="admin-container">
                <form action="updatePrograms.php" method="post" class="admin-form md-box" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <h1 class="center form-title">Update Post</h1>

                    <div class="input-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="<?php echo $title; ?>" class="input-control">
                    </div>
                    <div class="input-group">
                        <label for="editor">Body</label>
                        <textarea name="editor" id="editor"><?php echo $editor; ?></textarea>
                    </div>
                    <div class="post-details">
                    <div class="select-topic-wrapper">
    <div class="input-group">
        <label for="topic">Topic</label>
        <select name="topic" id="topic" class="input-control">
            <option value=""></option>
            <?php
            foreach ($topics as $topic) {
                echo "<option value='" . $topic . "'>" . $topic . "</option>";
            }
            ?>
        </select>
    </div>
</div>
                        <!-- <option value="<?php echo $topic; ?>"><?php echo $topic; ?></option> -->
                        <div class="image-wrapper">
                            <input type="file" name="image" class="hide image-input">
                            <button type="button" class="image-btn bg-image">
                                <span class="choose-image-label">
                                    <ion-icon name="image_outline" class="image-outline"></ion-icon>
                                    <span>Choose Image</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="published">
                            <input type="checkbox" name="published" id="published">
                            Publish
                        </label>
                    </div>

                    <div class="input-group">
                        <button type="submit" class="btn primary-btn big-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="https://celionatti.github.io/blog-template/assets/js/admin.js"></script>
    <!-- <script src="https://celionatti.github.io/blog-template/assets/js/post_quill_editor.js"></script> -->
    <!-- <script src="../../assets/js/post_quill_editor.js"></script> -->

    <script>



CKEDITOR.replace('editor');


        // PREVIEW POST IMAGE
        const imageBtn = document.querySelector('.image-btn');
        const imageInput = document.querySelector('.image-input');
        const chooseImageLabel = document.querySelector('.choose-image-label');

        imageBtn.addEventListener('click', function () {
            imageInput.click();
        });

        imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imageBtn.style.backgroundImage = `url(${e.target.result})`;
                    imageBtn.style.height = '150px';
                    imageBtn.style.border = 'none';
                    chooseImageLabel.classList.toggle('hide');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>