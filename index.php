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

$automationTopics = array(); // Initialize an array to store topics for Automation
$developmentTopics = array(); // Initialize an array to store topics for Development
$projectsTopics = array(); // Initialize an array to store topics for Projects
$programsTopics = array(); // Initialize an array to store topics for Programs

// Use prepared statements to protect against SQL injection
$sqlAutomation = "SELECT topic FROM topic WHERE Category = 'Automation'";
$stmtAutomation = $conn->prepare($sqlAutomation);
if ($stmtAutomation->execute()) {
    $resultAutomation = $stmtAutomation->get_result();
    while ($row = $resultAutomation->fetch_assoc()) {
        $automationTopics[] = $row['topic'];
    }
}

$sqlDevelopment = "SELECT topic FROM topic WHERE Category = 'Development'";
$stmtDevelopment = $conn->prepare($sqlDevelopment);
if ($stmtDevelopment->execute()) {
    $resultDevelopment = $stmtDevelopment->get_result();
    while ($row = $resultDevelopment->fetch_assoc()) {
        $developmentTopics[] = $row['topic'];
    }
}

$sqlProjects = "SELECT topic FROM topic WHERE Category = 'Projects'";
$stmtProjects = $conn->prepare($sqlProjects);
if ($stmtProjects->execute()) {
    $resultProjects = $stmtProjects->get_result();
    while ($row = $resultProjects->fetch_assoc()) {
        $projectsTopics[] = $row['topic'];
    }
}

$sqlPrograms = "SELECT topic FROM topic WHERE Category = 'Programs'";
$stmtPrograms = $conn->prepare($sqlPrograms);
if ($stmtPrograms->execute()) {
    $resultPrograms = $stmtPrograms->get_result();
    while ($row = $resultPrograms->fetch_assoc()) {
        $programsTopics[] = $row['topic'];
    }
}

$stmtAutomation->close();
$stmtDevelopment->close();
$stmtProjects->close();
$stmtPrograms->close();
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

// Define an array to store category names and their respective data
$categories = [
    'posts' => [],
    'development' => [],
    'programs' => [],
    'projets' => [],
];

// Fetch data for each category
foreach ($categories as $category => &$categoryData) {
    $sql = "SELECT * FROM $category"; // Assuming the table names match the categories

    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categoryData[] = $row;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asterisc Projects</title>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Bootstrap Documentation Template For Software Developers"
    />
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media" />
    <link rel="shortcut icon" href="favicon.ico" />
    <script src="https://unpkg.com/lodash@4.17.20"></script>

    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap"
      rel="stylesheet"
    />

    <!-- FontAwesome JS-->
    <script defer src="assets/fontawesome/js/all.min.js"></script>

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/theme.css" />
  </head>

  <body>
    <nav
      class="navbar navbar-expand-lg text-center navbar-light sticky-top bg-light"
    >
      <div class="container-fluid">
        <a class="navbar-brand ps-5" href="index.html">
          <img
            src="astx.png"
            alt=""
            width="200"
            height="75"
            class="img-fluid d-inline-block align-text-top"
          />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://milius.vercel.app/aboutus">About Us</a>
            </li>

            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="automationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Automation
        </a>
        <ul class="dropdown-menu text-center" aria-labelledby="automationDropdown">
        <?php
session_start();
// Replace "your_database_name" with your actual database name
$_SESSION['posts'] = "posts";

foreach ($automationTopics as $topic) {
    $url = "test.php?topic=" . urlencode($topic);
    echo '<li><a class="dropdown-item" href="' . $url . '">' . htmlspecialchars($topic) . '</a></li>';
}
?>
        </ul>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="developmentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Development
        </a>
        <ul class="dropdown-menu text-center" aria-labelledby="developmentDropdown">
          <?php
          foreach ($developmentTopics as $topic) {
              $url = "category.php?topic=" . urlencode($topic);
              echo '<li><a class="dropdown-item" href="' . $url . '">' . htmlspecialchars($topic) . '</a></li>';
          }
          ?>
        </ul>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Projects
        </a>
        <ul class="dropdown-menu text-center" aria-labelledby="projectsDropdown">
          <?php
          foreach ($projectsTopics as $topic) {
              $url = "category.php?topic=" . urlencode($topic);
              echo '<li><a class="dropdown-item" href="' . $url . '">' . htmlspecialchars($topic) . '</a></li>';
          }
          ?>
        </ul>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="programsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Programs
        </a>
        <ul class="dropdown-menu text-center" aria-labelledby="programsDropdown">
          <?php
          foreach ($programsTopics as $topic) {
              $url = "category.php?topic=" . urlencode($topic);
              echo '<li><a class="dropdown-item" href="' . $url . '">' . htmlspecialchars($topic) . '</a></li>';
          }
          ?>
        </ul>
      </li>


          </ul>
          <form class="d-flex">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
          <form action="login.html"class="d-flex">
            
            <button class="btn btn-outline-success" type="submit">
              Login
            </button>
          </form>
        </div>
      </div>
    </nav>

    <div class="page-header theme-bg-dark py-5 text-center position-relative">
      <div class="theme-bg-shapes-right"></div>
      <div class="theme-bg-shapes-left"></div>
      <div class="container">
        <h1 class="page-heading single-col-max mx-auto">Astersic Coding Projects</h1>
        <div class="page-intro single-col-max mx-auto">Find Projects.</div>
        <div class="main-search-box pt-3 d-block mx-auto">
          <form class="search-form w-100">
            <input
              type="text"
              placeholder="Search the docs..."
              name="search"
              class="form-control search-input"
            />
            <button type="submit" class="btn search-btn" value="Search">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
    <!--//page-header-->
    <div class="page-content">
    <div class="container">
    <div class="row justify-content-center">
        <?php foreach ($categories as $category => $categoryData): ?>
        <?php foreach ($categoryData as $item): ?>
        <div class="col-12 col-lg-4 py-3">
        <div class="card shadow-sm" style="height: 100%;">
                <div class="card-body" style="height: 100%;">
                    <h5 class="card-title mb-3">
                        <span class="card-title-text"><?php echo $item['title']; ?></span>
                    </h5>
                    <div class="card-text">
                        <?php echo $item['body']; ?>
                    </div>
                    <!-- <a class="card-link-mask" href="<?php echo $item['link']; ?>"></a> -->
                    <!-- <a class="card-link-mask" href="<?php echo $item['link']; ?>"></a> -->
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>
      <!--//container-->
    </div>
    <!--//page-content-->

    <!-- <section
      class="cta-section text-center py-5 theme-bg-dark position-relative"
    >
      <div class="theme-bg-shapes-right"></div>
      <div class="theme-bg-shapes-left"></div>
      <div class="container">
        <h3 class="mb-2 text-white mb-3">
          Launch Your Software Project Like A Pro
        </h3>
        <div class="section-intro text-white mb-3 single-col-max mx-auto">
          Want to launch your software project and start getting traction from
          your target users? Check out our premium
          <a
            class="text-white"
            href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/"
            >Bootstrap 5 startup template CoderPro</a
          >! It has everything you need to promote your product.
        </div>
        <div class="pt-3 text-center">
          <a
            class="btn btn-light"
            href="https://themes.3rdwavemedia.com/bootstrap-templates/startup/coderpro-bootstrap-5-startup-template-for-software-projects/"
            >Get CoderPro<i class="fas fa-arrow-alt-circle-right ml-2"></i
          ></a>
        </div>
      </div>
    </section> -->
    <!--//cta-section-->

    <div class="container rounded-top">
      <footer
        class="text-center text-lg-start bg-white text-muted rounded-top border"
      >
        <!-- Section: Social media -->
        <section
          class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
        >
          <!-- Left -->
          <div class="me-5 d-none d-lg-block">
            <span>Get connected with us on social networks:</span>
          </div>
          <!-- Left -->

          <!-- Right -->
          <div>
            <a href="" class="me-4 link-secondary">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 link-secondary">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="me-4 link-secondary">
              <i class="fab fa-google"></i>
            </a>
            <a href="" class="me-4 link-secondary">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 link-secondary">
              <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="me-4 link-secondary">
              <i class="fab fa-github"></i>
            </a>
          </div>
          <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
          <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
              <!-- Grid column -->
              <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold mb-4">
                  <i class="text-secondary"></i>Asterisc Technocrat Pvt. Ltd.
                </h6>
                <p>
                  Asterisc Computer Institute is a premier IT education
                  Institute . The institute provides a wide variety of
                  professional career, short term and certification courses,
                  designed by our experts. Our trainers constantly update their
                  technical skills to maintain their expertise.All the courses
                  are taught by certified and experienced faculty. Asterisc
                  computer institute ventured in certification lead IT training
                  ,we have produced highly successful IT professionals working
                  with best IT companies across the globe. Students get placed
                  because of their hardwork and our support and we get business
                  because our students know it better than the most.
                </p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 mx-auto mb-4 text-center">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4 text-center">
                  WORKING HOURS
                </h6>

                <table class="table">
                  <tbody>
                    <tr>
                      <th scope="row">Monday</th>
                      <td>10AM - 8PM</td>
                    </tr>
                    <tr>
                      <th scope="row">Tuesday</th>
                      <td>10AM - 8PM</td>
                    </tr>
                    <tr>
                      <th scope="row">Wednesday</th>
                      <td colspan="2">10AM - 8PM</td>
                    </tr>
                    <tr>
                      <th scope="row">Thursday</th>
                      <td colspan="2">10AM - 8PM</td>
                    </tr>
                    <tr>
                      <th scope="row">Friday</th>
                      <td colspan="2">10AM - 8PM</td>
                    </tr>
                    <tr>
                      <th scope="row">Saturday</th>
                      <td colspan="2">10AM - 8PM</td>
                    </tr>
                    <tr>
                      <th scope="row">Sunday</th>
                      <td colspan="2">Closed</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->

              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                <p>
                  <i class="fas fa-home me-3 text-secondary"></i> Janaee
                  Plaza,2nd Floor, Bhande Plot Chowk, Raghuji Nagar, Nagpur,
                  Maharashtra 440009
                </p>
                <p>
                  <i class="fas fa-envelope me-3 text-secondary"></i>
                  info@asterisc.in
                </p>
                <p>
                  <i class="fas fa-phone me-3 text-secondary"></i> +91 77448
                  22228
                </p>
              </div>
              <!-- Grid column -->
            </div>
            <!-- Grid row -->
          </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div
          class="text-center p-4 rounded-top bg-transparent"
          style="background-color: rgba(0, 0, 0, 0.025)"
        >
          Copyright © 2021 Asterisc.in Developed by
          <a
            class="text-reset fw-bold bg-transparent"
            href="https://mdbootstrap.com/"
            >Asterisc Technocrat Pvt. Ltd.</a
          >
        </div>
        <!-- Copyright -->
      </footer>
    </div>

    <!-- Javascript -->
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Page Specific JS -->
    <script src="assets/plugins/smoothscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js"></script>
    <script src="assets/js/highlight-custom.js"></script>
    <script src="assets/plugins/simplelightbox/simple-lightbox.min.js"></script>
    <script src="assets/plugins/gumshoe/gumshoe.polyfills.min.js"></script>
    <script src="assets/js/docs.js"></script>
  </body>
</html>
