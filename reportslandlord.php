<?php
include('php/connection.php'); // Include database connection file

// Fetch total landlords from the users table (assuming role is 'landlord')
$totalLandlordsQuery = "SELECT COUNT(*) AS total_landlords FROM users WHERE role = 'landlord'";
$totalLandlordsResult = mysqli_query($conn, $totalLandlordsQuery);
$totalLandlords = mysqli_fetch_assoc($totalLandlordsResult)['total_landlords'];

// Fetch all landlords for the table display
$landlordsQuery = "SELECT * FROM users WHERE role = 'landlord'";
$landlordsResult = mysqli_query($conn, $landlordsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Report</title>

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
        <h1 class="text-center mb-4">Landlord Report</h1>

        <!-- Total Landlords Summary -->
        <div class="summary">
            <div class="card">
                <h3>Total Landlords</h3>
                <p><?php echo $totalLandlords; ?></p>
            </div>
        </div>

        <!-- Landlord Details Table -->
        <h2 class="mt-4">Landlord Details</h2>
        <div class="table-responsive">
            <table id="landlordTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Profile Picture</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Boarding House</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($landlord = mysqli_fetch_assoc($landlordsResult)) { ?>
                        <tr>
                            <td><?php echo $landlord['id']; ?></td>
                            <td>
                                <img src="/bhrm-main/<?php echo $landlord['image'] ?? 'default.png'; ?>" 
                                     width="50" 
                                     height="50" 
                                     class="rounded-circle" 
                                     alt="Profile Picture">
                            </td>
                            <td><?php echo $landlord['fname']; ?></td>
                            <td><?php echo $landlord['lname']; ?></td>
                            <td><?php echo $landlord['gender']; ?></td>
                            <td><?php echo $landlord['uname']; ?></td>
                            <td><?php echo $landlord['hname']; ?></td>
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
            $('#landlordTable').DataTable();
        });
    </script>
</body>
</html>
