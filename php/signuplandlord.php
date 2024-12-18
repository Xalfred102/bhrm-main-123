<?php
require 'connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    header("location: ../index.php");
}

$showModal = false;
$modalMessage = "";

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $gender = $_POST['gender'];
    $pass = $_POST['pass'];
    $conpassword = $_POST['confirmpassword'];

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
                $fileNameNew = uniqid('', true) . '.' . $fileactualext;
                $fileDestination = '../profiles/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo "Your file is too big.";
            }
        }
    } else {
        echo "You cannot upload this type of file.";
    }

    $query = "SELECT * FROM `users` WHERE uname = '$uname'";
    $result = mysqli_query($conn, $query);
    $errors = array();

    if (empty($fname) && empty($lname) && empty($uname) && empty($pass) && empty($conpassword)) {
        array_push($errors, "Missing all fields");
    } elseif (empty($fname)) {
        array_push($errors, "Missing First Name");
    } elseif (empty($lname)) {
        array_push($errors, "Missing Last Name");
    } elseif (empty($uname)) {
        array_push($errors, "Missing Email");
    } elseif (empty($pass)) {
        array_push($errors, "Missing Password");
    } elseif (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid.");
    } elseif (strlen($pass) < 3) {
        array_push($errors, "Password must be 8 characters long.");
    } elseif ($pass !== $conpassword) {
        array_push($errors, "Password didn't match.");
    } elseif ($result && mysqli_num_rows($result) > 0) {
        array_push($errors, "Email already exists.");
    }

    if (count($errors) > 0) {
        $modalMessage = implode("<br>", $errors); // Combine error messages with line breaks
        $showModal = true;
    } else {
        $query = "INSERT INTO `users`(`id`, `image`, `fname`, `lname`,`uname`, `gender`, `pass`, `role`) VALUES 
                                    ('', 'profiles/$fileNameNew', '$fname','$lname','$uname','$gender','$pass', 'landlord')";
        mysqli_query($conn, $query);
        $modalMessage = "Registration successful!";
        $showModal = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRATION</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link rel="stylesheet" href="register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #e6e6e6; 
            padding: 10px;
        }

        .form-container {
            background-color: #a9a9a9;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 16px;
            border-radius: 8px;
        }

        /* Custom responsive styles */
        @media (max-width: 768px) {
            .form-container {
                padding: 10px;
            }

            input, select, button {
                font-size: 14px;
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            img {
                height: 70px;
            }

            h4 {
                font-size: 18px;
            }

            .form-label {
                font-size: 12px;
            }

            .btn {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 col-lg-6">
                <div class="text-center form-container">
                    <div class="mb-3">
                        <img src="../images/0.png" height="100px" alt="Logo">
                    </div>
                    <h4 class="text-first mb-4">Registration Form</h4>
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3 text-start">
                            <label for="image" class="form-label">Picture</label>
                            <input type="file" id="image" name="image" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="uname" class="form-label">Email</label>
                            <input type="email" id="uname" name="uname" placeholder="Your Email" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" id="pass" name="pass" placeholder="Password" class="form-control" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-warning">Register</button>
                        </div>
                        <div class="text-center mt-3">
                            <a href="login.php" class="text-decoration-none text-secondary">Already have an Account? Login Now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p><?= $modalMessage ?></p>
                    <button type="button" class="btn btn-warning" id="modalConfirmButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($showModal): ?>
            var modal = new bootstrap.Modal(document.getElementById('responseModal'));
            modal.show();
        <?php endif; ?>

        document.getElementById('modalConfirmButton').addEventListener('click', function () {
            <?php if ($modalMessage === "Registration successful!"): ?>
                window.location.href = "login.php";
            <?php else: ?>
                var modalInstance = bootstrap.Modal.getInstance(document.getElementById('responseModal'));
                modalInstance.hide();
            <?php endif; ?>
        });
    </script>
</body>
</html>
