<?php
include('php/connection.php'); // Database connection file

$hname = $_SESSION['hname'];

// Fetch total tenants per `hname`, counting unique emails
$totalTenantsQuery = "
    SELECT COUNT(DISTINCT email) AS total_tenants 
    FROM reservation 
    WHERE hname = '$hname' and res_stat IN ('Confirmed', 'Approved')";
$totalTenantsResult = mysqli_query($conn, $totalTenantsQuery);
$totalTenants = mysqli_fetch_assoc($totalTenantsResult)['total_tenants'];

// Fetch total male and female tenants per `hname`, counting unique emails
$genderCountQuery = "
    SELECT 
        COUNT(DISTINCT CASE WHEN gender = 'Male' THEN email END) AS male_count, 
        COUNT(DISTINCT CASE WHEN gender = 'Female' THEN email END) AS female_count 
    FROM reservation 
    WHERE hname = '$hname' and res_stat IN ('Confirmed', 'Approved') ";
$genderCountResult = mysqli_query($conn, $genderCountQuery);
$genderCount = mysqli_fetch_assoc($genderCountResult);

$maleCount = $genderCount['male_count'];
$femaleCount = $genderCount['female_count'];

// Fetch tenant details for table (unique emails only)
$tenantDetailsQuery = "
    SELECT DISTINCT email, fname, lname, gender, tenant_status, school, image 
    FROM reservation 
    WHERE hname = '$hname' and res_stat IN ('Confirmed', 'Approved')
    ORDER BY id DESC";
$tenantDetailsResult = mysqli_query($conn, $tenantDetailsQuery);

// Fetch the total number of students and the total number of students from CKCM
$countQuery = "
    SELECT 
        COUNT(DISTINCT CASE WHEN tenant_status = 'Student' THEN email END) AS total_students,
        COUNT(DISTINCT CASE WHEN tenant_status = 'Student' AND school = 'CKCM' THEN email END) AS total_ckcm_students,
        COUNT(DISTINCT CASE WHEN tenant_status = 'Student' AND school = 'LSSTI' THEN email END) AS total_lssti_students,
        COUNT(DISTINCT CASE WHEN tenant_status = 'Student' AND school = 'NCMC' THEN email END) AS total_ncmc_students
    FROM reservation 
    WHERE hname = '$hname' and res_stat IN ('Confirmed', 'Approved')";
$countResult = mysqli_query($conn, $countQuery);
$countFetch = mysqli_fetch_assoc($countResult);

// Fetch results
$totalStudents = $countFetch['total_students'];
$totalCkcmStudents = $countFetch['total_ckcm_students'];
$totalLsstiStudents = $countFetch['total_lssti_students'];
$totalNcmcStudents = $countFetch['total_ncmc_students'];


$tenantCountQuery = "
    SELECT 
        COUNT(DISTINCT CASE WHEN tenant_status = 'Worker' THEN email END) AS total_workers,
        COUNT(DISTINCT CASE WHEN res_stat IN ('Confirmed', 'Approved') THEN email END) AS total_active_tenants
    FROM reservation
    WHERE hname = '$hname'";
$tenantCountResult = mysqli_query($conn, $tenantCountQuery);
$tenantCountFetch = mysqli_fetch_assoc($tenantCountResult);

// Fetch results
$totalWorkers = $tenantCountFetch['total_workers'];
$totalActiveTenants = $tenantCountFetch['total_active_tenants'];


$tenantDetailsQuery = "
    SELECT email, 
           MAX(fname) AS fname, 
           MAX(lname) AS lname, 
           MAX(gender) AS gender, 
           MAX(tenant_status) AS tenant_status, 
           MAX(school) AS school, 
           MAX(image) AS image,
           MAX(date_in) AS date_in, 
           MAX(date_out) AS date_out
    FROM reservation 
    WHERE hname = '$hname' and res_stat IN ('Confirmed', 'Approved')
    GROUP BY email
    ORDER BY MAX(id) DESC";
$tenantDetailsResult = mysqli_query($conn, $tenantDetailsQuery);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenants Report - <?php echo $hname; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }
        .card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .card h5 {
            color: #333;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #c19206;
        }
        table.dataTable {
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'navigationbar.php'; ?>

    <div class="container my-4">
        <h1 class="text-center mb-4">Tenant Reports for <?php echo $hname; ?></h1>

        <!-- Summary Section -->
        <div class="summary">
            <div class="card">
                <h5>Total Tenants</h5>
                <p><?php echo $totalTenants; ?></p>
            </div>
            <div class="card">
                <h5>Total Male Tenants</h5>
                <p><?php echo $maleCount; ?></p>
            </div>
            <div class="card">
                <h5>Total Female Tenants</h5>
                <p><?php echo $femaleCount; ?></p>
            </div>
            <div class="card">
                <h5>Total Students</h5>
                <p><?php echo $totalStudents; ?></p>
            </div>
            <div class="card">
                <h5>Total Workers</h5>
                <p><?php echo $totalWorkers; ?></p>
            </div>
            <div class="card">
                <h5>Total Active Tenants</h5>
                <p><?php echo $totalActiveTenants; ?></p>
            </div>
            <div class="card">
                <h5>Total Students from CKCM</h5>
                <p><?php echo $totalCkcmStudents; ?></p>
            </div>
            <div class="card">
                <h5>Total Students from LSSTI</h5>
                <p><?php echo $totalLsstiStudents; ?></p>
            </div>
            <div class="card">
                <h5>Total Students from NCMC</h5>
                <p><?php echo $totalNcmcStudents; ?></p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <label for="filterBookingIn" class="form-label">Filter Booking In</label>
                <input type="month" id="filterBookingIn" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="filterBookingEnd" class="form-label">Filter by Ended Book Month:</label>
                <input type="month" id="filterBookingEnd" class="form-control">
            </div>
        </div>

        <!-- DataTable Section -->
        <div class="mt-5">
            <h2 class="mb-3">Tenant Details</h2>
            <div class="table-responsive">
                <table id="tenantTable" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Image</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>School</th>
                            <th>Date In</th>
                            <th>Date Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($tenant = mysqli_fetch_assoc($tenantDetailsResult)) { ?>
                            <tr>                                <td>
                                    <img src="/bhrm-main/<?php echo $tenant['image'] ?? 'default.png'; ?>" 
                                        width="50" height="50" 
                                        class="rounded-circle" 
                                        alt="Profile Picture">
                                </td>
                                <td><?php echo htmlspecialchars($tenant['fname']); ?></td>
                                <td><?php echo htmlspecialchars($tenant['lname']); ?></td>
                                <td><?php echo htmlspecialchars($tenant['gender']); ?></td>
                                <td><?php echo htmlspecialchars($tenant['email']); ?></td>
                                <td><?php echo htmlspecialchars($tenant['tenant_status'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($tenant['school'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($tenant['date_in']); ?></td>
                                <td><?php echo htmlspecialchars($tenant['date_out']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- add the download here as excel -->

    <!-- Bootstrap JS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
        
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            var table = $('#tenantTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true
            });
        
            // Custom filter for Booking In month
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var filterBookingIn = $('#filterBookingIn').val(); // Selected Booking In Month
                var dateIn = data[7]; // 'Date In' column

                // If no filter is selected, show all records
                if (!filterBookingIn) {
                    return true;
                }

                var inDate = new Date(dateIn);
                var selectedBookingInMonth = new Date(filterBookingIn + "-01");

                // Check if Date In matches the selected "Booking In" month
                return inDate.getFullYear() === selectedBookingInMonth.getFullYear() &&
                    inDate.getMonth() === selectedBookingInMonth.getMonth();
            });

            // Custom filter for Booking End month
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var filterBookingEnd = $('#filterBookingEnd').val(); // Selected Booking End Month
                var dateOut = data[8]; // 'Date Out' column

                // If no filter is selected, show all records
                if (!filterBookingEnd) {
                    return true;
                }

                // Ensure dateOut is in a valid format
                var outDate = new Date(dateOut);
                var selectedBookingEndMonth = new Date(filterBookingEnd + "-01");

                // Check if Date Out matches the selected "Booking End" month
                return outDate.getFullYear() === selectedBookingEndMonth.getFullYear() &&
                    outDate.getMonth() === selectedBookingEndMonth.getMonth();
            });

            // Trigger filter automatically when any month changes
            $('#filterBookingIn').on('change', function () {
                // Clear Booking End filter when Booking In is selected
                $('#filterBookingEnd').val('');
                table.draw();
            });

            $('#filterBookingEnd').on('change', function () {
                // Clear Booking In filter when Booking End is selected
                $('#filterBookingIn').val('');
                table.draw();
            });
        });
    </script>
</body>
</html>
