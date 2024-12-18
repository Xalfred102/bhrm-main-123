<?php
include 'connection.php';

if (empty($_SESSION["uname"]) || empty($_SESSION["role"])) {
    header('location: ./index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h2 {
            color: #495057;
            font-weight: 700;
        }

        table {
            margin-top: 30px;
        }

        .badge {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <?php include '../navadmin.php'; ?>

    <div class="container my-5">
        <!-- Pending Section -->
        



    <!-- Bootstrap JS and DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables for all tables
            $('#applicationsTable').DataTable({
                searching: true,
                paging: true,
                ordering: true,
                columnDefs: [{ targets: [0, 5], orderable: false }]
            });

            $('#approvedApplicationsTable').DataTable({
                searching: true,
                paging: true,
                ordering: true,
                columnDefs: [{ targets: [5], orderable: false }]
            });

            $('#rejectedApplicationsTable').DataTable({
                searching: true,
                paging: true,
                ordering: true,
                columnDefs: [{ targets: [5], orderable: false }]
            });
        });
    </script>
</body>

</html>
