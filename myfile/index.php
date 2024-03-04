<!DOCTYPE html>


<?php
    $conn = mysqli_connect('localhost:3302', 'root', '', 'port');
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
?>




<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sowndhar</title>
    <link rel="icon" href="https://i.ibb.co/zRsTj3p/Frame-1-37.png">


    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" class="stylesheet">
</head> 

<body>

    <!-------------------------- Header Area -------------------------->
    <header class="header-area">
        <div class="container">
            <div class="header">
               
                <a href="" class="logo">
                    <img src="files/signaturecropped.png" alt="" class="signature">
                    <i class="fa fa-bolt"></i>
                </a>
                   
                <ul class="navbar">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#education">Education</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                
                <div class="menu_icon">
                    <i class="fa fa-bars"></i>
                </div>

            </div>
        </div> 
    </header>
 
    <!-------------------------- Home Page -------------------------->
    <div class="FirstElement" id="home">
        <div class="profile-photo">
            <img src="image/img2.jpg" alt="profile picture">
        </div>
        <div class="profile-text">
            <h2>Hi I'm </h2><br>
            <h1>Fariha Sanzana</h1><br>
            <p>Welcome to my portfolio website! I'm a passionate and aspiring software engineer with a strong desire to create innovative solutions and push the boundaries of technology.With a deep love for coding and problem-solving, I am constantly seeking opportunities to learn and grow in this ever-evolving field</p>
            
            <div class="btn-group">
                <a href="files/SowndharResume.pdf" class="btn   active">Download CV</a>
                <a href="mailto:sowndharnewbie@gmail.com" class="btn">Contact</a>
            </div>

            <div class="social">
                <a href="mailto:sowndharnewbie@gmail.com"><i class='bx bxl-instagram'></i></a>
                <a href="https://github.com/sowndharnewbie"><i class="fa-brands fa-github"></i></a>
                <a href="https://leetcode.com/sowndharnewbie/"><i class='bx bxl-facebook'></i></a>
                <a href="https://www.linkedin.com/in/sowndhar/"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>
    </div>

        <!-------------------------- About Section -------------------------->
    <section class="about-area" id="about">
        <div class="container">
            <div class="about">
                
                <div class="about-content">
                    <h4>About Me</h4>
                    <ul>
                      <li>I am currently pursuing my final year Bachelor's Degree in Electronics and Communication Engineering.I have built a solid foundation in software development, particularly in areas such as Java, SQL, Git, and GitHub.</li>
                      <li> My expertise in these areas allows me to approach projects with confidence and deliver high-quality results.I have a strong belief in the value of continuous learning and staying adaptable in the ever-evolving world of software engineering.</li>
                      <li> I actively seek out opportunities to expand my knowledge and skills, embracing new technologies and approaches.Feel free to explore my work and get in touch if you have any questions or opportunities to collaborate. </li>
                    </ul>
                </div>
                                  
                <div class="about-skills">
                    <ul>
                        <li>Name:Fariha</li>
                        <li>Age:20</li>     
                        <li>From:Bangladesh</li>
                        <li>Email:sanzanafariha526@gmail.com</li>
                        <li>Availabiltiy:Fulltime</li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </section>


        <!-------------- Education & Internship -------------->
    <section class="education-content" id="education">
        <div class="container">
            <div class="row">
                <div class="education ">
                    <h3 class="title">Education</h3>
                    <div class="row">
                        <div class="timeline-box">
                            <div class="timeline">

                                <!-- Timeline-item -->
                                <!-- <div class="timeline-item">
                                    <div class="circle-dot"></div>
                                    <h3 class="timeline-title">
                                        B.E ECE-86%
                                    </h3>
                                    <h4 class="timeline-title">KPR Institute of Engineering and Technology</h4>
                                    <h4 class="timeline-title">
                                        <i class="fa fa-calendar"></i> 2020-2024
                                    </h4>
                                </div>  -->
                                <!-- Timeline-item -->
                                <?php
    $select = "SELECT * FROM education";
    $result = mysqli_query($conn, $select);
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="timeline-item">
                <div class="circle-dot"></div>
                <h4 class="timeline-title">
                    <i class="fa fa-calendar"></i> '.$row['time'].'
                </h4>
                <h5 class="timeline-title">'.$row['degree'].'</h5>
                <h4 class="timeline-title">'.$row['ins'].'</h4>
                <h5 class="timeline-title">'.$row['details'].'</h5>
                
            </div>';
        }
    }
?>
 </div>
                
                         
    </section>


        <!-------------------------- Projects -------------------------->




       
    






        <section class="project-content" id="projects">
        <div class="container">
        <div class="project-title">

        <h4>My Projects</h4>
                <p>Discover my projects, where creativity meets innovation</p>
                </div>
                
            <?php
                
                $select = "SELECT * FROM pro";
                $result = mysqli_query($conn, $select);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="project-card">
                        <img src="image/'.$row['photo'].'" alt="" class="project-img">
                        <div class="project-details">
                            <h3 >'.$row['title'].'</h3>
                            <p >'.$row['description'].'</p>
                            <a href="'.$row['link'].'" class="project-link">GitHub <i class="fa-solid fa-square-arrow-up-right"></i></a>
                        </div>
                    </div>';
                    }
                }
            ?>
            </div>

            </div>
            </div>
        </section>





















        <?php


if(isset($_POST['submit'])) {
    $name = $_POST["n"];
    $email = $_POST["e"];
    $number = $_POST["num"];
    $sub = $_POST["sub"];
    $mes = $_POST["mes"];

    // Validate Telephone Number (must be numeric and 11 characters)
    if (!is_numeric($number) || strlen($number) !== 11) {
        echo "<script>
        var confirmPhoneNumber = confirm('You have given an invalid phone number. Would you like to try again?');
        if(confirmPhoneNumber) {
            window.location.href = 'contact2.php';
        } else {
            window.location.href = 'portlast.php';
        }
      </script>";
exit();
    } 

        
        else {
            // Insert data into the database
            $sql = "INSERT INTO contact(`name`, `email`, `num`, `sub`, `mes`) 
                    VALUES ('$name','$email','$number','$sub','$mes')";

            $result = mysqli_query($conn, $sql);

            if($result) {
                echo "<div class='alert'>Data inserted successfully!!</div>";
                header('Location: portlast.php');
            } else {
                die(mysqli_error($conn));
            }
        }
    }

?>






<!--     
<form method="post">
  <div >
    <label for="exampleInputEmail1" class="form-label">Name: </label>
    <input type="text"  name="n"class="form-control" id="exampleInputEmail1" >
    
  <div >
    <label for="exampleInputPassword1" class="form-label">Email: </label>
    <input type="email"  name="e" class="form-control" id="exampleInputPassword1">
  </div>
  <div >
    <label for="exampleInputPassword1" class="form-label">Telephone Number: </label>
    <input type="text" name="num" class="form-control" id="exampleInputPassword1">
  </div>
  <div >
    <label for="exampleInputPassword1" class="form-label">Subject: </label>
    <input type="text" name="sub" class="form-control" id="exampleInputPassword1">
  </div>

  <div >
    <label for="exampleInputPassword1" class="form-label">Messege: </label>
    <input type="text" name="mes" class="form-control" id="exampleInputPassword1">
  </div>
 
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form> -->






   
        <!-------------------------- Contact Me -------------------------->

    <section class="contact-content" id="contact">
        <div class="container">
            <div class="contact-title">
                <h4>Contact Me</h4>
                <p>Get In Touch</p>
            </div>
            <div class="contact">
            <form method="post">
                    <input type="text" name="n" placeholder="Name" required>
                    <input type="email" name="e" placeholder="Email" required>
                    <input type="tel" name="num" placeholder="Subject">
                    <input type="text" name="SUBJECT" placeholder="Subject">
                    <textarea name="nes" placeholder="Message"></textarea>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
                <span id="msg"></span>
            </div>
        </div>
    </section>






    
        
    <!-- ------------------------ JS -------------------------->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="nn.js"></script>
    <script src="script.js"></script>
    
    <!-------------------------- Footer section ------------------------ -->
   <footer class="footer">
    <small class="message">Thanks for visiting </small>
    
   </footer>

</body>
</html>