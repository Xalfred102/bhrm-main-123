<?php 
require 'php/connection.php';

if(!empty($_SESSION["uname"]) && $_SESSION["role"] == 'landlord'){
    $uname = $_SESSION['uname'];
    $query = "SELECT * FROM boardinghouses INNER JOIN documents ON boardinghouses.hname = documents.hname WHERE boardinghouses.owner = '$uname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);   
    echo "
    <script src='jquery.min.js'></script>
    <link rel='stylesheet' href='toastr.min.css'/>
    <script src='toastr.min.js'></script>
    <script>
        $(document).ready(function() {
            " . (isset($_SESSION['login_message_displayed']) ? "toastr.success('Logged in Successfully');" : "") . "
        });
    </script>
    ";

    if (isset($_SESSION['login_message_displayed'])) {
        unset($_SESSION['login_message_displayed']);
    }
} else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin-left: 220px;
        }

        .section2 {
            height: 100px;
            display: flex;
            justify-content: left;
            align-items: center;
            margin: 0 100px;
            animation: fadeIn 1s ease-in-out;
        }

        .section2 .btn {
            animation: bounceIn 1s ease;
        }

        .section3 {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 30px;
            animation: fadeIn 1s ease-in-out;
        }

        .card {
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
}

.list-group-item {
    font-size: 0.9rem;
    color: #333;
}

.badge {
    font-size: 0.9rem;
    padding: 0.5em;
}


        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <?php include 'navigationbar.php'; ?>

    <div class="section2">
        <button class="btn btn-warning">
            <a href="php/roomfunction.php" class="btn">Add Rooms</a>
        </button>
    </div>

    <div class="section3">
        <?php 
            $hname = $_SESSION['hname'];
            $query = "SELECT * FROM rooms WHERE hname = '$hname' ORDER BY room_no";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($fetch = mysqli_fetch_assoc($result)) {
                    $id = $fetch['id'];
                    $roomno = $fetch['room_no'];
                    $capacity = $fetch['capacity'];
                    $tenantcount = $fetch['current_tenant'];

                    // Auto-update room status
                    if ($tenantcount == $capacity) {
                        $query = "UPDATE rooms SET status = 'Full' WHERE room_no = $roomno";
                        mysqli_query($conn, $query);
                        $query = "UPDATE reservation SET status = 'Full' WHERE room_no = $roomno";
                        mysqli_query($conn, $query);
                    } else if ($tenantcount < $capacity) {
                        $query = "UPDATE rooms SET status = 'Available' WHERE room_no = $roomno";
                        mysqli_query($conn, $query);
                        $query = "UPDATE reservation SET status = 'Available' WHERE room_no = $roomno";
                        mysqli_query($conn, $query);
                    }
        ?>
        <div class="card shadow-sm mb-4" style="width: 22rem;">
            <img src="<?php echo $fetch['image']; ?>" class="card-img-top" alt="Room Image" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title text-center"><strong>Room No:</strong> <?php echo $roomno; ?></h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Capacity:</strong> <?php echo $capacity; ?></li>
                    <li class="list-group-item"><strong>Rent / Month (Whole Room):</strong> <?php echo $fetch['price']; ?></li>
                    <li class="list-group-item"><strong>Rent / Month (By Slots):</strong> <?php echo $fetch['slot_price']; ?></li>
                    <li class="list-group-item"><strong>Amenities:</strong> <?php echo $fetch['amenities']; ?></li>
                    <li class="list-group-item"><strong>Tenant Type:</strong> <?php echo $fetch['tenant_type']; ?> Only</li>
                    <li class="list-group-item"><strong>Current Tenant:</strong> <?php echo $tenantcount; ?> / <?php echo $capacity; ?></li>
                    <li class="list-group-item"><strong>Room Floor:</strong> <?php echo $fetch['room_floor']; ?></li>
                    <li class="list-group-item"><strong>Status:</strong> 
                        <span class="badge bg-<?php echo $fetch['status'] === 'Full' ? 'danger' : 'success'; ?>">
                            <?php echo $fetch['status']; ?>
                        </span>
                    </li>
                </ul>
                <div class="d-flex justify-content-between mt-3">
                    <button 
                        data-action="update" 
                        data-id="<?php echo $id; ?>" 
                        class="btn btn-success action-button"
                        <?php echo $tenantcount > 0 ? 'disabled' : ''; ?>
                    >
                        Update
                    </button>
                    <button 
                        data-action="delete" 
                        data-id="<?php echo $id; ?>" 
                        class="btn btn-danger action-button"
                        <?php echo $tenantcount > 0 ? 'disabled' : ''; ?>
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
        <?php } } ?>
    </div>


    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalMessage">Are you sure?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="#" id="confirmActionBtn" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.action-button').click(function () {
                const actionType = $(this).data('action');
                const roomId = $(this).data('id');
                $('#modalMessage').text(`Are you sure you want to ${actionType} this room?`);
                $('#confirmActionBtn').attr('href', `php/roomfunction.php?r${actionType}=${roomId}`);
                $('#confirmModal').modal('show');
            });
        });
    </script>
</body>
</html>
