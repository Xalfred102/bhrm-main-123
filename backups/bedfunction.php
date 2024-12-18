<?php
require 'connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    echo '';
} else {
    header("location: ../index.php");
}

if (isset($_POST['submit'])) {
    $roomno = $_SESSION['roomno'];
    $bedno = $_POST['bedno'];
    $bedstat = $_POST['bedstat'];
    $bedprice = $_POST['bedprice'];

    $_FILES['image'];

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
                $fileDestination = '../beds/' . $fileNameNew;
                if ($fileNameNew > 0) {
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("location: ../managebeds.php?roomno=$roomno");
                }
            } else {
                echo "your file is too big.";
            }
        }
    } else {
        echo "you cannot upload this type of file";
    }

    $hname = $_SESSION['hname'];
    $roomno = $_SESSION['roomno'];
    $owner = $_SESSION['uname'];
    $query = "INSERT INTO `beds`(`id`, `roomno`, `bed_img`, `bed_no`, `bed_stat`, `bed_price`, `hname`, `owner`) VALUES 
                                ('','$roomno','beds/$fileNameNew','$bedno','$bedstat', '$bedprice', '$hname', '$owner')";
    mysqli_query($conn, $query);

    header("location: ../managebeds.php?roomno=$roomno");
}

$data = ['id' => '', 'room_no' => '', 'bed_img' => '', 'bed_no' => '', 'bed_stat' => '', 'bed_price' => ''];

if(isset($_GET['bupdate'])){
    $hname = $_SESSION['hname'];
    $id = $_GET['bupdate'];
    $roomno = $_SESSION['roomno'];
    $query = "SELECT * FROM `beds` WHERE id = $id and hname = '$hname' and roomno = '$roomno'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

// Delete rooms
if (isset($_GET['bdelete'])) {
    $hname = $_SESSION['hname'];
    $id = $_GET['bdelete'];
    $roomno = $_SESSION['roomno'];
    $query = "DELETE FROM beds WHERE id = $id and hname = '$hname' and roomno = $roomno";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("location: ../managebeds.php?roomno=$roomno");
    }
}

if(isset($_POST['update'])){
    $id = $_GET['bupdate'];
    $roomno = $_SESSION['roomno'];
    $bedno = $_POST['bedno'];
    $bedstat = $_POST['bedstat'];
    $bedprice = $_POST['bedprice'];

    $_FILES['image'];

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
                $fileDestination = '../beds/' . $fileNameNew;
                if ($fileNameNew > 0) {
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("location: ../managebeds.php?roomno=$roomno");
                }
            } else {
                echo "your file is too big.";
            }
        }
    } else {
        echo "you cannot upload this type of file";
    }

    $roomno = $_SESSION['roomno'];
    $query = "UPDATE `beds` SET `id`=$id,`roomno`='$roomno',`bed_img`='beds/$fileNameNew',`bed_no`='$bedno',`bed_stat`='$bedstat',`bed_price`='$bedprice',`hname`='$hname' WHERE id = $id and hname = '$hname' and roomno = $roomno";
    mysqli_query($conn, $query);

    header("location: ../managebeds.php?roomno=$roomno");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADDROOM</title>
    <style>
        body {
            background-color: #e6e6e6; /* Background color */
        }
    </style>
</head>
<body>
    <?php include '../navigationbar.php'; ?>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rooms</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }
        
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin-left: 220px; /* Offset for the navbar */
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Center vertically */
        }

        .form-container {
            width: 40%;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.15);
        }

        .form-container img {
            height: 80px;
            margin-bottom: 15px;
        }

        .form-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #444;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: calc(100% - 20px); /* Ensure it doesn't exceed container */
            padding: 10px;
            margin: 0 auto;
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease, background-color 0.3s ease;
            box-sizing: border-box; /* Include padding and border in width */
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="file"]:focus {
            border-color: #f0ad4e;
            background-color: #fff;
            outline: none;
        }

        .image-preview img {
            height: 100px;
            width: 100px;
            border-radius: 10px;
            object-fit: cover;
            margin-top: 10px;
        }

        .form-actions {
            text-align: center;
            margin-top: 20px;
        }

        .form-actions input[type="submit"],
        .form-actions a {
            display: inline-block;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .form-actions input[type="submit"] {
            background-color: #007bff; /* Blue color */
        }

        .form-actions input[type="submit"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: scale(1.05);
        }

        .form-actions a {
            background-color: #6c757d;
        }

        .form-actions a:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .form-container {
                width: 90%;
                padding: 20px;
            }

            .form-title {
                font-size: 20px;
            }

            .form-group input[type="text"],
            .form-group input[type="file"] {
                width: calc(100% - 20px); /* Maintain consistent width */
            }
        }
    </style>


</head>
<body>
    <div class="container">
        <div class="form-container">
            <img src="../images/logo.png" alt="Logo">
            <div class="form-title">Add Rooms</div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="roomno">Room No:</label>
                    <input 
                        type="text" 
                        id="roomno" 
                        name="roomno" 
                        value="<?php echo $_SESSION['roomno']; ?>" 
                        placeholder="Enter here.." 
                        readonly>
                </div>
                <div class="form-group">
                    <label for="image">Bed Image:</label>
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        value="<?php echo $data['bed_img']; ?>" 
                        placeholder="Enter here..">
                </div>
                <?php if ($data['id'] != '') : ?>
                <div class="image-preview">
                    <img src="../<?php echo $data['bed_img']; ?>" value="<?php echo $data['bed_img']; ?>" alt="Bed Image">
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="bedno">Bed No:</label>
                    <input 
                        type="text" 
                        id="bedno" 
                        name="bedno" 
                        value="<?php echo $data['bed_no']; ?>" 
                        placeholder="Enter here.." 
                        required>
                </div>
                <div class="form-group">
                    <label for="bedstat">Bed Status:</label>
                    <input 
                        type="text" 
                        id="bedstat" 
                        name="bedstat" 
                        value="Available" 
                        placeholder="Enter here.." 
                        readonly>
                </div>
                <div class="form-group">
                    <label for="bedprice">Bed Price:</label>
                    <input 
                        type="text" 
                        id="bedprice" 
                        name="bedprice" 
                        value="<?php echo $data['bed_price']; ?>" 
                        placeholder="Enter here.." 
                        required>
                </div>
                <div class="form-actions">
                    <?php if ($data['id'] != '') : ?>
                    <input 
                        type="submit" 
                        name="update" 
                        value="Update">
                    <?php else: ?>
                    <input 
                        type="submit" 
                        name="submit" 
                        value="Submit">
                    <?php endif; ?>
                    <a href="../managebeds.php?roomno=<?php echo $_SESSION['roomno']; ?>">Back</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


</body>
</html>
