<?php
require 'connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    echo '';
} else {
    header("location: ../index.php");
}

if (isset($_POST['submit'])) {
    $owner = $_POST['owner'];
    $hname = $_POST['hname'];
    $haddress = $_POST['haddress'];

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
            if ($fileSize < 1000000000000) {
                $fileNameNew = $fileName;
                $fileDestination = '../images/' . $fileNameNew;
                if ($fileNameNew > 0) {
                    move_uploaded_file($fileTmpName, $fileDestination);
                }
            } else {
                echo "your file is too big.";
            }
        }
    } else {
        echo "you cannot upload this type of file";
    }

    $query = "INSERT INTO `boardinghouses` (`id`, `owner`, `hname`, `haddress`, `image`) VALUES ('','$owner','$hname','$haddress','images/$fileNameNew')";
    mysqli_query($conn, $query);

    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Boarding House</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link rel="stylesheet" href="register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #e6e6e6; /* Background color */
        }
    </style>

</head>
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
                        <span style="font-weight: 100; font-size: 17px;">Add Boarding House</span>
                    </div>
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>House Owner</label>
                                    <input type="text" name="owner" placeholder="Enter here.." class="form-control" required>
                                </div>
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>House Name</label>
                                    <input type="text" name="hname" placeholder="Enter here.." class="form-control" required>
                                </div>
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>House Address</label>
                                    <input type="text" name="haddress" placeholder="Enter here.." class="form-control" required>
                                </div>
                                <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <label>Image</label>
                                    <input type="file" name="image" placeholder="Enter here.." class="form-control" required>
                                </div>
                                
                                <div class="col-md-12" style="text-align: center; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                                    <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                                </div>
                                <div class="col-md-12" style="text-align: center; font-size: 13px; font-weight: 100;">
                                    <a href="../index.php" style="text-decoration: none; color: black;">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.