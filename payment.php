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
    <title>RESERVATION</title>
      <!-- DataTables CSS -->
      <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">

        <!-- jQuery (necessary for DataTables) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</head>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        a{
            text-decoration: none;
            color: black;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            margin-left: 220px; /* Offset for the navbar */
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        button:disabled {
            background-color: #ccc; /* Light gray background */
            color: #666; /* Darker gray text */
            border: 1px solid #999; /* Gray border */
            cursor: not-allowed; /* Change cursor to indicate it's not clickable */
            opacity: 0.6; /* Slightly transparent */
        }

        button:hover {
            background-color: #0056b3;
        }

        button.login {
            width: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }.login a{
            color: white;
        }

        /* Reject button style */
        button.reject {
            background-color: #dc3545; /* Bootstrap danger color */
        }

        button.reject:hover {
            background-color: #c82333; /* Darker shade on hover */
        }


    </style>

<body>
    <?php include 'navigationbar.php'; ?>

    <?php 
        if (!empty($_SESSION) && $_SESSION['role'] == 'landlord') {
            $hname = $_SESSION['hname'];

            // Fetch all confirmed reservations
            $query = "SELECT * FROM reservation WHERE hname = '$hname' AND res_stat = 'Confirmed' order by id desc";
            $result = mysqli_query($conn, $query);
            $confirmedReservations = []; // Array to store emails of confirmed reservations

            while ($fetch = mysqli_fetch_assoc($result)) {
                $confirmedReservations[] = $fetch['email']; // Store each email
            }
        }
    ?>
    <?php if (!empty($_SESSION) && $_SESSION['role'] == 'landlord'): ?>
        <h1>Payment Details</h1>
    <?php endif; ?>

    <div class="container">
    <?php 
    if (!empty($_SESSION) && $_SESSION['role'] == 'landlord' && !empty($confirmedReservations)) {
        foreach ($confirmedReservations as $uname) {
            // Fetch payment details for each confirmed reservation
            $query = "SELECT * FROM payments WHERE hname = '$hname' AND email = '$uname' ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            while ($fetch = mysqli_fetch_assoc($result)) {
    ?>
    <div class="card">
        <div class="card-header">
            Payment #<?php echo $fetch['id']; ?>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> <?php echo $fetch['email']; ?></p>
            <p><strong>Room Number:</strong> <?php echo $fetch['room_no']; ?></p>
            <p><strong>Room Rent (Whole Room):</strong> <?php echo $fetch['price']; ?></p>
            <p><strong>Room Rent (By Slots):</strong> <?php echo $fetch['slot_price']; ?></p>
            <p><strong>Payment:</strong> <?php echo $fetch['payment']; ?></p>
            <p><strong>Status:</strong> <?php echo $fetch['pay_stat']; ?></p>
            <p><strong>Date:</strong> <?php echo $fetch['pay_date']; ?></p>
        </div>
        <div class="button-row">
            <a href="php/payfunction.php?id=<?php echo $fetch['id']; ?>">
                <button>Edit</button>
            </a>
            
        </div>
    </div>
    <?php 
            }
        } 
    } 
    ?>
</div>


    <style>
        .container{
            margin: 0 250px;
            width: auto;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr;
            overflow-y: scroll;
            overflow-x: scroll;
            height: auto;
        } h1{
            text-align: center;
        }
        .container::-webkit-scrollbar {
            display: none; /* For Chrome, Safari, and Opera */
        }.container.second-container{
            margin: 0 250px;
            width: auto;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr;
            overflow-y: scroll;
            overflow-x: scroll;
            height: auto;
        } 

        @media (max-width: 479px){
            .container{
                width: auto;
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-template-rows: 1fr;
                overflow-y: scroll;
                overflow-x: scroll;
                height: auto;
            }
        }

        .card {
        margin: 20px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background-color: #f8f9fa; /* Light gray */
        padding: 10px;
        border-bottom: 1px solid #dee2e6; /* Light border */
        font-weight: bold;
        font-size: 18px;
        color: #333;
        text-align: center;
    }

    .card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .card-body p {
        margin: 0;
        font-size: 14px;
        color: #555;
    }

    .button-row {
        display: flex;
        justify-content: flex-end;
        margin-top: 15px;
    }

    button {
        padding: 8px 12px;
        font-size: 14px;
        color: #fff;
        background-color: #ffc107; /* Bootstrap primary color */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #b78c0c;
    }
    </style>
  
</body>
</html>
