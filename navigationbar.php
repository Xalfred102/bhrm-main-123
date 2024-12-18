<?php 

require 'php/connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION['role'] == 'landlord') {
    echo '';
} else {
    header('location: index.php');
}

?>

<?php
    // Assuming you have already set $_SESSION['uname'] when the user logs in.
        if(!empty($_SESSION['uname'])){
            $uname = $_SESSION['uname'];

            $query = "select * from users where uname = '$uname'";
            $result = mysqli_query($conn, $query);
            $fetch = mysqli_fetch_assoc($result);

        } // Fallback to 'Guest' if session is not set


        // Get the landlord's email (the logged-in user)
        
        $hname = $_SESSION['hname'];

        // Query to count new reservations
        $query = "SELECT COUNT(*) AS new_reservations FROM reservation WHERE hname = '$hname' AND res_stat = 'Pending'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $newReservations = $row['new_reservations'];

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- FontAwesome Icons -->
    <style>
        body {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            background-color: white;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            padding: 20px 15px;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar .navbar-brand img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            color: white;
            display: block;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #ffc107;
            color: white;
        }

        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }

        .dropdown-menu a {
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .dropdown-menu a:hover {
            background-color: #495057;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                margin-bottom: 20px;
            }

            body {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar bg-dark">
        <div class="navbar-brand text-center">
            <img src="/bhrm-main/images/0.png" alt="Logo">
        </div>
        <ul class="nav flex-column">
            <!-- User Info -->
            <li class="nav-item text-center mb-4">
                <img class="rounded-circle mb-2" src="/bhrm-main/<?php echo $fetch['image'] ?? 'default.png'; ?>" alt="Profile" width="60" height="60">
                <span class="d-block text-white">Welcome <?php echo $fetch['fname'] ?? 'Guest'; ?></span>
            </li>
            <!-- Navigation Links -->
            <li class="nav-item">
                <a class="nav-link" href="/bhrm-main/dashboard.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/bhrm-main/manageroom.php">
                    <i class="fas fa-bed"></i> Manage Rooms
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="reservationMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-calendar-check"></i> Reservations <span class="badge bg-warning text-dark"><?php echo $newReservations; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reservationMenu">
                    <li><a class="dropdown-item" href="/bhrm-main/pending.php">Pending <span class="badge bg-warning text-dark"><?php echo $newReservations; ?></span></a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/approved.php">Approved</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/ended.php">Ended</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/rejected.php">Rejected</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/cancelled.php">Cancelled</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/bhrm-main/payment.php">
                    <i class="fas fa-credit-card"></i> Payments
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="reservationMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-calendar-check"></i> Reports
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reservationMenu">
                    <li><a class="dropdown-item" href="/bhrm-main/reportsrooms.php">Rooms</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/reportspayments.php">Income</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/reportsreservation.php">Reservation</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/reportstenant.php">Tenants</a></li>
                </ul>
            </li>
            <!-- Dropdown Menu -->
            <li class="nav-item dropdown mt-3">
                <a class="nav-link text-white dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user"></i> Account
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="userMenu">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/php/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
