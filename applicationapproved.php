<?php
include 'php/connection.php';

if (empty($_SESSION["uname"]) || empty($_SESSION["role"])) {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Applications</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
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
            color: #28a745;
        }
    </style>
</head>
<body>
<?php include 'navadmin.php'; ?>

<div class="container my-4">
    <h2 class="text-center mb-4">Approved Applications</h2>

    <!-- Summary Section -->
    <div class="summary">
        <div class="card">
            <h3>Total Approved Applications</h3>
            <p>
                <?php
                $approvedCountQuery = "SELECT COUNT(*) AS total_approved FROM bhapplication WHERE status = 'APPROVED'";
                $approvedCountResult = mysqli_query($conn, $approvedCountQuery);
                echo mysqli_fetch_assoc($approvedCountResult)['total_approved'];
                ?>
            </p>
        </div>
    </div>

    <!-- Approved Applications Table -->
    <div class="table-responsive mt-4">
        <table id="approvedApplicationsTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Boarding House Name</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Documents</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT DISTINCT bhapplication.hname, bhapplication.*, documents.*, description.* 
                          FROM bhapplication 
                          INNER JOIN documents ON bhapplication.hname = documents.hname
                          INNER JOIN description ON bhapplication.hname = description.hname 
                          WHERE bhapplication.status = 'APPROVED' 
                          ORDER BY bhapplication.id DESC";
                $result = mysqli_query($conn, $query);
                while ($fetch = mysqli_fetch_assoc($result)): 
                ?>
                    <tr>
                        <td><?php echo $fetch['hname']; ?></td>
                        <td><?php echo $fetch['haddress']; ?></td>
                        <td><?php echo $fetch['bh_description']; ?></td>
                        <td>
                            <a href="./<?php echo $fetch['bar_clear']; ?>" class="btn btn-link text-primary" target="_blank">Bar Clearance</a><br>
                            <a href="./<?php echo $fetch['bus_per']; ?>" class="btn btn-link text-primary" target="_blank">Business Permit</a>
                        </td>
                        <td><span class="badge bg-success">Approved</span></td>
                        <td><button class="btn btn-secondary" disabled>Approved</button></td>
                    </tr>
                <?php endwhile; ?>
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
        $('#approvedApplicationsTable').DataTable({
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
