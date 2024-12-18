<?php require 'php/connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    echo '';
} else {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation List</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <style>
        /* Custom Responsive Table Style */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                display: none; /* Hide table headers on small screens */
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                padding: 10px;
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: 5px;
                border-bottom: 1px solid #ccc;
                font-size: 14px;
            }

            td:last-child {
                border-bottom: none;
            }

            td::before {
                content: attr(data-label); /* Add labels for mobile */
                font-weight: bold;
                margin-right: 10px;
            }
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Reservation List</h2>

        <div class="table-responsive">
            <table id="reservationTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Boarding House</th>
                        <th>Guest Name</th>
                        <th>Email</th>
                        <th>Room No</th>
                        <th>Room Rent</th>
                        <th>Payment</th>
                        <th>Payment Date</th>
                        <th>Payment Status</th>
                        <th>Date In</th>
                        <th>Date Out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'user') {
                        $uname = $_SESSION['uname'];
                        $reservationQuery = "SELECT * FROM reservation WHERE email = '$uname' ORDER BY id DESC";
                        $reservationResult = mysqli_query($conn, $reservationQuery);

                        while ($reservation = mysqli_fetch_assoc($reservationResult)) {
                            echo "<tr>
                                <td data-label='#'>{$reservation['id']}</td>
                                <td data-label='Boarding House'>{$reservation['hname']}</td>
                                <td data-label='Guest Name'>{$reservation['fname']} {$reservation['lname']}</td>
                                <td data-label='Email'>{$reservation['email']}</td>
                                <td data-label='Room No'>{$reservation['room_no']}</td>
                                <td data-label='Room Rent'>{$reservation['price']} PHP</td>
                                <td data-label='Payment'>{$reservation['payment']}</td>
                                <td data-label='Payment Date'>{$reservation['pay_date']}</td>
                                <td data-label='Payment Status'>{$reservation['pay_stat']}</td>
                                <td data-label='Date In'>{$reservation['date_in']}</td>
                                <td data-label='Date Out'>{$reservation['date_out']}</td>
                                <td data-label='Status'>{$reservation['res_stat']}</td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function () {
            $('#reservationTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "info": true,
                "lengthChange": true
            });
        });
    </script>
</body>

</html>
