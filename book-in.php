<?php

require 'php/connection.php';

if (!empty($_SESSION["hname"])) {
    if (!empty($_SESSION["roomno"])){
        $roomno = $_SESSION['roomno'];
    }else{
        $roomno = $_GET['roomno'];
    }
    $uname = $_SESSION['uname'];
    $hname = $_SESSION['hname'];
    
    // Fetch the latest reservation for the user
    $query = "SELECT * FROM reservation WHERE email = '$uname' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_assoc($result);
        
        if (!empty($fetch['res_stat']) && ($fetch['res_stat'] == 'Pending' || $fetch['res_stat'] == 'Approved' || $fetch['res_stat'] == 'Confirmed') ) {
            // Block users with 'Pending' or 'Approved' status in their latest reservation
            $_SESSION['already_booked'] = true;
            header("location: boardinghouse.php?hname=$hname");
            exit();
        } else if ($fetch['res_stat'] == 'Rejected') {
            // Allow users with 'Rejected' status to proceed
            unset($_SESSION['already_booked']);
        } else if ($fetch['res_stat'] == 'Cancelled') {
            // Allow users with 'Rejected' status to proceed
            unset($_SESSION['already_booked']);
        }   else if ($fetch['res_stat'] == 'Ended') {
            // Allow users with 'Rejected' status to proceed
            unset($_SESSION['already_booked']);
        }
    } else {
        // Handle no results case
        echo '';
    }
}


if(!empty($_SESSION["uname"]) && !empty($_SESSION["role"])){
    $hname = $_SESSION['hname'];
    if (!empty($_SESSION["roomno"])){
        $roomno = $_SESSION['roomno'];
    }else{
        $roomno = $_GET['roomno'];
    }
    $query = "select * from rooms where room_no = '$roomno' and hname = '$hname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);   
    $roomno = $fetch['room_no']; 
    $roomimg = $fetch['image'];
    $roomcapacity = $fetch['capacity'];
    $currenttenant = $fetch['current_tenant'];
    $amenities = $fetch['amenities'];
    $roomprice = $fetch['price'];
    $roomslotprice = $fetch['slot_price'];
    $roomstat = $fetch['status'];

    if($result){
        $uname = $_SESSION['uname'];
        $query = "select * from users where uname = '$uname'";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result);
        $fname = $fetch['fname'];
        $lname = $fetch['lname'];
        $gender = $fetch['gender'];
        $tenantstatus = $fetch['tenant_status'];
        $school = $fetch['school'];
    }if($result){
        $hname = $_SESSION['hname'];
        $query = "select * from rooms where hname = '$hname'";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result);
    }
}else{
    $_SESSION['login_warning'] = true;
    header('location: index.php');
    exit(); // Prevent further script execution
}

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $datein = $_POST['datein'];
    $dateout = $_POST['dateout'];
    $tenantstatus = $_POST['tenant_status'];
    $school = $_POST['school'];
    $addons = $_POST['addons'];
    $roomno = $_GET['roomno'];
    $capacity = $roomcapacity;
    $selected_slots = isset($_POST['slots']) ? $_POST['slots'] : [];
    $slots = implode(", ", $selected_slots); // Join slots into a single string for storage
    $currenttent = $currenttenant;
    $amenities = $fetch['amenities'];
    $tenanttype = $fetch['tenant_type'];
    $image = $fetch['image'];
    $roomfloor = $fetch['room_floor'];
    $price = $roomprice;
    $slotprice = $roomslotprice;
    $status = $fetch['status'];
    $hname = $_SESSION['hname'];

    // Fetch boarding house details
    $query = "SELECT * FROM boardinghouses WHERE hname = '$hname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);
    $owner = $fetch['owner'];

    // Insert the reservation
    $query = "INSERT INTO `reservation` 
              (`id`, `fname`, `lname`, `email`, `gender`, `date_in`, `date_out`, `tenant_status`, `school`, `addons`, `room_no`, `capacity`, `room_slot`, `current_tenant`, `amenities`, `tenant_type`, `room_floor`, `price`, `slot_price`, `image`, `status`, `res_stat`, `res_duration`, `res_reason`, `hname`, `owner`) VALUES 
              ('', '$fname', '$lname', '$email', '$gender', '$datein', '$dateout', '$tenantstatus', '$school', '$addons', '$roomno', '$capacity', '$slots', '$currenttent', '$amenities', '$tenanttype', '$roomfloor', '$price', '$slotprice', '$image', '$status', 'Pending', '', '', '$hname', '$owner')";
    mysqli_query($conn, $query);

    // Use a session variable to trigger the modal
    $_SESSION['booking_success'] = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book In!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- External CSS -->
</head>
    <style>
       body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

.background {
    padding: 20px;
    max-width: 1000px;
    width: 100%;
    margin: 50px auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn {
    color: rgb(255, 255, 255);
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    background-color: #007bff;
}

button {
    grid-column: span 2;
    background-color: #ffaa00;
    border: none;
    padding: 15px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    color: white;
}

button:hover {
    background-color: #bb7d01;
}

/* Flex and grid layout adjustments */
.form-col {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

input[type="text"], input[type="email"], input[type="date"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    padding: 20px;
    width: 100%;
    box-sizing: border-box;
}

/* Making the modal responsive */
.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 600px;
}

/* Ensuring buttons scale properly */
.preview-btn, .btn {
    padding: 10px 20px;
    background-color: #ffaa00 ;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.preview-btn:hover {
    background-color: #bb7d01;
}

button:hover {
    background-color: #bb7d01;
}

/* Media queries for smaller devices */
@media (max-width: 768px) {
    .form {
        grid-template-columns: 1fr;
    }
    .background {
        width: 95%;
        margin: 20px auto;
    }
    .centering {
        flex-direction: column;
        width: 100%;
    }
    .modal-content {
        width: 90%;
    }
}

@media (max-width: 576px) {
    button {
        width: 100%;
    }
    .preview-btn {
        width: 100%;
        margin-top: 10px;
    }
    .form-col label {
        font-size: 14px;
    }
    .form-col input {
        font-size: 14px;
    }
}

/* Adjusting grid for small devices */
@media (max-width: 400px) {
    .form-col {
        font-size: 14px;
    }
}

    </style>
<body>
<?php include 'navbar.php'; ?>

<div class="background">
       

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            position: relative;
            max-width: 600px;
            max-height: 80%;
            width: 90%;
            overflow-y: auto; /* Enables scrolling inside the modal */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky; /* Keeps header visible while scrolling */
            top: 0;
            background-color: white;
            z-index: 10;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .modal-header h2 {
            margin: 0;
        }

        .close {
            font-size: 1.5rem;
            font-weight: bold;
            color: black;
            border: none;
            background: none;
            cursor: pointer;
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .room-details {
            text-align: center;
            margin-bottom: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }

        .bed-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 10px;
            width: 100%;
        }

        .bed-card {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }

        .bed-card img {
            max-width: 100%;
            border-radius: 4px;
        }

        .preview-btn {
            padding: 10px 20px;
            background-color: #ffaa00;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .preview-btn:hover {
            background-color: #bb7d01;
        }

        .centering {
            display: flex;
            justify-content: space-between; /* Align items to the sides */
            width: 300px; /* Adjust as needed */
            margin: 20px auto;
        }
    </style>



        <div class="centering">
            <button id="backButton" class="preview-btn">Back</button>
            <button id="previewButton" class="preview-btn">Preview</button>
        </div>

    <div id="infoModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Room Details</h2>
                <button class="close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="room-details">
                    <h5>Selected Room: <?php echo $roomno ?></h5>
                    <img src="<?php echo $roomimg ?>" alt="Room Image">
                    <p>Room Capacity: <?php echo $roomcapacity ?></p>
                    <p>Current Tenant: <?php echo $currenttenant ?></p>
                    <p>Room Amenities: <?php echo $amenities ?></p>
                    <p>Room Rent (Whole Room): <?php echo $roomprice ?></p>
                    <p>Room Rent (By Slots): <?php echo $roomslotprice ?></p>
                    <p>Room Status: <?php echo $roomstat ?></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('previewButton').addEventListener('click', function () {
            document.getElementById('infoModal').style.display = 'flex';
        });

        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('infoModal').style.display = 'none';
        });

        window.onclick = function (event) {
            const modal = document.getElementById('infoModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    </script>
        <script>
            document.getElementById('backButton').addEventListener('click', function () {
                window.history.back(); // Navigates to the previous page
            });
        </script>


    <div class="form">
        <form method="post">
            <div class="form-col">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" value="<?php echo $fname ?>" readonly>
            </div>
            <div class="form-col">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" value="<?php echo $lname ?>" readonly>
            </div>
            <div class="form-col">
                <label for="lname">Status</label>
                <input type="text" id="lname" name="tenant_status" value="<?php echo $tenantstatus ?>" readonly>
            </div>
            <div class="form-col">
                <label for="lname">Gender</label>
                <input type="text" id="lname" name="gender" value="<?php echo $gender ?>" readonly>
            </div>
            <div class="form-col">
                <label for="lname">School</label>
                <input type="text" id="lname" name="school" value="<?php echo $school ?>" readonly>
            </div>
            <div class="form-col">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['uname']; ?>" readonly>
            </div>
            <div class="form-col">
                <label for="datein">Date in</label>
                <input type="date" id="datein" name="datein" min="<?php echo date('Y-m-d'); ?>" oninput="this.min = new Date().toISOString().split('T')[0]">
            </div>
            <div class="form-col">
                <label for="dateout">Date out</label>
                <input type="date" id="dateout" name="dateout" required>
            </div>
            <div class="form-col">
                <label for="addons">Additional Requests (Optional)</label>
                <input type="text" id="addons" name="addons" >
            </div>

            <?php
                // Fetch room capacity and current tenant count from the database
                $roomQuery = "SELECT capacity, current_tenant FROM rooms WHERE room_no = '$roomno' AND hname = '$hname'";
                $roomResult = mysqli_query($conn, $roomQuery);
                $roomData = mysqli_fetch_assoc($roomResult);

                $roomCapacity = $roomData['capacity']; // Total capacity of the room
                $currentTenant = $roomData['current_tenant']; // Current tenants in the room
                $availableSlots = $roomCapacity - $currentTenant; // Remaining slots

                $checkbox_options = '';

                // Check if there are available slots
                if ($availableSlots > 0) {
                    // Show slots based on available capacity
                    for ($i = 1; $i <= $availableSlots; $i++) {
                        // Exclude the last slot if "Whole Room" option is available
                        if ($currentTenant == 0 && $i == $availableSlots) {
                            break; // Stop before adding the last slot when "Whole Room" will be added
                        }
                        $checkbox_options .= "
                            <div class='form-check'>
                                <input type='checkbox' class='form-check-input' id='slot_$i' name='slots[]' value='Slot $i'>
                                <label class='form-check-label' for='slot_$i'>Slot $i</label>
                            </div>";
                    }

                    // Add "Whole Room" only if the room is entirely vacant
                    if ($currentTenant == 0) {
                        $checkbox_options .= "
                            <div class='form-check'>
                                <input type='checkbox' class='form-check-input' id='whole_room' name='slots[]' value='Whole Room'>
                                <label class='form-check-label' for='whole_room'>Whole Room</label>
                            </div>";
                    }
                }
            ?>


            <div class="form-col">
                <label for="slots">Book Slots</label>
                <?php echo $checkbox_options; ?>
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <div id="thankYouModal" class="modal" style="display:none;">
        <div class="modal-content">
            <h2>Thank you for booking with us!</h2>
            <p>Your reservation has been successfully submitted.</p>
            <button id="okButton" class="btn">OK</button>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    <?php if (!empty($_SESSION['booking_success'])): ?>
                        // Show the modal
                        const modal = document.getElementById('thankYouModal');
                        modal.style.display = 'flex';

                        // Clear the session variable to prevent the modal from showing again
                        <?php unset($_SESSION['booking_success']); ?>

                        // Redirect to the homepage when clicking OK
                        document.getElementById('okButton').addEventListener('click', function () {
                            window.location.href = 'index.php'; // Change this to your homepage
                        });
                    <?php endif; ?>
                });
            </script>
        </div>
    </div>


    <style>
         .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-content h2 {
            margin-bottom: 10px;
        }

        .modal-content button {
            padding: 10px 20px ;
            padding-top: 15px;
            background-color: #ffaa00;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #ffaa00;
        }
            .form{
                border: 1px solid black;
                width: auto;
                display: flex;
                justify-content: center;
            }

                    
            form {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                padding: 20px;
                width: 600px;
            }

            .form-col{
                display: flex;
                flex-direction: column;
            }
            .form-col:last-child{
                grid-column-start: 1;
                grid-column-end: 3;

                display: flex;
                flex-direction: row;
            }

            label {
                margin-bottom: 5px;
                font-weight: bold;
            }

            input {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
    </style>

</div>

    <script>
            document.getElementById('whole_room').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="slots[]"]:not(#whole_room)');
            if (this.checked) {
                checkboxes.forEach(checkbox => checkbox.checked = false);
                checkboxes.forEach(checkbox => checkbox.disabled = true);
            } else {
                checkboxes.forEach(checkbox => checkbox.disabled = false);
            }
        });
    </script>

   
    
    <script>
        document.getElementById('datein').addEventListener('change', function() {
            calculateDateOut();
        });

        function calculateDateOut() {
            const dateInInput = document.getElementById('datein');
            const dateOutInput = document.getElementById('dateout');

            // Get the selected date from the "Date in" field
            let dateInValue = new Date(dateInInput.value);

            // Check if a valid date is selected
            if (isNaN(dateInValue)) return;

            // Add 30 days to the "Date in" value
            dateInValue.setDate(dateInValue.getDate() + 30);

            // Convert the new date to the correct format (YYYY-MM-DD)
            const dateOutValue = dateInValue.toISOString().split('T')[0];

            // Set the "Date out" field with the calculated date
            dateOutInput.value = dateOutValue;
        }
    </script>

    <script>
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="bed[]"]');
        const capacity = <?php echo $fetch['capacity']; ?>; // Room capacity fetched from PHP

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                const checkedCount = document.querySelectorAll('input[type="checkbox"][name="bed[]"]:checked').length;
                if (checkedCount > capacity) {
                    this.checked = false;
                    alert(`You can only book up to ${capacity} beds.`);
                }
            });
        });
    </script>
    
    <script>
        function updateBedCounter(checkbox) {
        const checkboxes = document.querySelectorAll('.bed-checkbox');
        const counter = document.getElementById('bed-counter');

        // Uncheck all other checkboxes
        checkboxes.forEach(box => {
            if (box !== checkbox) {
                box.checked = false;
            }
        });

        // Update counter text based on the selected checkbox
        counter.textContent = checkbox.checked ? '1 bed selected' : 'No bed selected';
    }
    </script>


</body>
</html>
