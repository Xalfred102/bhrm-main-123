<?php

require 'php/connection.php';
if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"] == 'user')) {
    unset($_SESSION['hname']);
}


if (!empty($_SESSION["uname"]) && $_SESSION["role"] == 'landlord') {
    header('location: boardinghouse.php');
}

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    $uname = $_SESSION["uname"];
    $role = $_SESSION["role"];
    $result = mysqli_query($conn, "select * from users where uname = '$uname'");
    $fetch = mysqli_fetch_assoc($result);
    
    if (isset($_SESSION['login_message_displayed'])) {
        echo "
        <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: 'Logged in Successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        // Unset the session variable to prevent repeated notifications
        unset($_SESSION['login_message_displayed']);
    }
}


if (isset($_SESSION['login_warning']) && $_SESSION['login_warning'] == true) {
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'Please log in to proceed further.',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        });
    </script>";
    unset($_SESSION['login_warning']); // Clear the session variable after use
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #c5c5c5; /* White background */
            color: #343a40; /* Dark text color */
            margin: 0;
            overflow-x: hidden; /* Prevent horizontal scrolling only */
        }

        /* Animated Background */
        @keyframes gradientAnimation {
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

        .background {
            background: linear-gradient(45deg, #343a40, #aeb5bb, #343a40, #ffffff);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            min-height: 100vh;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
            padding-bottom: 80px; /* Ensure footer space */
        }

                /* Content Background */
        .content-background {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: auto;
            margin-top: 100px;
            
        /*  margin-top: 100px; Adds space around the content */
            max-width: 1100px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
        }

        .card-content h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card-content p {
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        /* General Button Styles */
        .button {
            background-color: #ffc107; /* Default color for buttons */
            color: white; /* Text color */
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease; /* Ensure smooth transitions */
        }
        a.button {
            text-decoration: none; /* Removes the underline */
        }

        a.button:hover {
            text-decoration: none; /* Ensures no underline on hover */
        }


        .button:hover {
            background-color: #e0a800; /* Slightly darker yellow */
            color: white; /* Text color remains white */
        }

        /* Specific styles for Delete button */
        .button.delete {
            background-color: #dc3545; /* Default red for delete button */
            color: white; /* Ensure text is white */
        }

        .button.delete:hover {
            background-color: #c82333; /* Darker red on hover */
            color: white; /* Text color remains white */
        }

        /* Specific styles for Update button */
        .button.update {
            background-color: #28a745; /* Default green for update button */
            color: white; /* Ensure text is white */
        }

        .button.update:hover {
            background-color: #218838; /* Darker green on hover */
            color: white; /* Text color remains white */
        }

        .section {
            padding: 40px 20px;
            background-color: #343a40;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            color: white;
            margin-bottom: 20px;
        }

        .section p, .section ol {
            color: white;
        }

        .icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #e0a800;
            color: white;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .icon-box {
            text-align: center;
        }

        .feature-list li {
            margin-bottom: 10px;
        }

        .feature-list strong {
            color: #e0a800;
        }

        .highlight {
            background-color: #343a40;
            padding: 20px;
            border-radius: 8px;
        }


        /* Footer */
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        
        }

        .footer a {
            color: #ffc107;
        }

        .footer a:hover {
            color: white;
        }


    </style>
</head>

<body>
    <div class="background">
        <?php include 'navbar.php'; ?>

        <div class="content-background">

            <div class="text-center py-4">
                <h1>Welcome to Maranding Boarding House Center</h1>
                <p>Discover the best boarding houses around Maranding. Choose your preferred place and enjoy your stay.</p>
            </div>

            <!-- Cards Section -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                $query = "SELECT * FROM boardinghouses INNER JOIN documents ON boardinghouses.hname = documents.hname";
                $result = mysqli_query($conn, $query);
                while ($fetch = mysqli_fetch_assoc($result)) :
                    $hname = $fetch['hname'];
                ?>
                    <div class="col">
                        <div class="card">
                            <img src="<?php echo $fetch['image']; ?>" alt="Boarding House">
                            <div class="card-content">
                                <h5><?php echo $fetch['hname']; ?></h5>
                                <p><strong>Owner:</strong> <?php echo $fetch['landlord']; ?></p>
                                <p><strong>Address:</strong> <?php echo $fetch['haddress']; ?></p>
                                <p><strong>Contact:</strong> <?php echo $fetch['contact_no']; ?></p>
                                <div>
                                    <?php if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'admin') : ?>
                                        <a href="php/function.php?edit=<?php echo $fetch['id']; ?>" class="button update">Update</a>
                                        <a href="#" class="button delete" data-href="php/function.php?delete=<?php echo $fetch['id']; ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</a>
                                    <?php else : ?>
                                        <a href="boardinghouse.php?hname=<?php echo $hname; ?>" class="button details">More Details</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <!-- Reservation Section -->
        <section id="reservation-easy" class="section mb-5">
            <h2 class="display-6 text-center">Reservation Made Easy</h2>
            <p class="text-center">At <strong>Maranding Boarding House Center</strong>, reserving a room has never been easier! Browse boarding houses, check availability, and book a room that suits your needs—all in just a few clicks.</p>
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="icon-circle">
                        <i class="bi bi-search"></i>
                    </div>
                    <h5>Explore</h5>
                    <p>Find a variety of boarding houses tailored to your needs.</p>
                </div>
                <div class="col-md-4">
                    <div class="icon-circle">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h5>Reserve</h5>
                    <p>Quickly reserve your room with just a few clicks.</p>
                </div>
                <div class="col-md-4">
                    <div class="icon-circle">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h5>Confirm</h5>
                    <p>Receive instant confirmation for stress-free booking.</p>
                </div>
            </div>
        </section>

        <!-- What is Boarding House Section -->
        <section id="what-is-boarding-house" class="section mb-5 highlight">
            <h2 class="display-6">What is a Boarding House?</h2>
            <p>A boarding house offers rooms for rent with shared facilities like bathrooms and kitchens. It's an affordable option for students, workers, and travelers looking for temporary accommodation.</p>
        </section>

        <!-- How Reservation Works Section -->
        <section id="how-it-works" class="section mb-5">
            <h2 class="display-6">How Reservation Works</h2>
            <ol class="feature-list fs-5">
                <li><strong>Browse Boarding Houses:</strong> Explore available options with various amenities.</li>
                <li><strong>Check Availability:</strong> Find rooms for your desired dates.</li>
                <li><strong>Make a Reservation:</strong> Submit your booking details with ease.</li>
                <li><strong>Receive Confirmation:</strong> Get instant approval for your stay.</li>
            </ol>
        </section>

        <!-- About Section -->
        <section id="about" class="section mb-5">
            <h2 class="display-6">About Us</h2>
            <p><strong>Maranding Boarding House Center</strong> is your trusted platform for finding the best boarding houses in Maranding. Whether you're a student, worker, or traveler, we make accommodation easy, accessible, and hassle-free.</p>
            <div class="row">
                <div class="col-md-6">
                    <img src="/bhrm-main/images/0.png" style="background-color: #343a40; border-radius: 20px;" class="img-fluid rounded" alt="Boarding House">
                </div>
                <div class="col-md-6">
                    <p>Our goal is to provide a seamless experience, from browsing to booking. Find your ideal room, enjoy transparent pricing, and experience convenience like never before!</p>
                </div>
            </div>
        </section>
    </div>

    <footer class="footer">
        <p>© 2024 Your Company Name. All Rights Reserved.</p>
        <p>
            <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
        </p>
    </footer>
</body> 

</html>
