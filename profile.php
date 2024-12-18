<?php

require 'php/connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    $uname = $_SESSION["uname"];
    $role = $_SESSION["role"];
    $result = mysqli_query($conn, "select * from users where uname = '$uname'");
    $fetch = mysqli_fetch_assoc($result);
}else{
    header("location: index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_changes'])) {
        // Update the database with the new information
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        $new_password = !empty($_POST['pass']) ? password_hash($_POST['pass'], PASSWORD_DEFAULT) : $fetch['pass'];

        // Initialize image variables
        $fileNameNew = null;

        // Check if a new file was uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileType = $_FILES['image']['type'];

            // Validate the file extension
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileExt, $allowed)) {
                // Check for errors and size limits
                if ($fileSize < 2000000) { // Limit to 2MB
                    $fileNameNew = uniqid('profile_', true) . '.' . $fileExt;
                    $fileDestination = './profiles/' . $fileNameNew;

                    // Move the uploaded file to the destination folder
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // Delete the old profile image if it exists
                        if (!empty($fetch['image']) && file_exists($fetch['image'])) {
                            unlink($fetch['image']);
                        }
                    } else {
                        echo "<p>Failed to upload the new profile picture.</p>";
                    }
                } else {
                    echo "<p>The uploaded file is too large. Please upload a file smaller than 2MB.</p>";
                }
            } else {
                echo "<p>Invalid file type. Only JPG, JPEG, and PNG files are allowed.</p>";
            }
        }

        // If a new image was uploaded, update the image in the query
        $imageQuery = $fileNameNew ? ", `image` = './profiles/$fileNameNew'" : "";

        $update_query = "UPDATE users SET fname='$fname', lname='$lname', uname='$uname', pass='$pass' $imageQuery WHERE uname = '$uname'";
        if (mysqli_query($conn, $update_query)) {
            echo "<p>Profile updated successfully!</p>";
            // Optionally refresh the page to show updated data
            header("Location: profile.php");
            exit;
        } else {
            echo "<p>Error updating profile.</p>";
        }
    } elseif (isset($_POST['cancel_edit'])) {
        // Redirect or simply refresh the page to exit edit mode
        header("Location: profile.php");
        exit;
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-in-out;
        }
        .profile-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 20px;
            animation: scaleUp 0.5s ease-in-out;
        }
        .profile-container input, .profile-container button {
            font-size: 16px;
            border-radius: 5px;
        }
        .profile-container input[type="text"], 
        .profile-container input[type="password"], 
        .profile-container input[type="file"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            width: 100%;
        }
        .profile-container button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .profile-container button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .profile-container form {
            display: flex;
            flex-direction: column;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes scaleUp {
            from { transform: scale(0.8); }
            to { transform: scale(1); }
        }
        @media (max-width: 768px) {
            .profile-container {
                margin: 20px;
                padding: 15px;
            }
            .profile-container img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <?php if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])): ?>
        <!-- Include appropriate navbar based on role -->
        <?php if ($_SESSION["role"] === 'user') include 'navbar.php'; ?>
        <?php if ($_SESSION["role"] === 'landlord') include 'navigationbar.php'; ?>
        <?php if ($_SESSION["role"] === 'admin') include 'navadmin.php'; ?>

        <div class="profile-container">
            <img src="<?php echo $fetch['image']; ?>" alt="Profile Picture">
            <!-- Edit Mode -->
            <?php if (isset($_POST['edit_profile'])): ?>
                <form method="POST" enctype="multipart/form-data">
                    <label>Profile Picture:</label>
                    <input type="file" name="image">
                    <label>First Name:</label>
                    <input type="text" name="fname" value="<?php echo $fetch['fname']; ?>" required>
                    <label>Last Name:</label>
                    <input type="text" name="lname" value="<?php echo $fetch['lname']; ?>" required>
                    <label>Email:</label>
                    <input type="text" name="uname" value="<?php echo $fetch['uname']; ?>" required>
                    <label>Password:</label>
                    <input type="password" name="pass" placeholder="Enter a new password">
                    <label>Role:</label>
                    <input type="text" value="<?php echo $fetch['role']; ?>" readonly>
                    <button type="submit" name="save_changes">Save Changes</button>
                    <button type="submit" name="cancel_edit">Cancel</button>
                </form>
            <?php else: ?>
                <div>
                    <p><strong>First Name:</strong> <?php echo $fetch['fname']; ?></p>
                    <p><strong>Last Name:</strong> <?php echo $fetch['lname']; ?></p>
                    <p><strong>Email:</strong> <?php echo $fetch['uname']; ?></p>
                    <p><strong>Role:</strong> <?php echo $fetch['role']; ?></p>
                    <form method="POST">
                        <button type="submit" name="edit_profile">Edit Profile</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Please <a href="index.php">log in</a> to view your profile.</p>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>