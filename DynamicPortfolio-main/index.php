<?php
// Database connection file (db_connection.php)
$servername = "localhost:3302";
$username = "root";
$password = "";
$dbname = "port2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch all data from the database
function fetchAllData()
{
    global $conn;

    $data = array();

    // Fetch navbar data
    $data['navbarData'] = fetchData('navbar_table');

    // Fetch home data
    $data['homeData'] = fetchData('home_section');

    // Fetch services data
    $data['servicesData'] = fetchData('services_table');

    // Fetch projects data
    $data['projectsData'] = fetchData('projects_table');

    // Fetch education data
    $data['educationData'] = fetchData('education_table');

    // Fetch social icons data
    $data['socialIconsData'] = fetchData('social_icons');

    // Fetch footer links data
    $data['footerLinksData'] = fetchData('footer_links');

    return $data;
}

// Function to fetch data from the database
function fetchData($tableName)
{
    global $conn;
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

// Function to insert a message into the database
function insertMessage($fullName, $email, $phoneNumber, $subject, $message)
{
    global $conn;

    $sql = "INSERT INTO contact_messages (full_name, email, phone_number, subject, message) 
            VALUES ('$fullName', '$email', '$phoneNumber', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FS</title>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <header class="header">
        <a href="admin_logout.php" class="logo">Fariha<span>Sanzana</span></a>
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <?php
            $navbarData = fetchData('navbar_table'); // Replace 'navbar_table' with your actual table name

            foreach ($navbarData as $item) {
            ?>
                <a href="<?php echo $item['link']; ?>" <?php echo ($item['is_active'] == 1) ? 'class="active"' : ''; ?>>
                    <?php echo $item['title']; ?>
                </a>
            <?php
            }
            ?>
        </nav>
    </header>

    <section class="home" id="home">
        <?php
        $homeData = fetchData('home_section'); // 

        foreach ($homeData as $item) {
        ?>
            <div class="home-img">
                <img src="<?php echo $item['image_url']; ?>" alt="Profile Picture">
            </div>

            <div class="home-content">
                <h1>Hi, It's<span><?php echo $item['name']; ?></span></h1>
                <h3 class="text-animation">I am a <span><?php echo $item['role']; ?></span></h3>
                <p><?php echo $item['description']; ?></p>

                <div class="social-icons">
                    <?php
                    $socialIconsData = fetchData('social_icons'); // Replace 'social_icons' with your actual table name

                    foreach ($socialIconsData as $icon) {
                    ?>
                        <a href="<?php echo $icon['link']; ?>"><i class='bx <?php echo $icon['icon_class']; ?>'></i></a>
                    <?php
                    }
                    ?>
                </div>
                <a href="#" class="btn"><?php echo $item['cta_button_text']; ?></a>
            </div>
        <?php
        }
        ?>
    </section>

    <section class="services" id="services">
        <h2 class="heading">Services</h2>
        <div class="service-container">
            <?php
            $servicesData = fetchData('services_table'); // 

            foreach ($servicesData as $service) {
            ?>
                <div class="services-box">
                    <i class='bx <?php echo $service['icon']; ?>'></i>
                    <h3><?php echo $service['title']; ?></h3>
                    <p><?php echo $service['description']; ?></p>
                    <a href="#" class="btn">Learn More</a>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <section class="project" id="projects">
        <h2 class="heading">Projects</h2>
        <div class="projects-container">
            <?php
            $projectsData = fetchData('projects_table'); // Replace 'projects_table' with your actual table name

            foreach ($projectsData as $project) {
            ?>
                <div class="projects-box">
                    <img src="<?php echo $project['image_url']; ?>" alt="Project icon">
                    <div class="project-info">
                        <h4><?php echo $project['title']; ?></h4>
                        <p><?php echo $project['description']; ?><br>
                            <a href="<?php echo $project['github_link']; ?>">GitHub Link</a>
                        </p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <section class="timeline-section" id="education">
        <h2 class="heading">Education</h2>
        <div class="timeline-items">
            <?php
            $educationData = fetchData('education_table'); // Replace 'education_table' with your actual table name

            foreach ($educationData as $educationItem) {
            ?>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date"><?php echo $educationItem['year']; ?></div>
                    <div class="timeline-content">
                        <h3><?php echo $educationItem['degree']; ?></h3>
                        <p><?php echo $educationItem['description']; ?><br>
                            <a href="<?php echo $educationItem['institution_link']; ?>"><?php echo $educationItem['institution']; ?></a>
                        </p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <!-- Contact Me Section -->
    <section class="contact" id="contact">
        <h2 class="heading">Contact<span> Me</span></h2>

        <form action="#" method="post">
            <div class="input-box">
                <input type="text" name="full_name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="tel" name="phone_number" placeholder="Phone number" required>
                <input type="text" name="subject" placeholder="Subject" required>
            </div>
            <textarea name="message" cols="30" rows="10" placeholder="Your Message" required></textarea>
            <input type="submit" name="submit_message" value="Send Message" class="btn">
        </form>

        <?php
        // Process form submission
        if (isset($_POST['submit_message'])) {
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phone_number'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            if (insertMessage($fullName, $email, $phoneNumber, $subject, $message)) {
                echo '<p class="success-message">Message sent successfully!</p>';
            } else {
                echo '<p class="error-message">Error: Unable to send the message. Please try again later.</p>';
            }
        }
        ?>
    </section>

    <footer class="footer">
        <div class="social">
            <?php
            $socialIconsData = fetchData('social_icons'); // Replace 'social_icons' with your actual table name

            foreach ($socialIconsData as $icon) {
            ?>
                <a href="<?php echo $icon['link']; ?>"><i class='bx <?php echo $icon['icon_class']; ?>'></i></a>
            <?php
            }
            ?>
        </div>
        <ul class="list">
            <?php
            $footerLinksData = fetchData('footer_links'); // Replace 'footer_links' with your actual table name

            foreach ($footerLinksData as $link) {
            ?>
                <li>
                    <a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                </li>
            <?php
            }
            ?>
        </ul>
    </footer>

    <script src="script.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>