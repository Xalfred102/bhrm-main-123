<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php
    if (!empty($_SESSION['uname'])) {
        $uname = $_SESSION['uname'];
        $query = "SELECT * FROM users WHERE uname = '$uname'";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result);
    }
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
    }

    .navbar {
        background-color: #343a40 !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .navbar-brand img {
        width: 80px;
        height: 80px;
    }

    .nav-links {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #ffc107;
    }

    .button {
        color: white;
        background-color: #ffc107;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #e0a800;
    }

    .profile-dropdown {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .profile-dropdown span {
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }

    .profile-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Dropdown Content */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        min-width: 150px;
        top: 60px;
        right: 0;
        border-radius: 5px;
        z-index: 10; /* Make sure it's above other elements */
    }

    /* Show Dropdown on Hover */
    .profile-dropdown:hover .dropdown-content {
        display: block;
    }

    /* To ensure the dropdown doesn't hide when interacting with it */
    .dropdown-content:hover {
        display: block;
    }
    .dropdown-content a {
        color: black;
        padding: 10px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    /* Hamburger Menu */
    .hamburger {
        display: none;
        font-size: 24px;
        color: white;
        cursor: pointer;
    }

    .nav-links-mobile {
        display: none;
        flex-direction: column;
        gap: 10px;
        background-color: #343a40;
        padding: 10px 20px;
        position: absolute;
        top: 60px;
        left: 0;
        width: 100%;
        z-index: 10;
    }

    .nav-links-mobile .nav-link {
        text-align: left;
    }

    .show-nav {
        display: flex !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .hamburger {
            display: block;
        }

        .nav-links-mobile {
            display: none;
        }

        .nav-links-mobile.show-nav {
            display: block;
            top: 100%;
        }
    }
</style>

<nav class="navbar">
    <a class="navbar-brand" href="#">
        <img src="images/0.png" alt="Logo">
    </a>
    <div class="nav-links">
        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
        <a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About</a>
        <a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
        <?php if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'admin'): ?>
            <a class="nav-link" href="php/bhapplications.php"><i class="fas fa-folder"></i> Applications</a>
        <?php endif; ?>
        <?php if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'landlord'): ?>
            <a class="nav-link" href="reservation.php"><i class="fas fa-calendar-check"></i> Reservations</a>
        <?php endif; ?>
        <?php if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'user'): ?>
            <a class="nav-link" href="reservation.php"><i class="fas fa-calendar"></i> My Reservations</a>
        <?php endif; ?>
    </div>
    <div class="login">
        <?php if (empty($_SESSION['uname'])): ?>
            <a class="button" href="php/login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
        <?php else: ?>
            <div class="profile-dropdown">
                <span>Welcome, <?php echo $fetch['fname']; ?></span>
                <img src="<?php echo $fetch['image']; ?>" alt="Profile Image" class="profile-img">
                <div class="dropdown-content">
                    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                    <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                    <a href="php/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="hamburger" onclick="toggleNav()">
        <i class="fas fa-bars"></i>
    </div>
    <div class="nav-links-mobile">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link" href="about.php">About</a>
        <a class="nav-link" href="contact.php">Contact</a>
        <?php if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'admin'): ?>
            <a class="nav-link" href="php/bhapplications.php"><i class="fas fa-folder"></i> Applications</a>
        <?php endif; ?>
        <?php if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'landlord'): ?>
            <a class="nav-link" href="reservation.php"><i class="fas fa-calendar-check"></i> Reservations</a>
        <?php endif; ?>
        <?php if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'user'): ?>
            <a class="nav-link" href="reservation.php"><i class="fas fa-calendar"></i> My Reservations</a>
        <?php endif; ?>
    </div>
</nav>

<script>
    function toggleNav() {
        const mobileNav = document.querySelector('.nav-links-mobile');
        mobileNav.classList.toggle('show-nav');
    }

    // Close dropdown if clicking outside
    document.addEventListener('click', (e) => {
        const dropdown = document.querySelector('.dropdown-content');
        const profileDropdown = document.querySelector('.profile-dropdown');
        if (dropdown && !profileDropdown.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });

    // Toggle dropdown on click for better mobile/desktop interaction
    document.querySelector('.profile-dropdown').addEventListener('click', (e) => {
        const dropdown = document.querySelector('.dropdown-content');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

        // Prevent click from propagating and closing the dropdown
        e.stopPropagation();
    });
</script>

</body>
</html>
