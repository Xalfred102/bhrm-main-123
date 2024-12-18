<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <?php
    // Assuming you have already set $_SESSION['uname'] when the user logs in.
        if(!empty($_SESSION['uname'])){
            $uname = $_SESSION['uname'];

            $query = "select * from users where uname = '$uname'";
            $result = mysqli_query($conn, $query);
            $fetch = mysqli_fetch_assoc($result);

        } // Fallback to 'Guest' if session is not set

        $query = "SELECT COUNT(*) AS new_application FROM bhapplication WHERE status = 'Pending'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $newReservations = $row['new_application'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin-left: 250px; /* Default sidebar width */
            transition: margin-left 0.3s ease;
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

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar .nav-link {
            color: white;
            display: flex;
            align-items: center;
            font-size: 16px;
            padding: 10px 15px;
            gap: 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link i {
            font-size: 20px;
        }

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

        /* Hide text in mobile view */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            body {
                margin-left: 70px;
            }

            .sidebar .nav-link span {
                display: none;
            }

            .sidebar .nav-link i {
                margin: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar bg-dark">
        <div class="navbar-brand text-center">
            <img src="/bhrm-main/images/0.png" alt="Logo" width="60" class="mb-3 rounded-circle">
        </div>
        <ul class="nav flex-column">
            <!-- User Info -->
            <li class="nav-item text-center mb-4">
                <img class="rounded-circle mb-2" src="/bhrm-main/<?php echo $fetch['image'] ?? 'default.png'; ?>" alt="Profile" width="60" height="60">
                <span class="d-block text-white">Welcome <?php echo $fetch['fname'] ?? 'Guest'; ?></span>
            </li>
            <!-- Navigation Links -->
            <li class="nav-item">
                <a class="nav-link" href="/bhrm-main/dashboardadmin.php">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/bhrm-main/manageboardinghouse.php">
                    <i class="bi bi-house-door"></i>
                    <span>Manage Boarding House</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="applicationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-envelope"></i>
                    <span>Applications</span>
                    <span class="badge bg-warning text-dark"><?php echo $newReservations; ?></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="applicationsDropdown">
                    <li><a class="dropdown-item" href="/bhrm-main/applicationpending.php">Pending Applications</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/applicationapproved.php">Approved Applications</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/applicationrejected.php">Rejected Applications</a></li>
                </ul>
            </li>
           <!-- Reports Dropdown Menu -->
            <!-- Reports Dropdown Menu -->
            <li class="nav-item dropdown mt-3">
                <a class="nav-link text-white dropdown-toggle" href="#" id="reportsMenu" role="button">
                    <i class="bi bi-graph-up"></i>
                    <span>Reports</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reportsMenu">
                    <li><a class="dropdown-item" href="/bhrm-main/reportsboardinghouse.php">Boarding House</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/reportslandlord.php">Landlords</a></li>
                </ul>
            </li>

            <!-- Account Dropdown Menu -->
            <li class="nav-item dropdown mt-3">
                <a class="nav-link text-white dropdown-toggle" href="#" id="accountMenu" role="button">
                    <i class="bi bi-person-circle"></i>
                    <span>Account</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="accountMenu">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                    <li><a class="dropdown-item" href="/bhrm-main/php/logout.php">Logout</a></li>
                </ul>
            </li>

        </ul>
    </nav>

    

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle Reports dropdown
            const reportsDropdownToggle = document.getElementById('reportsMenu');
            const reportsDropdownMenu = reportsDropdownToggle.nextElementSibling; // Find the next <ul> element

            // Toggle visibility for Reports dropdown
            reportsDropdownToggle.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default behavior
                reportsDropdownMenu.classList.toggle('show'); // Toggle visibility
            });

            // Handle Account dropdown
            const accountDropdownToggle = document.getElementById('accountMenu');
            const accountDropdownMenu = accountDropdownToggle.nextElementSibling; // Find the next <ul> element

            // Toggle visibility for Account dropdown
            accountDropdownToggle.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default behavior
                accountDropdownMenu.classList.toggle('show'); // Toggle visibility
            });

            // Close dropdowns if clicked outside
            document.addEventListener('click', function (event) {
                if (!reportsDropdownToggle.contains(event.target) && !reportsDropdownMenu.contains(event.target)) {
                    reportsDropdownMenu.classList.remove('show'); // Hide Reports dropdown
                }
                if (!accountDropdownToggle.contains(event.target) && !accountDropdownMenu.contains(event.target)) {
                    accountDropdownMenu.classList.remove('show'); // Hide Account dropdown
                }
            });
        });
    </script>
     
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
