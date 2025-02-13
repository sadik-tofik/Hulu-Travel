<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $placename = $_POST['placename'];
    $numberofguests = $_POST['numberofguests'];
    $arrivaldate = $_POST['arrivaldate'];
    $leavingdate = $_POST['leavingdate'];

  
    if (empty($placename) || empty($numberofguests) || empty($arrivaldate) || empty($leavingdate)) {
        $error_message = "Please fill out all fields.";
    } else {
      
        $host = "localhost";
        $dbname = "hulutravel";
        $username = "root";
        $password = "";

        $conn = mysqli_connect($host, $username, $password, $dbname);
        if (mysqli_connect_errno()) {
            die("Connection error: " . mysqli_connect_error());
        }

       
        $sql = "INSERT INTO bookingdetails (placename, numberofguests, arrivaldate, leavingdate)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "siss", $placename, $numberofguests, $arrivaldate, $leavingdate);
        mysqli_stmt_execute($stmt);

        
        $success_message = "Booking successful!";
    }
}
?>
 <?php
session_start();
$_SESSION['message'] = ""; 
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
</head>
<body>
    <header>
        <div id="menu-bar" class="fas fa-bars"></div>
        <img src="assets/logo.jpg" alt="holo-logo" class="logo-img">
        <h1 class="hulutravel">
            <span>H</span>
            <span>U</span>
            <span>L</span>
            <span>U</span>
            <span class="space"></span>
            <span>T</span> 
            <span>R</span>
            <span>A</span>
            <span>V</span> 
            <span>E</span>
            <span>L</span>
        </h1>

        <nav class="navbar">
            <a href="index.html">Home</a>
            <a href="book.php">Book</a>
            <a href="packages.html">Packages</a>
            <a href="services.html">Services</a>
            <a href="gallery.html">Gallery</a>           
            <a href="contact.php">Contact</a>
            <!-- <a href="viewbook.php">view bookings</a> -->
        </nav>

     
    </header>
     
    <section class="book" id="book">
        <h1 class="heading">
            <span>b</span>
            <span>o</span>
            <span>o</span>
            <span>k</span>
            <span class="space"></span>
            <span>n</span> 
            <span>o</span>
            <span>w</span>
        </h1>

        <div class="row">
            <div class="image">
                <img src="assets/1.jpg" alt="">
            </div>
            
            <form action="" method="POST">
                <div class="inputBox">
                    <h3>Where to</h3>
                    <input type="text" placeholder="Place name" name="placename" required>
                </div>
                <div class="inputBox">
                    <h3>How many</h3>
                    <input type="number" placeholder="Number of guests" name="numberofguests" required>
                </div>
                <div class="inputBox">
                    <h3>Arrivals</h3>
                    <input type="date" name="arrivaldate" required>
                </div>
                <div class="inputBox">
                    <h3>Leaving</h3>
                    <input type="date" name="leavingdate" required>
                </div>
                <input type="submit" id="btn" class="btn" value="Book Now">
            </form>


            <p><?php echo $_SESSION['message']; ?></p>
            <?php
            
            
               if (isset($success_message)) {
                echo "<p style='font-size:25px; color: green; text-align: center;'>$success_message</p>";
            } elseif (isset($error_message)) {
                echo "<p style='font-size:25px; color: red; text-align: center;'>$error_message</p>";
            }
            
            ?>


        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
// Clear the message on page load
 // Display success or error messages
   <!-- <div class="icons">
            <i class="fas fa-search" id="search-btn"></i>
            <i class="fas fa-user" id="login-btn"></i>
        </div> -->
<!-- 
        <form action="" class="search-bar-container">
            <input type="search" name="" id="search-bar" placeholder="search here... ">
            <label for="search-bar" class="fas fa-search"></label>
        </form> -->


