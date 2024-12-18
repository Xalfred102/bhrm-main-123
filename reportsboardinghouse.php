<?php
include('php/connection.php'); // Database connection file

// Fetch total boarding houses
$totalBoardingHousesQuery = "SELECT COUNT(*) AS total_houses FROM boardinghouses";
$totalBoardingHousesResult = mysqli_query($conn, $totalBoardingHousesQuery);
$totalBoardingHouses = mysqli_fetch_assoc($totalBoardingHousesResult)['total_houses'];

// Fetch approved and rejected boarding houses
$statusCountQuery = "SELECT 
                        SUM(status = 'Approved') AS approved_count, 
                        SUM(status = 'Rejected') AS rejected_count 
                     FROM bhapplication";
$statusCountResult = mysqli_query($conn, $statusCountQuery);
$statusCount = mysqli_fetch_assoc($statusCountResult);

$approvedCount = $statusCount['approved_count'];
$rejectedCount = $statusCount['rejected_count'];

// Fetch number of users who reserved for each boarding house
$reservationCountQuery = "SELECT hname, COUNT(*) AS reservation_count 
                          FROM reservation 
                          GROUP BY hname";
$reservationCountResult = mysqli_query($conn, $reservationCountQuery);

// Store reservation data in an associative array
$reservationCounts = [];
while ($row = mysqli_fetch_assoc($reservationCountResult)) {
    $reservationCounts[$row['hname']] = $row['reservation_count'];
}

// Fetch boarding house details for the table
$boardingHouseDetailsQuery = "SELECT * FROM boardinghouses ORDER BY id DESC";
$boardingHouseDetailsResult = mysqli_query($conn, $boardingHouseDetailsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding House Report</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .summary {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }

        .card {
            background: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1 1 calc(33% - 20px);
            text-align: center;
        }

        .card h3 {
            font-size: 1.25rem;
            color: #6c757d;
        }

        .card p {
            font-size: 1.75rem;
            font-weight: bold;
            margin: 10px 0;
            color: #495057;
        }
    </style>
</head>
<body>
    <?php include 'navadmin.php'; ?>

    <div class="container my-4">
        <h1 class="text-center mb-4">Boarding House Report</h1>

        <!-- Summary Cards -->
        <div class="summary">
            <div class="card">
                <h3>Total Boarding Houses</h3>
                <p><?php echo $totalBoardingHouses; ?></p>
            </div>
            <div class="card">
                <h3>Approved Boarding Houses</h3>
                <p><?php echo $approvedCount; ?></p>
            </div>
            <div class="card">
                <h3>Rejected Boarding Houses</h3>
                <p><?php echo $rejectedCount; ?></p>
            </div>
        </div>

        <!-- Boarding House Details Table -->
        <h2 class="mt-4">Boarding House Details</h2>
        <div class="table-responsive">
            <table id="boardingHouseTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Boarding House Name</th>
                        <th>Address</th>
                        <th>Reservations</th>
                        <th>Landlord Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($house = mysqli_fetch_assoc($boardingHouseDetailsResult)) { 
                        $hname = $house['hname'];
                        $reservations = $reservationCounts[$hname] ?? 0; // Default to 0 if no reservations
                    ?>
                        <tr>
                            <td><?php echo $house['hname']; ?></td>
                            <td><?php echo $house['haddress']; ?></td>
                            <td><?php echo $reservations; ?></td>
                            <td><?php echo $house['landlord']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Initialize DataTable
        $(document).ready(function () {
            $('#boardingHouseTable').DataTable();
        });
    </script>
</body>
</html>
