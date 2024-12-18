<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Reservations</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .dataTable thead {
            background-color: #212529;
            color: white;
        }
        /* Pagination styles */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: transparent;
            color: #212529;
            border: none;
            padding: 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next {
            padding: 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #212529;
            color: white;
            border-radius: 5px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #212529;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include 'navigationbar.php'; ?>

    <h1 class="text-center">Rejected Reservations</h1>
    <div class="container table-responsive">
        <?php 
        if (!empty($_SESSION) && $_SESSION['role'] == 'landlord') {
            $hname = $_SESSION['hname'];
            $query = "SELECT * FROM reservation WHERE hname = '$hname' AND res_stat = 'Rejected' ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
        ?>
        <table id="reservationsTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Reservation No</th>
                    <th>Guest Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Tenant Status</th>
                    <th>Room No</th>
                    <th>Room Rent</th>
                    <th>Selected Room Slot</th>
                    <th>Date In</th>
                    <th>Date Out</th>
                    <th>Requests</th>
                    <th>Duration</th>
                    <th>Reason</th>
                    <th>Reservation Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fetch = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $fetch['id']; ?></td>
                    <td><?php echo $fetch['fname'] . ' ' . $fetch['lname']; ?></td>
                    <td><?php echo $fetch['email']; ?></td>
                    <td><?php echo $fetch['gender']; ?></td>
                    <td><?php echo $fetch['tenant_status']; ?></td>
                    <td><?php echo $fetch['room_no']; ?></td>
                    <td><?php echo number_format($fetch['price'], 2); ?> PHP</td>
                    <td><?php echo $fetch['room_slot']; ?></td>
                    <td><?php echo $fetch['date_in']; ?></td>
                    <td><?php echo $fetch['date_out']; ?></td>
                    <td><?php echo $fetch['addons']; ?></td>
                    <td><?php echo $fetch['res_duration']; ?></td>
                    <td><?php echo $fetch['res_reason']; ?></td>
                    <td><?php echo $fetch['res_stat']; ?></td>
                    <td>
                        <!-- Action Buttons -->
                        <?php if ($fetch['res_stat'] == 'Approved'): ?>
                            <button class="btn btn-secondary btn-sm" disabled>Approve</button>
                            <button class="btn btn-secondary btn-sm" disabled>Reject</button>
                        <?php elseif ($fetch['res_stat'] == 'Pending'): ?>
                            <a href="php/function.php?approve=<?php echo $fetch['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="php/function.php?reject=<?php echo $fetch['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                        <?php elseif ($fetch['res_stat'] == 'Rejected'): ?>
                            <button class="btn btn-secondary btn-sm" disabled>Approve</button>
                            <button class="btn btn-secondary btn-sm" disabled>Reject</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
    // Initialize DataTable
    $(document).ready(function () {
        $('#reservationsTable').DataTable({
            paging: true,       // Enable pagination
            searching: true,    // Enable search bar
            ordering: true,     // Enable column ordering
            info: true,         // Show info (e.g., "Showing 1 to 10 of 100 entries")
            responsive: false,  // Disable auto-stacking for small screens
            scrollX: true       // Enable horizontal scrolling
        });
    });
    </script>
</body>
</html>
