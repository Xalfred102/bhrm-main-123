<?php 
include 'php/connection.php';

if(!empty($_SESSION["uname"]) && $_SESSION["role"] == 'landlord'){
    $uname = $_SESSION['uname'];
    $query = "select * from boardinghouses inner join documents on boardinghouses.hname = documents.hname where boardinghouses.owner = '$uname'";
    $result = mysqli_query($conn, $query);
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
}else{
    header('location: index.php');
}


    $hname = $_SESSION['hname'];

    $reservationQuery = "SELECT COUNT(*) as total_reservations FROM reservation where hname = '$hname'";
    $reservationResult = mysqli_query($conn, $reservationQuery);
    $reservationData = mysqli_fetch_assoc($reservationResult);
    $totalReservations = $reservationData['total_reservations'];

    $reservationQuery = "SELECT COUNT(*) as total_reservations FROM reservation where res_stat = 'Approved' and hname = '$hname'";
    $reservationResult = mysqli_query($conn, $reservationQuery);
    $reservationData = mysqli_fetch_assoc($reservationResult);
    $totalapproved = $reservationData['total_reservations'];

    $tenantQuery = "
        SELECT COUNT(DISTINCT email) AS total_tenants
        FROM reservation
        WHERE hname = '$hname'";
    $tenantResult = mysqli_query($conn, $tenantQuery);
    $tenantData = mysqli_fetch_assoc($tenantResult);
    $totalTenants = $tenantData['total_tenants'];

    // Fetch total rooms
    $totalRoomsQuery = "SELECT COUNT(*) as total_rooms FROM rooms where hname = '$hname'";
    $totalRoomsResult = mysqli_query($conn, $totalRoomsQuery);
    $totalRoomsData = mysqli_fetch_assoc($totalRoomsResult);
    $totalRooms = $totalRoomsData['total_rooms'];

    // Fetch total available rooms
    $availableRoomsQuery = "SELECT COUNT(*) as available_rooms FROM rooms WHERE status = 'Available'  and hname = '$hname'";
    $availableRoomsResult = mysqli_query($conn, $availableRoomsQuery);
    $availableRoomsData = mysqli_fetch_assoc($availableRoomsResult);
    $availableRooms = $availableRoomsData['available_rooms'];

    $totalPaymentsQuery = "SELECT SUM(payment) as total_payments FROM reports where hname = '$hname'";
    $totalPaymentsResult = mysqli_query($conn, $totalPaymentsQuery);
    $totalPaymentsData = mysqli_fetch_assoc($totalPaymentsResult);
    $totalPayments = $totalPaymentsData['total_payments'] ?? 0;

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            position: relative;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include 'navigationbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Dashboard Overview</h1>
        <div class="row">
            <!-- Total Reservations -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Reservations</h5>
                        <p class="card-text fs-3"><?php echo $totalReservations; ?></p>
                    </div>
                </div>
            </div>

            <!-- Total Tenants -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Tenants</h5>
                        <p class="card-text fs-3"><?php echo $totalTenants; ?></p>
                    </div>
                </div>
            </div>

            <!-- Total Rooms -->
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Rooms</h5>
                        <p class="card-text fs-3"><?php echo $totalRooms; ?></p>
                    </div>
                </div>
            </div>

            <!-- Available Rooms -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Available Rooms</h5>
                        <p class="card-text fs-3"><?php echo $availableRooms; ?></p>
                    </div>
                </div>
            </div>

            <!-- Total Payments -->
            <div class="col-md-4">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Payments Collected</h5>
                        <p class="card-text fs-3">₱<?php echo number_format($totalPayments, 2); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Reservation Apporved</h5>
                        <p class="card-text fs-3"> <?php echo $totalapproved; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="container mt-5">
        <h1 class="text-center mb-4">Dashboard Statistics</h1>
        <div class="row">
            <!-- Chart for Total Reservations -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="reservationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart for Total Tenants -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="tenantChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data for Total Reservations Chart
        const reservationData = {
            labels: ['Total Reservations'],
            datasets: [{
                label: 'Reservations',
                data: [<?php echo $totalReservations; ?>],
                backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        };

        // Options for Reservations Chart
        const reservationOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Render Reservations Chart
        const reservationCtx = document.getElementById('reservationChart').getContext('2d');
        new Chart(reservationCtx, {
            type: 'bar',
            data: reservationData,
            options: reservationOptions
        });

        // Data for Total Tenants Chart
        const tenantData = {
            labels: ['Total Tenants'],
            datasets: [{
                label: 'Tenants',
                data: [<?php echo $totalTenants; ?>],
                backgroundColor: ['rgba(153, 102, 255, 0.2)'],
                borderColor: ['rgba(153, 102, 255, 1)'],
                borderWidth: 1
            }]
        };

        // Options for Tenants Chart
        const tenantOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Render Tenants Chart
        const tenantCtx = document.getElementById('tenantChart').getContext('2d');
        new Chart(tenantCtx, {
            type: 'bar',
            data: tenantData,
            options: tenantOptions
        });
    </script>
    
</body>
</html>
