<?php 
require 'php/connection.php';

if(!empty($_SESSION["uname"]) && $_SESSION["role"] == 'landlord'){
    $uname = $_SESSION['uname'];
    $query = "select * from boardinghouses inner join documents on boardinghouses.hname = documents.hname where boardinghouses.owner = '$uname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);   
}elseif(!empty($_SESSION["uname"]) && $_SESSION["role"] == 'user'){
    if (isset($_GET['hname'])){
        $_SESSION['hname'] = $_GET['hname'];
        $hname = $_SESSION['hname'];
        $query = "select * from boardinghouses inner join documents on boardinghouses.hname = documents.hname where boardinghouses.hname = '$hname'";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result); 
    }
}else{
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Custom CSS */
        body {
            background-color: #fff; /* Background color */
        }
        .nav-link {
            color: #fff !important;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
        .card-img-container {
            width: 200px; /* Adjust as needed */
            height: 200px; /* Adjust as needed */
            overflow: hidden;
            margin: 0 auto; /* Center the image horizontally */
        }
        .card-img-container img {
            width: 100%; /* Make the image fill its container */
            height: 100%; /* Make the image fill its container */
            object-fit: cover; /* Cover the container without distortion */
        }
        .image-box {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .text-box {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .text-box {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .card {
            background-color: #a9a9a9; /* Change background color to #a9a9a9 */
            color: #fff; /* Text color */
            border-radius: 20px; /* Rounded corners */
            padding: 20px; /* Padding */
            margin-bottom: 20px; /* Bottom margin */
        }

        .card-body {
            padding: 10px; /* Padding */
        }


        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
            font-family: Arial, sans-serif;
        }

        .footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .footer .row {
            display: flex;
            justify-content: space-between;
        }

        .footer-col {
            width: 30%;
        }

        .footer-col h4 {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .footer-col ul {
            list-style-type: none;
            padding-left: 0;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-col ul li a:hover {
            color: #ffc107;
        }

        .footer-col .social-links a {
            color: white;
            margin-right: 10px;
            font-size: 15px;
            transition: color 0.3s ease;
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }
        .footer-col .social-links a:first-child {
            margin-top: 0px;
        }

        .footer-col .social-links a:hover {
            color: #ffc107;
        }

        .footer-bottom-text {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }

    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" width="80" height="80" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php  
                    if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION['role'] == 'landlord'){
                        echo '<li class="nav-item"><a class="nav-link" href="reservation.php">View Reservation</a></li>';
                        echo '<li class="nav-item"><a class="btn btn-warning" href="php/logout.php">Logout</a></li>';
                    }if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION['role'] == 'user'){
                        echo '<li class="nav-item"><a class="nav-link" href="reservation.php?">View Reservation</a></li>';
                        echo '<a class="btn btn-warning" href="index.php">Back</a>';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>

<section class="container mt-5">
<div class="row">
    <div class="col-md-6">
        <div class="image-box">
            <img src="<?php echo $fetch['image']?>" class="img-fluid" >
        </div>
    </div>
    <div class="col-md-6">
        <div class="text-box">
            <h1>Welcome to <?php echo $_SESSION['hname']?></h1>
            <p>Introducing <?php echo $_SESSION['hname']?>: The Epitome of Comfort and Convenience in Maranding, Lala, Lanao del Norte</p>
            <p>Located in the serene town of Maranding, Lala, Lanao del Norte, Aziannas Place stands as the premier boarding house, offering an unparalleled living experience for students and professionals alike.</p>
            <p>At Aziannas Place, we understand the importance of a comfortable and conducive living environment. Our spacious and well-appointed rooms provide a haven for relaxation and productivity. Each room is thoughtfully designed with modern furnishings, ensuring a cozy and inviting atmosphere.</p>
        </div>
    </div>
</div>


    <div class="row mt-5">
   
        <div class="col">
            <h2>Rooms</h2>
            <?php 
                if(!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION["role"] == "landlord"){
                    echo "<div class='addroom' style='margin-bottom: 20px;'><a href='php/addroom.php'><button class='btn btn-warning'>Add Rooms</button></a></div>"; 
                }
            ?>

            <form method="get" action="boardinghouse.php">
                <!-- Retain hname in the form -->
                <input type="hidden" name="hname" value="<?php echo isset($_GET['hname']) ? $_GET['hname'] : $_SESSION['hname']; ?>">
                <select name="room_type" onchange="this.form.submit()">
                    <option value="">All Rooms</option>
                    <option value="Single Room" <?php if (isset($_GET['room_type']) && $_GET['room_type'] == 'Single Room') echo 'selected'; ?>>Single Room</option>
                    <option value="Double Room" <?php if (isset($_GET['room_type']) && $_GET['room_type'] == 'Double Room') echo 'selected'; ?>>Double Room</option>
                    <!-- Add other room types as needed -->
                </select>

                <select name="availability" onchange="this.form.submit()">
                    <option value="">All Availability</option>
                    <option value="Available" <?php if (isset($_GET['availability']) && $_GET['availability'] == 'Available') echo 'selected'; ?>>Available</option>
                    <option value="Occupied" <?php if (isset($_GET['availability']) && $_GET['availability'] == 'Occupied') echo 'selected'; ?>>Occupied</option>
                    <option value="Under Maintenance" <?php if (isset($_GET['availability']) && $_GET['availability'] == 'Under Maintenance') echo 'selected'; ?>>Under Maintenance</option>
                </select>
            </form>
            <br>
            <br>

            <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php 
            if (!empty($_SESSION["uname"]) && $_SESSION['role'] == 'landlord'){
                if (isset($_GET['hname'])) {
                        $_SESSION['hname'] = $_GET['hname'];
                    }

                    $hname = isset($_SESSION['hname']) ? $_SESSION['hname'] : '';

                    if ($hname != '') {
                        // Prepare query with room type and availability filtering
                        $room_type = isset($_GET['room_type']) ? $_GET['room_type'] : '';
                        $availability = isset($_GET['availability']) ? $_GET['availability'] : '';

                        $query = "SELECT * FROM rooms WHERE hname = '$hname'";

                        // Filter by room type if selected
                        if (!empty($room_type)) {
                            $query .= " AND room_type = '$room_type'";
                        }

                        // Filter by availability if selected
                        if (!empty($availability)) {
                            $query .= " AND status = '$availability'";
                        }

                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {  // Check if there are any results
                            while ($fetch = mysqli_fetch_assoc($result)) {
                                $id = $fetch['id'];
                                $hname = $fetch['hname'];
                                $status = $fetch['status'];
                                $datein = $fetch['datein'];
                                $roomno = $fetch['room_no'];
                        ?>
                            <div class="col">
                                <div class="card">
                                    <div class="card-img-container">
                                        <img src="<?php echo $fetch['image']?>" class="card-img-top" alt="Room Image">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Room No: <?php echo $fetch['room_no']?></h5>
                                        <p class="card-text">Room Type: <?php echo $fetch['room_type']?></p>
                                        <p class="card-text">Capacity: <?php echo $fetch['capacity']?></p>
                                        <p class="card-text">Price: <?php echo $fetch['price']?></p>
                                        <p class="card-text">Amenities: <?php echo $fetch['amenities']?></p>
                                        <p class="card-text">Status: <?php echo $fetch['status']?></p>
                                        <?php if(!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION["role"] == "landlord"): ?>
                                            <a href='php/addroom.php?rupdate=<?php echo $id;?>' class='btn btn-warning'>Update</a>
                                            <a href='php/function.php?rdelete=<?php echo $id;?>' class='btn btn-danger'>Delete</a>
                                        <?php else: ?>
                                            <?php if ($status == 'available'){ ?>
                                                <a href='book-in.php?roomno=<?php echo $roomno;?>' class='btn btn-warning'>Book Now!</a>
                                            <?php } ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                                    }
                                }
                            }
                        } 
                        ?>

            <?php 
                if (!empty($_SESSION) && $_SESSION['role'] == 'user'){
                    if (isset($_GET['hname'])) {
                        $_SESSION['hname'] = $_GET['hname'];
                    }

                    $hname = isset($_SESSION['hname']) ? $_SESSION['hname'] : '';

                    if ($hname != '') {
                        // Prepare query with room type and availability filtering
                        $room_type = isset($_GET['room_type']) ? $_GET['room_type'] : '';
                        $availability = isset($_GET['availability']) ? $_GET['availability'] : '';

                        $query = "SELECT * FROM rooms WHERE hname = '$hname'";

                        // Filter by room type if selected
                        if (!empty($room_type)) {
                            $query .= " AND room_type = '$room_type'";
                        }

                        // Filter by availability if selected
                        if (!empty($availability)) {
                            $query .= " AND status = '$availability'";
                        }

                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {  // Check if there are any results
                            while ($fetch = mysqli_fetch_assoc($result)) {
                                $id = $fetch['id'];
                                $hname = $fetch['hname'];
                                $status = $fetch['status'];
                                $datein = $fetch['datein'];
                                $roomno = $fetch['room_no'];
                        ?>
                            <div class="col">
                                <div class="card">
                                    <div class="card-img-container">
                                        <img src="<?php echo $fetch['image']?>" class="card-img-top" alt="Room Image">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Room No: <?php echo $fetch['room_no']?></h5>
                                        <p class="card-text">Room Type: <?php echo $fetch['room_type']?></p>
                                        <p class="card-text">Price: <?php echo $fetch['price']?></p>
                                        <p class="card-text">Amenities: <?php echo $fetch['amenities']?></p>
                                        <p class="card-text">Status: <?php echo $fetch['status']?></p>
                                        <?php if(!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION["role"] == "landlord"): ?>
                                            <a href='php/addroom.php?rupdate=<?php echo $id;?>' class='btn btn-warning'>Update</a>
                                            <a href='php/function.php?rdelete=<?php echo $id;?>' class='btn btn-danger'>Delete</a>
                                        <?php else: ?>
                                            <?php if ($status == 'available'){ ?>
                                                <a href='book-in.php?roomno=<?php echo $roomno;?>' class='btn btn-warning'>Book Now!</a>
                                            <?php } ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php 
                                    }
                                }
                            }
                        } 
                        ?>
            </div>
        </div>
       
    </div>

<div class="row mt-5">
    <div class="col">
        <div class="text-box">
            <p> <?php if (!empty($_SESSION['hname']) && $_SESSION['role'] == 'landlord'){
                $uname = $_SESSION['uname'];
                $query = "select * from boardinghouses where owner = '$uname'";
                $result = mysqli_query($conn, $query);
                $fetch = mysqli_fetch_assoc($result);   
                } elseif (!empty($_SESSION) && $_SESSION['role'] == 'user'){
                    isset($_GET['hname']);
                    $hname = $_GET['hname'];
                    $query = "SELECT * FROM boardinghouses where hname = '$hname'";
                    $result = mysqli_query($conn, $query);
                    $fetch = mysqli_fetch_assoc($result);   
                    } echo $fetch['hname'];
                ?>: Serving Maranding with Excellence for 3 Years</p>
            <p>For the past three years, <?php echo $fetch['hname']?> has been a trusted and reliable provider of exceptional boarding services in the beautiful town of Maranding, Lala, Lanao del Norte. Since our establishment, we have been committed to delivering an unmatched living experience to our residents.</p>
            <p>Throughout these years, <?php echo $fetch['hname']?> has become a beloved and integral part of the Maranding community. We have built strong relationships with our residents, creating a warm and welcoming atmosphere that feels like home. Our dedication to customer satisfaction has earned us a stellar reputation as the go-to boarding house in the area.</p>
        </div>
    </div>
</div>
</section>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-col">
                        <h4>About Us</h4>
                        <ul>
                            <li><a href="#">Company Info</a></li>
                            <li><a href="#">Our Team</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Follow Us</h4>
                        <div class="social-links">
                            <a href="#">Facebook<i class="fab fa-facebook-f"></i></a>
                            <a href="#">Twitter<i class="fab fa-twitter"></i></a>
                            <a href="#">Instagram<i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <p class="footer-bottom-text">© 2024 Your Company Name. All Rights Reserved.</p>
            </div>
        </footer>
<!-- Bootstrap JS (optional, for some components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
