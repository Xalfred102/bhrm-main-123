<?php
include 'php/connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION["role"] == 'landlord') {
    echo '';
}else{
    header('location: ./index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h2 {
            color: #495057;
            font-weight: 700;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-title {
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
            font-weight: 600; /* Slightly bold text for emphasis */
            color: #495057;
        }

        .card .btn {
            font-size: 0.85rem;
        }

        .badge {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <style>
        nav {
            background-color: #343a40;
            padding: 5px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .navbar-brand img {
            width: 80px;
            height: 80px;
        }

        nav .nav-links {
            display: flex;
            gap: 20px;
        }

        nav .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        nav .login a {
            background-color: #ffc107;
            padding: 10px 15px;
            border-radius: 25px;
            color: white;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        nav .login a:hover {
            background-color: #d68918;
        }
    </style>
    <nav>
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="Logo">
        </a>
        <div class="nav-links">
            <a href="/bhrm-main/php/bhfunction.php">Home</a>
            <a href="/bhrm-main/about.php">About Us</a>
            <a href="/bhrm-main/contact.php">Contact</a>
            <a href="/bhrm-main/bhapplication.php">My Applications</a>
            </div>
                <div class="login">
            <?php
                if (!empty($_SESSION['uname'])) {
                    echo '<a href="/bhrm-main/php/logout.php" class="logout">Logout</a>';
                } else {
                    echo '<a href="/bhrm-main/php/login.php">Login</a>';
                }
            ?>

        </div>
    </nav>

    <div class="container my-5">
        <!-- Pending Section -->
        <div class="row gy-4">
            <?php 
            $uname = $_SESSION['uname'];
            $query = "SELECT DISTINCT bhapplication.hname, bhapplication.*, documents.*, description.* 
                      FROM bhapplication 
                      INNER JOIN documents ON bhapplication.hname = documents.hname
                      INNER JOIN description ON bhapplication.hname = description.hname 
                      WHERE bhapplication.status = 'PENDING' and bhapplication.owner = '$uname'
                      ORDER BY bhapplication.id DESC";
            $result = mysqli_query($conn, $query);
            while ($fetch = mysqli_fetch_assoc($result)): 
            ?>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="<?php echo $fetch['image']; ?>" class="card-img-top" alt="Boarding House">
                        <div class="card-body">
                            <h5 class="card-title">Boarding House: <?php echo $fetch['hname']; ?></h5>
                            <p class="card-text"><strong>Address:</strong> <?php echo $fetch['haddress']; ?></p>
                            <p class="card-text"><strong>Description:</strong> <?php echo $fetch['bh_description']; ?></p>
                            <p class="card-text"><strong>Documents:</strong></p>
                            <img src="<?php echo $fetch['documents']; ?>" class="card-img-top" alt="Boarding House">
                            <span class="badge bg-warning text-dark">Pending</span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
