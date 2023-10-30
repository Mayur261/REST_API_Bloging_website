<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://celionatti.github.io/blog-template/assets/css/admin-style.css">
    <title>Admin Posts Trash | New Blog Template 2023</title>
</head>

<body>
<?php include 'header.php'; ?>

    <div class="page-wrapper">
    <?php include 'sidebar.php'; ?>

        <div class="page-content">
            <div class="admin-container">
                <div class="admin-table lg-box">
                    <h1 class="center">Posts Trash</h1>
                    <hr>

                    <div class="table-actions">
                        <span></span>
                        <a href="index.html" class="btn primary-btn small-btn">
                            <ion-icon name="settings-outline" class="icon"></ion-icon>
                            Manage Post
                        </a>
                    </div>

                    <div class="responsive-table">
                        <table>
                            <thead> 
                                <th>S/N</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Topic</th>
                                <th>Views</th>
                                <th>Published</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Celio Natti</td>
                                    <td><a href="#" target="_blank">
                                            This is the sample title for the first post</a>
                                        <div class="td-action-links">
                                            <a href="#" class="trash">Delete</a>
                                            <span class="inline-divider">|</span>
                                            <a href="#" class="edit">Restore</a>
                                        </div>
                                    </td>
                                    <td>Self-help</td>
                                    <td>1000</td>
                                    <td><a href="#">Publish</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Amisu Usman</td>
                                    <td><a href="#" target="_blank">
                                            This is the sample title for the second post</a>
                                        <div class="td-action-links">
                                            <a href="#" class="trash">Delete</a>
                                            <span class="inline-divider"></span>
                                            <a href="#" class="edit">Restore</a>
                                        </div>
                                    </td>
                                    <td>Self-help</td>
                                    <td>3000</td>
                                    <td><a href="#">Unpublished</a></td>
                                </tr>
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