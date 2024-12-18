<?php 
require 'php/connection.php';

if(!empty($_SESSION["uname"]) && $_SESSION["role"] == 'landlord'){
    $uname = $_SESSION['uname'];
    $query = "select * from boardinghouses inner join documents on boardinghouses.hname = documents.hname where boardinghouses.owner = '$uname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);   
    echo "
    <script src='jquery.min.js'></script>
    <link rel='stylesheet' href='toastr.min.css'/>
    <script src='toastr.min.js'></script>
    <script>
        $(document).ready(function() {
            // Check if the login message should be displayed
            " . (isset($_SESSION['login_message_displayed']) ? "toastr.success('Logged in Successfully');" : "") . "
        });
    </script>
    ";

    // Unset the session variable to avoid repeated notifications
    if (isset($_SESSION['login_message_displayed'])) {
        unset($_SESSION['login_message_displayed']);
    }
}else{
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>

</head>
<!-- Bootstrap CSS -->
    <style>
        /* Custom CSS */
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
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

        .content-background{
            background-color: white;
            margin: 60px 200px 90px 200px;
            border-radius: 10px;
        }

        .btn {
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
        }

        .back{
            height: 100px;
            display: flex;
            justify-content: right;
            align-items: center;
            margin-right: 50px;
        }.back a{
           height: auto;
        }

        .section2{
            height: 100px;
            display: flex;
            justify-content: left;
            align-items: center;
            margin: 0px 100px;
        }

        @media (max-width: 1000px){
            .section2{
                width: 100%;
                margin: 0px auto 0 auto;
            }
        }

        .section3{
            height: auto;
            display: flex;
            border-radius: 10px;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 5px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 20px;
        }

        @media (max-width: 1000px){
            .section3{
                justify-content: center;
            }
        }

        .section3::-webkit-scrollbar {
            display: none; /* For Chrome, Safari, and Opera */
        }

        .card{
            width: 320px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 10px 20px #aaaaaa;
            margin: 20px;
            display: flex;
            flex-direction: column; /* Ensure the flex direction is column */
            justify-content: space-between; /* Align items to the bottom */
            padding-bottom: 10px;
            height: auto;
        }

        .card img{
            width: 100%;
            height: auto;
        }
        
        .card-content{
            padding: 16px;
        }

        .card-content h5{
            font-size: 28px;
            margin-bottom: 8px;
        }

        .card-content p{
            color: black;
            font-size: 15px;
            margin-bottom: 8px;
        }
        
        .room-btn{
            margin-top: 20px;
        }

        .card-content a{
            margin-top: 20px;
        }

    </style>
<body>
    <?php include 'navigationbar.php'; ?>


    <div class="section2">
        <div class="button">
            <a href='php/bedfunction.php' class='btn'>Add Rooms</a>
        </div>
    </div>
            
    <div class="section3">            
        <?php 
            $hname = $_SESSION['hname'];
            $roomno = $_GET['roomno'];
            $_SESSION['roomno'] = $roomno;

            $query = "SELECT * FROM beds WHERE hname = '$hname' and roomno = '$roomno' order by roomno ";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {  // Check if there are any results
                while ($fetch = mysqli_fetch_assoc($result)) {
                    $id = $fetch['id'];
        ?>
            <div class="card">
                <img src="<?php echo $fetch['bed_img']?>" width="20%" class="card-img-top" alt="Room Image">
                <div class="card-content">
                    <h5>Bed No: <?php echo $fetch['bed_no']?></h5>
                    <p>Bed Status: <?php echo $fetch['bed_stat']?></p>
                    <div class="room-btn"> 
                        <a href='php/bedfunction.php?bupdate=<?php echo $id;?>' class='btn btn-warning'>Update</a>
                        <a href='php/bedfunction.php?bdelete=<?php echo $id;?>' class='btn btn-danger'>Delete</a>      
                    </div>
                </div> 
            </div>     
        <?php } } ?>
    </div>
                           
     

</body>
</html>


<div class="form-col">
                <label for="addons">Select Specific Beds</label>
                <div>
                    <?php 
                        $hname = $_SESSION['hname'];
                        if (!empty($_SESSION["roomno"])) {
                            $roomno = $_SESSION['roomno'];
                        } else {
                            $roomno = $_GET['roomno'];
                        }
                        $query = "SELECT bed_no, bed_stat FROM beds WHERE roomno = $roomno and hname = '$hname'";
                        $result = mysqli_query($conn, $query);

                        // Store available beds in an array
                        $beds = [];
                        while ($bed = mysqli_fetch_assoc($result)) {
                            if ($bed['bed_stat'] === 'Available') {
                                $beds[] = $bed;
                            }
                        }
                    ?>
                    <?php foreach ($beds as $bed): ?>
                        <div>
                            <input type="checkbox" class="bed-checkbox" name="specific_beds[]" value="<?= $bed['bed_no'] ?>" onchange="updateBedCounter(this)"> 
                            <label for="bed_<?= $bed['bed_no'] ?>">Bed <?= $bed['bed_no'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-col">
                <label for="addons">Select Multiple Beds</label>
                <div>
                    <?php 
                        $hname = $_SESSION['hname'];
                        if (!empty($_SESSION["roomno"])) {
                            $roomno = $_SESSION['roomno'];
                        } else {
                            $roomno = $_GET['roomno'];
                        }
                        $query = "SELECT bed_no, bed_stat FROM beds WHERE roomno = $roomno and hname = '$hname'";
                        $result = mysqli_query($conn, $query);

                        // Store available beds in an array
                        $beds = [];
                        while ($bed = mysqli_fetch_assoc($result)) {
                            if ($bed['bed_stat'] === 'Available') {
                                $beds[] = $bed;
                            }
                        }
                    ?>
                    <?php for ($i = 2; $i <= count($beds); $i++): ?>
                        <div>
                            <input type="checkbox" class="bed-checkbox" name="multiple_beds[]" value="<?= $i ?>" onchange="updateBedCounter(this)"> 
                            <label for="multiple_bed_<?= $i ?>">Select <?= $i ?> Beds</label>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            