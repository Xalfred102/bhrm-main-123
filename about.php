<?php
require 'php/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            color: white;
            font-family: 'Arial', sans-serif;
        }

        /* Animated Gradient Background */
        .animated-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, #343a40, #aeb5bb, #343a40, #ffffff);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            z-index: -1;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Navbar */
        .navbar {
            background-color: rgba(0, 0, 0, 0.7) !important;
        }

        .navbar-brand img {
            width: 60px;
            height: 60px;
        }

        .nav-link {
            color: #fff !important;
        }

        /* Content Section */
        .container {
            margin-top: 150px;
        }

        h1, h2, p {
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 2rem;
            margin-top: 30px;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Responsive Card Section */
        .content {
            margin-top: 50px;
        }

        .card {
            border-radius: 15px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
        }

        .card img {
            border-radius: 15px 15px 0 0;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="animated-background"></div>

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- About Us Section -->
    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to our platform! We're committed to providing the best boarding house services for you.</p>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img src="images/download.png" alt="Our Story">
                    <div class="card-body">
                        <h2>Our Story</h2>
                        <p>We started this platform to bridge the gap between landlords and tenants, ensuring everyone
                            finds their ideal living space with ease and comfort.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="images/0.png" alt="Our Mission">
                    <div class="card-body">
                        <h2>Our Mission</h2>
                        <p>Our mission is to revolutionize the rental experience by connecting people to quality
                            boarding houses and fostering a community of trust and reliability.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
