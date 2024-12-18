<?php
require 'connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    header("location: ../index.php");
}

$fileErrorMessage = "";
$showModal = false;

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $gender = $_POST['gender'];
    $tenantstatus = $_POST['tenant_status'];
    $school = $_POST['school'];
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

    if (!in_array($fileactualext, $allowed)) {
        $fileErrorMessage = "Invalid file type! Only JPG, JPEG, and PNG are allowed.";
        $showModal = true;
    } elseif ($fileError !== 0) {
        $fileErrorMessage = "There was an error uploading your file.";
        $showModal = true;
    } elseif ($fileSize >= 1000000) {
        $fileErrorMessage = "File size is too large! Maximum size is 1MB.";
        $showModal = true;
    } else {
        $fileNameNew = uniqid('', true) . '.' . $fileactualext;
        $fileDestination = '../profiles/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
    }

    $query = "SELECT * FROM `users` WHERE uname = '$uname'";
    $result = mysqli_query($conn, $query);
    $errors = array();

    if (empty($fname) || empty($lname) || empty($uname) || empty($pass) || empty($conpassword)) {
        $fileErrorMessage = "Please fill out all required fields.";
        $showModal = true;
    } elseif (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
        $fileErrorMessage = "Invalid email format.";
        $showModal = true;
    } elseif (strlen($pass) < 3) {
        $fileErrorMessage = "Password must be at least 3 characters long.";
        $showModal = true;
    } elseif ($pass !== $conpassword) {
        $fileErrorMessage = "Passwords do not match.";
        $showModal = true;
    } elseif ($result && mysqli_num_rows($result) > 0) {
        $fileErrorMessage = "Email already exists.";
        $showModal = true;
    }

    if (empty($fileErrorMessage) && !$showModal) {
        $query = "INSERT INTO `users`(`id`, `image`, `fname`, `lname`, `gender`, `tenant_status`, `school`, `uname`, `pass`, `role`) VALUES 
                  ('', 'profiles/$fileNameNew','$fname','$lname', '$gender', '$tenantstatus', '$school', '$uname','$pass', 'user')";
        mysqli_query($conn, $query);
        $fileErrorMessage = "Registration successful!";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            background-color: #e6e6e6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 30%;
            margin: 5% auto;
            background-color: #a9a9a9;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container img {
            width: 50%;
        }

        .container span {
            font-size: 17px;
            font-weight: 100;
            display: block;
            margin-bottom: 20px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 200;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
            color: #000;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #e6b800;
        }

        .links {
            margin-top: 10px;
            font-size: 13px;
            font-weight: 100;
        }

        .links a {
            text-decoration: none;
            color: black;
        }

        .links a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
    .container {
        max-width: 90%; /* Adjust container width for smaller screens */
        padding: 15px;
        margin: 10% auto;
    }

    .container img {
        width: 60%; /* Adjust logo size */
    }

    .form-group input,
    .form-group select,
    .btn {
        font-size: 12px; /* Adjust font size for inputs and buttons */
        padding: 8px; /* Add consistent padding */
    }

    .form-group label {
        font-size: 12px;
    }

    .links {
        font-size: 12px;
    }

    .modal-body p {
        font-size: 14px;
    }

    #addSchoolBtn,
    #addStatusBtn {
        font-size: 12px;
        padding: 6px 10px;
    }
}

@media (max-width: 480px) {
    .container img {
        width: 70%; /* Smaller logo for very small screens */
    }

    .form-group input,
    .form-group select,
    .btn {
        font-size: 10px;
        padding: 6px;
    }

    .btn {
        font-size: 10px;
        padding: 8px 12px;
    }

    .links a {
        font-size: 11px;
    }
}

        
    </style>
</head>
<body>
    <div class="container">
        <img src="../images/0.png" alt="Logo">
        <span>Registration Form</span>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Picture</label>
                <input type="file" name="image" value="">
            </div>
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" placeholder="Last Name" required>
            </div>
            <div class="form-group">
                <label for="uname">Email</label>
                <input type="email" id="uname" name="uname" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <label class="form-label">Gender</label>
                <select name="gender" id="" class="form-select me-2" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-col">
                <label class="form-label">Status</label>
                <div class="d-flex align-items-center">
                    <select id="statusDropdown" name="tenant_status" class="form-select me-2" required>
                        <option value="">Select Status</option>
                        <option value="Student">Student</option>
                        <option value="Worker">Worker</option>
                        <option value="Working Student">Working Student</option>
                    </select>
                    <button type="button" id="addStatusBtn" class="btn btn-primary">Add</button>
                </div>
                <!-- Hidden section for adding a new status -->
                <div id="addStatusDiv" class="mt-3 d-none">
                    <input type="text" id="newStatusInput" class="form-control mb-2" placeholder="Enter new status">
                    <div class="d-flex justify-content-end">
                        <button type="button" id="saveStatusBtn" class="btn btn-success me-2">Save</button>
                        <button type="button" id="cancelStatusBtn" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="schoolDropdown">School</label>
                <select id="schoolDropdown" name="school" class="form-select" disabled>
                    <option value="">Select School</option>
                    <option value="CKCM">CKCM</option>
                    <option value="NCMC">NCMC</option>
                    <option value="LSSTI">LSSTI</option>
                </select>
                
                <!-- Add School Button, shown when dropdown is enabled -->
                <button type="button" id="addSchoolBtn" class="btn btn-outline-primary mt-2" style="display:none;">Add School</button>

                <!-- Form to Add New School, initially hidden -->
                <div class="form-group mt-3 d-none" id="newSchoolForm">
                    <input type="text" id="newSchoolInput" class="form-control mb-2" placeholder="Enter new school name" />
                    <div class="d-flex">
                        <button type="button" id="saveSchoolBtn" class="btn btn-success me-2">Save</button>
                        <button type="button" id="cancelSchoolBtn" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" id="pass" name="pass" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
            </div>
            <button type="submit" name="submit" class="btn">Register</button>
        </form>
        <div class="links">
            <a href="login.php">Already have an Account? Login Now</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p id="modalMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modalConfirmButton" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if ($showModal): ?>
            var modal = new bootstrap.Modal(document.getElementById('responseModal'));
            document.getElementById('modalMessage').innerText = "<?= $fileErrorMessage ?>";
            modal.show();

            // Redirect to login if registration is successful
            <?php if ($fileErrorMessage === "Registration successful!"): ?>
                document.getElementById('modalConfirmButton').addEventListener('click', function () {
                    window.location.href = "login.php";
                });
            <?php endif; ?>
        <?php endif; ?>
    });
</script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusDropdown = document.getElementById('statusDropdown');
            const schoolDropdown = document.getElementById('schoolDropdown');
            const addSchoolBtn = document.getElementById('addSchoolBtn');
            const newSchoolForm = document.getElementById('newSchoolForm');
            const newSchoolInput = document.getElementById('newSchoolInput');
            const saveSchoolBtn = document.getElementById('saveSchoolBtn');
            const cancelSchoolBtn = document.getElementById('cancelSchoolBtn');

            // Enable/disable dropdown and show/hide add button based on Status selection
            statusDropdown.addEventListener('change', function () {
                const selectedStatus = statusDropdown.value;

                if (selectedStatus.toLowerCase().includes('student')) {
                    schoolDropdown.disabled = false;
                    schoolDropdown.classList.remove('disabled');
                    addSchoolBtn.style.display = 'inline-block'; // Show Add button
                } else {
                    schoolDropdown.disabled = true;
                    schoolDropdown.value = '';
                    schoolDropdown.classList.add('disabled');
                    addSchoolBtn.style.display = 'none'; // Hide Add button
                    newSchoolForm.classList.add('d-none');
                }
            });

            // Show form to add a new school
            addSchoolBtn.addEventListener('click', function () {
                newSchoolForm.classList.remove('d-none');
                addSchoolBtn.style.display = 'none'; // Hide Add button when form is shown
            });

            // Save the new school
            saveSchoolBtn.addEventListener('click', function () {
                const newSchoolName = newSchoolInput.value.trim();

                if (newSchoolName) {
                    const newOption = document.createElement('option');
                    newOption.value = newSchoolName;
                    newOption.textContent = newSchoolName;

                    schoolDropdown.appendChild(newOption); // Add to dropdown
                    schoolDropdown.value = newSchoolName; // Select the newly added school
                    newSchoolInput.value = ''; // Clear input

                    alert(`${newSchoolName} has been added to the list of schools.`);
                } else {
                    alert('Please enter a valid school name.');
                }

                newSchoolForm.classList.add('d-none');
                addSchoolBtn.style.display = 'inline-block'; // Show Add button again
            });

            // Cancel adding a new school
            cancelSchoolBtn.addEventListener('click', function () {
                newSchoolInput.value = ''; // Clear input
                newSchoolForm.classList.add('d-none');
                addSchoolBtn.style.display = 'inline-block'; // Show Add button again
            });
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addStatusBtn = document.getElementById('addStatusBtn');
            const addStatusDiv = document.getElementById('addStatusDiv');
            const saveStatusBtn = document.getElementById('saveStatusBtn');
            const cancelStatusBtn = document.getElementById('cancelStatusBtn');
            const newStatusInput = document.getElementById('newStatusInput');
            const statusDropdown = document.getElementById('statusDropdown');

            // Toggle the addStatusDiv visibility
            addStatusBtn.addEventListener('click', function () {
                if (addStatusDiv.classList.contains('d-none')) {
                    addStatusDiv.classList.remove('d-none');
                } else {
                    addStatusDiv.classList.add('d-none');
                }
            });

            // Save new status
            saveStatusBtn.addEventListener('click', function () {
                const newStatus = newStatusInput.value.trim();
                if (newStatus) {
                    // Create a new option and add it to the dropdown
                    const newOption = document.createElement('option');
                    newOption.value = newStatus;
                    newOption.textContent = newStatus;
                    statusDropdown.appendChild(newOption);

                    // Reset input and hide the addStatusDiv
                    newStatusInput.value = '';
                    addStatusDiv.classList.add('d-none');
                } else {
                    alert('Please enter a valid status.');
                }
            });

            // Cancel the addition of a new status
            cancelStatusBtn.addEventListener('click', function () {
                newStatusInput.value = ''; // Clear the input field
                addStatusDiv.classList.add('d-none'); // Hide the div
            });
        });
    </script>
</body>
</html>
