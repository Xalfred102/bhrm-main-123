<?php
require 'connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    echo '';
} else {
    header("location: ../index.php");
}

if (isset($_GET['approve'])) {
    $hname = $_SESSION['hname'];
    $id = $_GET['approve'];

    // Fetch reservation details
    $query = "SELECT * FROM reservation WHERE id = $id and hname = '$hname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);

    $resid = $fetch['id'];
    $roomno = $fetch['room_no'];
    $price = $fetch['price'];
    $roomslot = $fetch['room_slot'];
    $slotprice = $fetch['slot_price'];
    $uname = $fetch['email'];
    $fname = $fetch['fname'];
    $lname = $fetch['lname'];
    $gender = $fetch['gender'];
    $owner = $fetch['owner'];
    $capacity = $fetch['capacity'];  // Room capacity

    // Update the reservation status
    $updateReservationQuery = "UPDATE reservation 
                                SET res_duration = '1 day', 
                                    res_stat = 'Approved', 
                                    res_reason = 'Process Completed' 
                                WHERE id = $id AND hname = '$hname'";
    mysqli_query($conn, $updateReservationQuery);

    // If the room capacity is 1, update the room status to 'Reserved'
    if ($capacity == 1 || trim($roomslot) == 'Whole Room') {
        // Update the status of all reservations for this room to 'Reserved'
        $updateAllReservationsQuery = "UPDATE reservation 
                                       SET res_duration = '1 day',
                                           status = 'Reserved',
                                           res_reason = 'Process Completed'
                                       WHERE room_no = '$roomno' AND hname = '$hname'";
        mysqli_query($conn, $updateAllReservationsQuery);
    
        // Update the room status in the rooms table to 'Reserved'
        $updateRoomStatusInRoomsQuery = "UPDATE rooms 
                                         SET status = 'Reserved' 
                                         WHERE room_no = '$roomno' AND hname = '$hname'";
        mysqli_query($conn, $updateRoomStatusInRoomsQuery);
    }

    // Redirect after the update
    header('Location: ../approved.php');
    exit;
}


if (isset($_GET['reject'])) {
    $hname = $_SESSION['hname'];
    $id = $_GET['reject'];

    // Fetch the reservation details
    $query = "SELECT * FROM reservation WHERE id = $id AND hname = '$hname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);

    $roomno = $fetch['room_no'];

    // Update the reservation status to 'Rejected'
    $updateReservationQuery = "UPDATE reservation 
                               SET res_stat = 'Rejected', 
                                   res_reason = 'No valid information / No Tenant Came' 
                               WHERE id = $id AND hname = '$hname'";
    mysqli_query($conn, $updateReservationQuery);

    // Redirect back to the reservation page
    header('Location: ../rejected.php');
    exit;
}


if (isset($_GET['confirm'])) {
    $hname = $_SESSION['hname'];
    $id = $_GET['confirm'];

    // Fetch reservation details
    $query = "SELECT * FROM reservation WHERE id = $id AND hname = '$hname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);

    $resid = $fetch['id'];
    $roomno = $fetch['room_no'];
    $price = $fetch['price'];
    $roomslot = $fetch['room_slot'];
    $slotprice = $fetch['slot_price'];
    $uname = $fetch['email'];
    $fname = $fetch['fname'];
    $lname = $fetch['lname'];
    $gender = $fetch['gender'];
    $owner = $fetch['owner'];
    $date_in = date('Y-m-d'); // Current date as the check-in date
    $selected_slots = $fetch['room_slot']; // Assuming this field stores slots as comma-separated values

    // Fetch room capacity
    $roomQuery = "SELECT capacity, current_tenant FROM rooms WHERE room_no = '$roomno' AND hname = '$hname'";
    $roomResult = mysqli_query($conn, $roomQuery);
    $roomData = mysqli_fetch_assoc($roomResult);
    $roomCapacity = $roomData['capacity'];
    $currentTenant = $roomData['current_tenant'];

    // Determine slots booked
    if (trim($selected_slots) === 'Whole Room') {
        // If "Whole Room" is selected, set current_tenant to the room's full capacity
        $newTenantCount = $roomCapacity;
    } else {
        // Otherwise, count the slots booked
        $slotsBooked = count(explode(", ", $selected_slots));
        $newTenantCount = $currentTenant + $slotsBooked;
        // Ensure we do not exceed room capacity
        if ($newTenantCount > $roomCapacity) {
            $newTenantCount = $roomCapacity;
        }
    }

    $roomStatus = ($newTenantCount >= $roomCapacity) ? 'Full' : 'Available';

    // Insert a report record for the reservation
    $insertReportQuery = "INSERT INTO `reports` (`id`, `fname`, `lname`, `gender`, `email`, `pay_date`, `date_in`, `date_out`, `room_no`, `hname`, `owner`) 
                          VALUES ('', '$fname', '$lname', '$gender', '$uname', '', '$date_in', NULL, '$roomno', '$hname', '$owner')";
    mysqli_query($conn, $insertReportQuery);

    
     // Insert a payment record for the reservation
     $insertPaymentQuery = "INSERT INTO `payments` (`id`, `res_id`, `email`, `room_no`, `price`, `room_slot`, `slot_price`, `pay_stat`, `hname`, `owner`) 
     VALUES ('', '$resid', '$uname', '$roomno', '$price', '$roomslot', '$slotprice', 'Not Fully Paid', '$hname', '$owner')";
     mysqli_query($conn, $insertPaymentQuery);


    // Update the reservation status
    $updateReservationQuery = "UPDATE reservation 
                                SET current_tenant = $newTenantCount,
                                    status = '$roomStatus', 
                                    res_duration = '', 
                                    res_stat = 'Confirmed', 
                                    res_reason = 'Tenant Arrived'
                                WHERE id = $id AND hname = '$hname'";
    mysqli_query($conn, $updateReservationQuery);

    // Increment the tenant count in the room based on slots booked
    $updateRoomQuery = "UPDATE rooms 
                        SET current_tenant = $newTenantCount,
                            status = '$roomStatus'
                        WHERE room_no = '$roomno' AND hname = '$hname'";
    mysqli_query($conn, $updateRoomQuery);

    // Redirect after the update
    header('Location: ../approved.php');
    exit;
}


if (isset($_GET['cancel'])) {
    $hname = $_SESSION['hname'];
    $id = $_GET['cancel'];

    // Fetch reservation details
    $query = "SELECT * FROM reservation WHERE id = $id AND hname = '$hname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);
    $capacity = $fetch['capacity'];  // Room capacity

    $roomno = $fetch['room_no'];

    // Update the reservation status to 'Cancelled'
    $updateReservationQuery = "UPDATE reservation 
                               SET  res_duration = '',
                                    res_stat = 'Cancelled', 
                                   res_reason = 'Reservation Cancelled' 
                               WHERE id = $id AND hname = '$hname'";
    mysqli_query($conn, $updateReservationQuery);
    
    if ($capacity == 1) {
        // Update the room status in the reservation table
        $updateRoomStatusQuery = "UPDATE reservation 
                                  SET res_duration = '',
                                    status = 'Cancelled',
                                    res_reason = 'Reservation Cancelled'
                                  WHERE room_no = '$roomno' AND hname = '$hname' AND res_stat = 'Approved'";
        mysqli_query($conn, $updateRoomStatusQuery);

        // Update the room status in the rooms table
        $updateRoomStatusInRoomsQuery = "UPDATE rooms 
                                         SET status = 'Available' 
                                         WHERE room_no = '$roomno' AND hname = '$hname'";
        mysqli_query($conn, $updateRoomStatusInRoomsQuery);
    }

    // Redirect after the update
    header('Location: ../cancelled.php');
    exit;
}



if (isset($_GET['end'])) {
    $hname = $_SESSION['hname'];
    $id = $_GET['end'];

    // Fetch reservation details
    $query = "SELECT * FROM reservation WHERE id = $id AND hname = '$hname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);

    $roomno = $fetch['room_no'];
    $email = $fetch['email'];
    $selected_slots = $fetch['room_slot']; // Slots booked by this reservation

    // Fetch room details
    $roomQuery = "SELECT capacity, price, current_tenant FROM rooms WHERE room_no = '$roomno' AND hname = '$hname'";
    $roomResult = mysqli_query($conn, $roomQuery);
    $roomData = mysqli_fetch_assoc($roomResult);
    $roomCapacity = $roomData['capacity'];
    $roomprice = $roomData['price'];
    $currentTenant = $roomData['current_tenant'];

    // Determine slots booked
    if (trim($selected_slots) === 'Whole Room') {
        // If "Whole Room" was booked, decrement the tenant count by the room's full capacity
        $newTenantCount = $currentTenant - $roomCapacity;
    } else {
        // Otherwise, count the slots booked
        $slotsBooked = count(explode(", ", $selected_slots));
        $newTenantCount = $currentTenant - $slotsBooked;
        // Ensure the tenant count does not drop below zero
        if ($newTenantCount < 0) {
            $newTenantCount = 0;
        }
    }

    $roomStatus = ($newTenantCount === $roomCapacity) ? 'Full' : 'Available';

    // Fetch the most recent payment for this reservation
    $paymentQuery = "SELECT * FROM payments 
                     WHERE email = '$email' AND room_no = '$roomno' AND hname = '$hname' 
                     ORDER BY id DESC LIMIT 1"; // Fetch the latest payment record
    $paymentResult = mysqli_query($conn, $paymentQuery);
    $paymentData = mysqli_fetch_assoc($paymentResult);

    $payment = $paymentData['price']; // Get the final payment amount
    $pay_stat = $paymentData['pay_stat'];
    $pay_date = $paymentData['pay_date']; // Get the payment date
    $date_out = date('Y-m-d'); // Use the current date for the end of reservation

    // Update the reservation status
    $updateReservationQuery = "UPDATE reservation 
                                SET current_tenant = $newTenantCount,
                                    status = '$roomStatus',
                                    res_stat = 'Ended', 
                                    res_reason = 'Reservation Ended', 
                                    payment = '$payment',
                                    pay_stat = '$pay_stat',
                                    pay_date = '$pay_date'
                                WHERE id = $id AND hname = '$hname'";
    mysqli_query($conn, $updateReservationQuery);

    // Update tenant count in the room
    $updateRoomQuery = "UPDATE rooms 
                        SET current_tenant = $newTenantCount,
                        status = '$roomStatus'
                        WHERE room_no = '$roomno' AND hname = '$hname'";
    mysqli_query($conn, $updateRoomQuery);

    // Fetch the corresponding report ID using the email, room_no, and hname
    $reportQuery = "SELECT * FROM reports 
                    WHERE email = '$email' AND room_no = '$roomno' AND hname = '$hname' 
                    ORDER BY id DESC LIMIT 1"; // Get the latest report
    $reportResult = mysqli_query($conn, $reportQuery);
    $reportData = mysqli_fetch_assoc($reportResult);
    $report_id = $reportData['id']; // Get the ID of the latest report

    // Update the report using the report ID
    $updateReportQuery = "UPDATE reports 
                          SET payment = '$payment', 
                              pay_stat = '$pay_stat',
                              pay_date = '$pay_date', 
                              date_out = '$date_out',
                              price = '$roomprice'
                          WHERE id = $report_id AND hname = '$hname'";
    mysqli_query($conn, $updateReportQuery);

    // Delete the processed payment record
    $deletePaymentQuery = "DELETE FROM payments 
                           WHERE email = '$email' AND room_no = '$roomno' AND hname = '$hname'";
    mysqli_query($conn, $deletePaymentQuery);

    // Redirect after processing
    header('Location: ../ended.php');
    exit;
}








$data = ['id' => '', 'owner' => '', 'hname' => '', 'haddress' => '', 'image' => '', 'price' => '', 'status' => '', 'amenities' => '', 'description' => ''];


if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query = "SELECT * FROM `boardinghouses` WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $hname = $data['hname'];
    $owner = $data['owner'];
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $landlord = $_POST['landlord'];
    $hname = $_POST['hname'];
    $haddress = $_POST['haddress'];
    $contactno = $_POST['contactno'];

    $file = $_FILES['image'];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileactualext = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileactualext, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = $fileName;
                $fileDestination = '../images/' . $fileNameNew;
                if ($fileNameNew > 0) {
                    move_uploaded_file($fileTmpName, $fileDestination);
                }

            } else {
                echo 'your file is too big.';
            }
        }
    } else {
        echo "you cannot upload this type of file";
    }

    $query = "UPDATE `boardinghouses` SET `owner`='$owner', `hname`='$hname', `haddress`='$haddress', `contact_no`='$contactno', `landlord`='$landlord' WHERE owner = '$owner'";
    $result = mysqli_query($conn, $query);
    if($result){

        $query = "UPDATE `bhapplication` SET `hname`='$hname' where owner = '$owner'";
        mysqli_query($conn, $query);

        $query = "UPDATE `description` SET `hname`='$hname' where owner = '$owner'";
        mysqli_query($conn, $query);

        $query = "UPDATE `documents` SET `hname`='$hname', `image`= 'images/$fileNameNew' where owner = '$owner'";
        mysqli_query($conn, $query);

        $query = "UPDATE `reports` SET `hname`='$hname' where owner = '$owner'";
        mysqli_query($conn, $query);

        $query = "UPDATE `reservation` SET `hname`='$hname' where owner = '$owner'";
        mysqli_query($conn, $query);

        $query = "UPDATE `rooms` SET `hname`='$hname' where owner = '$owner'";
        mysqli_query($conn, $query);

    }

    $query = "UPDATE `users` SET `hname`='$hname' WHERE uname = '$owner'";
    mysqli_query($conn, $query);


 

    header("location: ../manageboardinghouse.php");
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $query = "select * from boardinghouses where id = $id";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);
    $hname = $fetch['hname'];

    $query = "DELETE FROM `boardinghouses` WHERE hname = '$hname'";
    $result = mysqli_query($conn, $query);
    if($result){
        $query = "DELETE FROM `documents` WHERE hname = '$hname'";
        $result = mysqli_query($conn, $query);
    
        $query = "DELETE FROM `description` WHERE hname = '$hname'";
        $result = mysqli_query($conn, $query);

        $query = "UPDATE `users` SET hname = '' WHERE hname = '$hname'";
        $result = mysqli_query($conn, $query);
    }
    
    header("location: ../manageboardinghouse.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update <?php echo $data['hname']; ?></title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link rel="stylesheet" href="register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #e6e6e6; /* Background color */
        }
    </style>

</head>
        <?php ?>
<body>
    <div class="container-fluid">
        <div class="row" style="padding-top: 5%;">
            <div class="col-md-4"></div>
            <div class="col-md-4" style="text-align: center; background-color: #a9a9a9; border-radius: 20px; padding: 10px;">
                <div class="row">
                    <div class="col-md-12" style="padding-bottom: 15px;">
                        <img src="../images/logo.png" height="100px">
                    </div>
                    <div class="col-md-12">
                        <span style="font-weight: 100; font-size: 17px;">Update Boarding House</span>
                    </div>
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>Landlord Name</label>
                                    <input type="text" name="landlord" placeholder="Enter here.." class="form-control" value="<?php echo $data['landlord']; ?>" required>
                                </div>
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>House Name</label>
                                    <input type="text" name="hname" placeholder="Enter here.." class="form-control" value="<?php echo $data['hname']; ?>" required>
                                </div>
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>House Address</label>
                                    <input type="text" name="haddress" placeholder="Enter here.." class="form-control" value="<?php echo $data['haddress']; ?>" required>
                                </div>
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>Contact Number:</label>
                                    <input type="text" name="contactno" placeholder="Enter here.." class="form-control" value="<?php echo $data['contact_no']; ?>" required>
                                </div>
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>Image</label>
                                    <input type="file" name="image" placeholder="Enter here.." class="form-control" required>
                                </div>

                                <div class="col-md-12" style="text-align: center; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <button type="submit" name="update" class="btn btn-warning">Submit</button>
                                </div>
                                <div class="col-md-12" style="text-align: center; font-size: 13px; font-weight: 100;">
                                    <a href="../manageboardinghouse.php" style="text-decoration: none; color: black;">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>
