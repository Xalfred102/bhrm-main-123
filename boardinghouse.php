<?php 
require 'php/connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"] == 'user')) {
    unset($_SESSION['roomno']);
}

if(!empty($_SESSION["uname"]) && $_SESSION["role"] == 'user'){
    if (isset($_GET['hname'])){
        $_SESSION['hname'] = $_GET['hname'];
        $hname = $_SESSION['hname'];
        $query = "select * from boardinghouses inner join documents on boardinghouses.hname = documents.hname where boardinghouses.hname = '$hname'";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result); 
        $img = $fetch['image'];
        echo "
        <script src='jquery.min.js'></script>
        <link rel='stylesheet' href='toastr.min.css'/>
        <script src='toastr.min.js'></script>
        <script>
            $(document).ready(function() {
                // Check if the login message should be displayed
                " . (isset($_SESSION['login_message_displayed']) ? "toastr.success('Logged in Successfully');" : "") . "
            });
        </script>
        ";

        // Unset the session variable to avoid repeated notifications
        if (isset($_SESSION['login_message_displayed'])) {
            unset($_SESSION['login_message_displayed']);
        }
    }
}else{
    $_GET['hname'];
    $hname = $_GET['hname'];
    $query = "select * from boardinghouses inner join documents on boardinghouses.hname = documents.hname where boardinghouses.hname = '$hname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result); 
}

?>

<?php
    if (isset($_SESSION['already_booked']) && $_SESSION['already_booked'] === true) {
        echo "
        <link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Warning!',
                    text: 'You have already booked a room.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        // Unset the session variable to prevent repeated alerts
        unset($_SESSION['already_booked']);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>

</head>
<!-- Bootstrap CSS -->
   
<body>
    <style>

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

    <?php include 'navbar.php'; ?>

    <style>
        .content-background{
            margin: 0px 250px;
        }

        @media (max-width: 1600px){
            .content-background {
                margin: 0px 100px;
            }
        }

        @media (max-width: 1000px){
            .content-background {
                margin: 0px 0px;
            }
        }

        @media (max-width: 768px){
            .content-background {
                margin: 0px 0px;
            }
        }
    </style>
    <div class="content-background">
            <style>
                 .back {
                    display: flex;
                    justify-content: flex-end; /* Aligns the back button to the left */
                    padding: 20px;
                    background-color: #f5f5f5; /* Light background for contrast */
                    border-bottom: 1px solid #ddd; /* Optional: separates the header visually */
                }

                .back .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #ffaa00; /* Primary blue color */
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    font-size: 16px;
                    font-weight: bold;
                    transition: background-color 0.3s ease, transform 0.2s ease;
                }

                .back .btn:hover {
                    background-color: #ffaa00; /* Darker blue on hover */
                    transform: scale(1.05); /* Slight zoom effect on hover */
                }

                .back .btn:active {
                    transform: scale(1); /* Reset zoom when clicked */
                }

                @media screen and (max-width: 768px) {
                    .back {
                        padding: 15px; /* Adjust padding for smaller screens */
                    }
                    .back .btn {
                        font-size: 14px; /* Slightly smaller text for smaller devices */
                        padding: 8px 16px; /* Adjust padding */
                    }
                }
            </style>
            <div class="back">
                <div>
                    <?php 
                        if(empty($_SESSION['uname'])){
                            echo '<a class="btn" href="index.php">Back</a>';
                        }else{
                            echo '<a class="btn" href="index.php">Back</a>';
                        }
                    ?>
                </div>     
            </div>


            <div class="section1">  
                <style>
                    .section1{
                        background-color: white;
                        height: auto;
                        font-weight: 20;
                        display: grid;
                        grid-template-columns: 1fr  1fr;
                        border-radius: 10px;
                        padding: 20px;
                        padding-top: 30px;
                    }

                    
                    .secrow1{
                        display: flex;
                        justify-content: center;
                        align-items: top;
                    }

                    .secrow1 img{
                        overflow: hidden;
                        width: 80%;
                        height: 100%;
                    }

                    .text-box {
                        background-color: #f9f9f9; /* Light background */
                        padding: 20px;            /* Adds space inside the box */
                        border-radius: 10px;       /* Rounded corners */
                        box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.1); /* Subtle shadow */       /* Adds space below the box */
                        font-family: Arial, sans-serif; /* Clean font */
                        color: #333;               /* Text color */
                    }

                    .text-box h1 {
                        color: #444;               /* Heading color */
                        margin-bottom: 15px;       /* Space below the heading */
                        text-align: center;
                    }

                    .text-box p {
                        line-height: 1.6;          /* Improve readability */
                    }

                    .secrow2 h1{
                        font-size: 50px;
                    }

                    .secrow2 p{
                        margin-top: 20px;
                        font-size: 20px;
                    }

                    @media (max-width: 768px){
                        .section1{
                            background-color: white;
                            height: auto;
                            font-weight: 20;
                            display: grid;
                            grid-template-columns: 1fr;
                            grid-template-rows: 1fr 1fr;
                            border-radius: 10px;
                            padding: 20px;
                            padding-top: 30px;
                        }
                    }

                </style>
                <div class="secrow1">
                    <?php if(!empty($_SESSION['uname'])): ?>
                    <img src="<?php echo $img ?>">
                    <?php else: ?>
                    <img src="<?php echo $fetch['image'] ?>">
                    <?php endif; ?>
                </div>
                <div class="secrow2">
                    <?php 
                    
                        $query = "SELECT * FROM `description` WHERE hname = '$hname'";
                        $result = mysqli_query($conn, $query);
                        $fetch = mysqli_fetch_assoc($result); 

                    ?>
                    <div class="text-box">
                        <h1>Welcome to <?php if(!empty($_SESSION['hname'])){ echo $_SESSION['hname']; }else {  echo $_GET['hname']; } ?></h1>
                        <p><?php echo $fetch['bh_description']; ?></p>
                    </div>
                </div>
            </div>

            <style>
                .section2{
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 10px 250px;
                }

                select {
                    padding: 8px 12px;
                    font-size: 16px;
                    color: #333;
                    border: 1px solid #007bff; /* Blue border */
                    border-radius: 5px;
                    background-color: white;
                    cursor: pointer;
                    outline: none;
                    transition: all 0.3s ease;
                    margin-right: 10px; /* Adds space between dropdowns */
                }

                select:hover {
                    border-color: #0056b3; /* Darker blue on hover */
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Adds subtle shadow */
                }

                select:focus {
                    border-color: #0056b3; /* Same as hover for consistency */
                    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Blue glow on focus */
                }

                option {
                    font-size: 16px; /* Consistent text size */
                    color: #333;
                    background-color: white;
                }

                /* Ensures consistent spacing between dropdowns and alignment within the form */
                .form select {
                    margin: 0 5px;
                }

                @media screen and (max-width: 768px) {
                    .section2{
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        align-items: center;
                        padding: 10px 30px;
                    }.section2 h1{
                        padding-bottom: 10px;
                    }
                }
            </style>
            
            <div class="section2">
                <div class="room-header">
                    <h1>Rooms</h1>
                </div>
                <div class="form">
                    <form method="get" action="">
                        <!-- Retain hname in the form -->
                        <input type="hidden" name="hname" value="<?php echo isset($_GET['hname']) ? $_GET['hname'] : $_SESSION['hname']; ?>">

                        <select name="availability" onchange="this.form.submit()">
                            <option value="">All Availability</option>
                            <option value="Available" <?php if (isset($_GET['availability']) && $_GET['availability'] == 'Available') echo 'selected'; ?>>Available</option>
                            <option value="Full" <?php if (isset($_GET['availability']) && $_GET['availability'] == 'Full') echo 'selected'; ?>>Full</option>
                            <option value="Under Maintenance" <?php if (isset($_GET['availability']) && $_GET['availability'] == 'Under Maintenance') echo 'selected'; ?>>Under Maintenance</option>
                        </select>

                        <select name="tenant_type" onchange="this.form.submit()">
                            <option value="">All Gender</option>
                            <option value="Male" <?php if (isset($_GET['tenant_type']) && $_GET['tenant_type'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if (isset($_GET['tenant_type']) && $_GET['tenant_type'] == 'Female') echo 'selected'; ?>>Female</option>
                        </select>
                    </form>
                </div>  
            </div>
            
            <div class="section3">                 
                <?php 
                if (!empty($_SESSION["uname"]) && $_SESSION['role'] == 'user' || empty($_SESSION["uname"])){
                    if (isset($_GET['hname'])) {
                        $_SESSION['hname'] = $_GET['hname'];
                    }

                    $hname = isset($_SESSION['hname']) ? $_SESSION['hname'] : '';

                    if ($hname != '') {
                        // Prepare query with room type and availability filtering
                        $room_type = isset($_GET['room_type']) ? $_GET['room_type'] : '';
                        $availability = isset($_GET['availability']) ? $_GET['availability'] : '';
                        $tenanttype = isset($_GET['tenant_type']) ? $_GET['tenant_type'] : '';

                        $query = "SELECT * FROM rooms WHERE hname = '$hname'";

                        // Filter by room type if selected
                        if (!empty($room_type)) {
                            $query .= " AND room_type = '$room_type'";
                        }

                        // Filter by availability if selected
                        if (!empty($availability)) {
                            $query .= " AND status = '$availability'";
                        }

                        if (!empty($tenanttype)) {
                            $query .= " AND tenant_type = '$tenanttype'";
                        }

                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {  // Check if there are any results
                            while ($fetch = mysqli_fetch_assoc($result)) {
                                $id = $fetch['id'];
                                $hname = $fetch['hname'];
                                $capacity = $fetch['capacity'];
                                $tenantcount = $fetch['current_tenant'];
                                $roomno = $fetch['room_no'];
                        ?>
                                <div class="card">
                                    <img src="<?php echo $fetch['image']?>" class="card-img-top" alt="Room Image">
                                    <div class="card-content">
                                    <h5><strong></strong> Room No: </strong><?php echo $fetch['room_no']?></h5>
                                    <p><strong> Capacity:</strong> <?php echo $fetch['capacity']?></p>
                                    <p><strong> Room Rent (Whole Room):</strong> <?php echo $fetch['price']?></p>
                                    <p><strong> Room Rent (By Slots):</strong> <?php echo $fetch['slot_price']?></p>
                                    <p><strong>Amenities:</strong> <?php echo $fetch['amenities']?></p>
                                    <p><strong>Gender Allowed:</strong>  <?php echo $fetch['tenant_type']?></p>
                                    <p><strong>Current Tenant:</strong> <?php echo $fetch['current_tenant']; ?>/<?php echo $fetch['capacity']?> </p>
                                    <p><strong>Room Floor:</strong>  <?php echo $fetch['room_floor']?> </p>
                                    <p><strong>Status:</strong> <?php echo $fetch['status']?></p>
                                    <style>
                                        .section3{
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            margin: 20px 10px;
                                        }

                                        .card{
                                            width: 300px;
                                            border-radius: 8px;
                                            overflow: hidden;
                                            box-shadow: 0px 10px 20px #aaaaaa;
                                            margin: 20px;
                                            display: flex;
                                            flex-direction: column; /* Ensure the flex direction is column */
                                            justify-content: space-between; /* Align items to the bottom */
                                            padding-bottom: 10px;
                                            height: auto;
                                        }

                                        .card img{
                                            width: 100%;
                                            height: 50%;
                                        }
                                        
                                        .card-content{
                                            padding: 16px;
                                        }

                                        .card-content h5{
                                            font-size: 28px;
                                            margin-bottom: 8px;
                                        }

                                        .card-content p{
                                            color: black;
                                            font-size: 15px;
                                            margin-bottom: 8px;
                                        }
                                        
                                        .book {
                                            padding: 10px 20px;
                                            font-size: 16px;
                                            font-weight: bold;
                                            text-align: center;
                                            color: white; /* Text color */
                                            background-color: #ffaa00; /* Blue background */
                                            border: none; /* Removes default border */
                                            border-radius: 5px; /* Rounded corners */
                                            text-decoration: none; /* Removes underline */
                                            cursor: pointer;
                                            transition: all 0.3s ease; /* Smooth hover effect */
                                        }

                                        .book:hover {
                                            background-color:rgb(221, 150, 7); /* Darker blue on hover */
                                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds shadow on hover */
                                        }

                                        .book:active {
                                            background-color: rgb(184, 123, 3); /* Even darker blue on click */
                                            transform: scale(0.98); /* Slightly reduces size when clicked */
                                        }

                                        .room-btn {
                                            margin-top: 25px; /* Maintains spacing above the button */
                                        }

                                        .card-content a{
                                            margin-top: 20px;
                                        }

                                        @media (max-width: 768px){
                                                    .card   {
                                                        width: 350px;
                                                        border-radius: 8px;
                                                        overflow: hidden;
                                                        box-shadow: 0px 10px 20px #aaaaaa;
                                                        margin: 20px;
                                                        display: flex;
                                                        flex-direction: column; /* Ensure the flex direction is column */
                                                        justify-content: space-between; /* Align items to the bottom */
                                                        padding-bottom: 10px;
                                                        height: auto;
                                                }
                                                .section3  {
                                                    display: flex;
                                                    flex-direction: column;
                                                    justify-content: center;
                                                    align-items: center;
                                                }
                                        }
                                    </style>
                                        <div class="room-btn">
                                        <?php 
                                            // Fetch room capacity, current tenant count, tenant type, and room status from the database
                                            $roomQuery = "SELECT capacity, current_tenant, tenant_type, status FROM rooms WHERE room_no = $roomno AND hname = '$hname'";
                                            $roomResult = mysqli_query($conn, $roomQuery);
                                            $roomData = mysqli_fetch_assoc($roomResult);

                                            $roomCapacity = $roomData['capacity']; // Total capacity of the room
                                            $currentTenant = $roomData['current_tenant']; // Current tenants in the room
                                            $roomStatus = $roomData['status']; // Current status of the room (Available, Full, Reserved)

                                            // Check if the room is full
                                            if ($currentTenant == $roomCapacity) {
                                                $roomStatus = "Full"; // Room is full
                                            } elseif ($roomStatus !== "Reserved") {
                                                $roomStatus = "Available"; // Room has space and is not reserved
                                            }

                                            // Ensure the current user is logged in
                                            if (isset($_SESSION['uname'])) {
                                                $userQuery = "SELECT role, gender FROM users WHERE uname = '" . $_SESSION['uname'] . "'";
                                                $userResult = mysqli_query($conn, $userQuery);
                                                $userData = mysqli_fetch_assoc($userResult);

                                                // Check if the user matches the room's gender restriction
                                                if ($roomData['tenant_type'] === 'All' || strtolower($roomData['tenant_type']) === strtolower($userData['gender'])) {
                                                    // Check room status before allowing booking
                                                    if ($roomStatus === "Available") {
                                                        // Allow booking if room is available
                                                        ?>
                                                        <a href='book-in.php?roomno=<?php echo $roomno; ?>' class='book'>Book Now!</a>
                                                        <?php
                                                    } else {
                                                        // Message if the room is full or reserved
                                                        if ($roomStatus === "Full") {
                                                            echo "<p>This room is currently full. You cannot book it.</p>";
                                                        } elseif ($roomStatus === "Reserved") {
                                                            echo "<p>This room is currently reserved. You cannot book it.</p>";
                                                        }
                                                    }
                                                } else {
                                                    // Message if the user is not eligible due to gender restriction
                                                    echo "<p>This room is restricted to " . ucfirst($roomData['tenant_type']) . " tenants.</p>";
                                                }
                                            } else {
                                                // Message if the user is not logged in
                                                echo "<p>Please log in to book this room.</p>";
                                            }
                                        ?>
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

    <script src="chart.min.js"></script>

    <script>
        // Wrap chart logic in a function
        function renderCharts() {
            var roomTypes = <?php echo json_encode($roomTypes); ?>;
            var tenantCounts = <?php echo json_encode($tenantCounts); ?>;

            var ctx = document.getElementById('tenantChart').getContext('2d');
            var tenantChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: roomTypes,
                    datasets: [{
                        label: 'Number of Tenants',
                        data: tenantCounts,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var roomNumbers = <?php echo json_encode($roomNumbers); ?>;
            var tenantCountsStatus = <?php echo json_encode($tenantCountsStatus); ?>;

            var ctx3 = document.getElementById('tenantOccupancyChart').getContext('2d');
            var tenantOccupancyChart = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: roomNumbers,
                    datasets: [{
                        label: 'Number of Tenants (Occupied)',
                        data: tenantCountsStatus,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var totalTenants = <?php echo json_encode($totalTenants); ?>;

            var ctxTotal = document.getElementById('totalTenantsChart').getContext('2d');
            var totalTenantsChart = new Chart(ctxTotal, {
                type: 'bar',
                data: {
                    labels: ['Total Tenants'],
                    datasets: [{
                        label: 'Number of Tenants',
                        data: [totalTenants],
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            var months = <?php echo json_encode($months); ?>;
            var tenantCountsByMonth = <?php echo json_encode($tenantCountsByMonth); ?>;

            var ctx = document.getElementById('tenantsByMonthChart').getContext('2d');
            var tenantsByMonthChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months.map(function(month) {
                        // Convert month number to month name
                        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        return monthNames[month - 1];
                    }),
                    datasets: [{
                        label: 'Number of Tenants',
                        data: tenantCountsByMonth,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });



        }

        // Call the function when the data is updated or after the page load
        renderCharts();

    </script>
</body>
</html>
