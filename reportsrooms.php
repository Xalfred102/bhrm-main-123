<?php

include('php/connection.php'); // Database connection file

$hname = $_SESSION['hname'];

// Fetch total number of rooms
$totalRoomsQuery = "SELECT COUNT(*) AS total_rooms FROM rooms WHERE hname = '$hname'";
$totalRoomsResult = mysqli_query($conn, $totalRoomsQuery);
$totalRooms = mysqli_fetch_assoc($totalRoomsResult)['total_rooms'];

// Fetch the room with the highest capacity
$highestCapacityQuery = "SELECT room_no, capacity FROM rooms WHERE hname = '$hname' ORDER BY capacity DESC LIMIT 1";
$highestCapacityResult = mysqli_query($conn, $highestCapacityQuery);
$highestCapacityRoom = mysqli_fetch_assoc($highestCapacityResult);

// Set default values if no data is fetched
$highestCapacityRoomNo = $highestCapacityRoom['room_no'] ?? 'None';
$highestCapacity = $highestCapacityRoom['capacity'] ?? 0;

// Fetch the room with the highest current tenants
$highestTenantQuery = "SELECT room_no, current_tenant FROM rooms WHERE hname = '$hname' ORDER BY current_tenant DESC LIMIT 1";
$highestTenantResult = mysqli_query($conn, $highestTenantQuery);
$highestTenantRoom = mysqli_fetch_assoc($highestTenantResult);

// Set default values if no data is fetched
$highestTenantRoomNo = $highestTenantRoom['room_no'] ?? 'None';
$highestTenantCount = $highestTenantRoom['current_tenant'] ?? 0;

// Fetch counts of available and full rooms
$roomStatusQuery = "SELECT 
                        SUM(status = 'Available') AS available_rooms, 
                        SUM(status = 'Full') AS full_rooms 
                    FROM rooms 
                    WHERE hname = '$hname'";
$roomStatusResult = mysqli_query($conn, $roomStatusQuery);
$roomStatusData = mysqli_fetch_assoc($roomStatusResult);
$availableRooms = $roomStatusData['available_rooms'];
$fullRooms = $roomStatusData['full_rooms'];

// Fetch detailed room data
$roomsQuery = "SELECT room_no, capacity, current_tenant, amenities, price, status FROM rooms WHERE hname = '$hname' ORDER BY room_no ASC";
$roomsResult = mysqli_query($conn, $roomsQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }
        .card {
            background: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #c19206; /* Updated color */
        }
    </style>
</head>
<body>

<?php include 'navigationbar.php'; ?>

<div class="container">
    <!-- Room Summary Section -->
    <div class="summary">
        <div class="card">
            <h3>Total Rooms</h3>
            <p><?php echo $totalRooms; ?></p>
        </div>
        <div class="card">
            <h5>Room with Highest Capacity</h5>
            <p><?php echo $highestCapacityRoomNo . ' (' . $highestCapacity . ' capacity)'; ?></p>
        </div>
        <div class="card">
            <h5>Room with Highest Current Tenants</h5>
            <p><?php echo $highestTenantRoomNo . ' (' . $highestTenantCount . ' tenants)'; ?></p>
        </div>

        <div class="card">
            <h3>Available Rooms</h3>
            <p><?php echo $availableRooms; ?></p>
        </div>
        <div class="card">
            <h3>Full Rooms</h3>
            <p><?php echo $fullRooms; ?></p>
        </div>
    </div>

    <!-- Room Details Table -->
    <h2 class="mt-4">Room Details</h2>
    <div class="table-responsive">
        <table id="roomsTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Room No</th>
                    <th>Capacity</th>
                    <th>Current Tenants</th>
                    <th>Amenities</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($room = mysqli_fetch_assoc($roomsResult)) { ?>
                    <tr>
                        <td><?php echo $room['room_no']; ?></td>
                        <td><?php echo $room['capacity']; ?></td>
                        <td><?php echo $room['current_tenant']; ?></td>
                        <td><?php echo $room['amenities']; ?></td>
                        <td><?php echo number_format($room['price'], 2); ?> PHP</td>
                        <td><?php echo $room['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    // Initialize DataTable
    $(document).ready(function () {
        $('#roomsTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true
        });
    });
</script>

</body>
</html>
