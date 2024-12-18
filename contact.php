<?php
require 'php/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General Styles */
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

        /* Contact Us Section */
        .container {
            margin-top: 150px;
        }

        h1, p {
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 40px;
        }

        /* Contact Form Styles */
        .contact-form {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5);
            animation: fadeIn 2s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group label {
            font-weight: bold;
            color: #ffcc00;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px rgba(255, 204, 0, 0.8);
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .btn-warning {
            background-color: #ffcc00;
            border: none;
            color: #333;
            padding: 10px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #ffdd33;
            color: #000;
            box-shadow: 0 8px 15px rgba(255, 204, 0, 0.8);
            transform: translateY(-3px);
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="animated-background"></div>

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Contact Us Section -->
    <div class="container">
        <h1>Contact Us</h1>
        <p>If you have any questions, feel free to reach out to us by filling out the form below.</p>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-form">
                    <form action="php/contact.php" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning btn-block">Send Message</button>
                    </form>
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
