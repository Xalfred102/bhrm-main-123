<?php
require 'connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"]) && $_SESSION['role'] == 'landlord') {
    $uname = $_SESSION['uname'];
    $query = "select * from users where uname = '$uname'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);
    $fname = $fetch['fname'];

} else {
    header("location: ../index.php");
}

if (isset($_POST['submit'])) {
    $owner = $_SESSION['uname'];
    $landlord = $_POST['landlord'];
    $hname = $_POST['name'];
    $haddress = $_POST['address'];
    $contactno = $_POST['contactno'];
    $description = $_POST['description'];

    $_FILES['image'];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileactualext = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

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

    $_FILES['barper'];

    $fileName = $_FILES['barper']['name'];
    $fileTmpName = $_FILES['barper']['tmp_name'];
    $fileSize = $_FILES['barper']['size'];
    $fileError = $_FILES['barper']['error'];
    $fileType = $_FILES['barper']['type'];

    $fileExt = explode('.', $fileName);
    $fileactualext = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileactualext, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000000000) {
                $fileNameNew2 = $fileName;
                $fileDestination = '../images/' . $fileNameNew2;
                if ($fileNameNew2 > 0) {
                    move_uploaded_file($fileTmpName, $fileDestination);
                }
            } else {
                echo "your file is too big.";
            }
        }
    } else {
        echo "you cannot upload this type of file";
    }

    $_FILES['busper'];

    $fileName = $_FILES['busper']['name'];
    $fileTmpName = $_FILES['busper']['tmp_name'];
    $fileSize = $_FILES['busper']['size'];
    $fileError = $_FILES['busper']['error'];
    $fileType = $_FILES['busper']['type'];

    $fileExt = explode('.', $fileName);
    $fileactualext = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileactualext, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000000000) {
                $fileNameNew3 = $fileName;
                $fileDestination = '../images/' . $fileNameNew3;
                if ($fileNameNew3 > 0) {
                    move_uploaded_file($fileTmpName, $fileDestination);
                }
            } else {
                echo "your file is too big.";
            }
        }
    } else {
        echo "you cannot upload this type of file";
    }

    $query = "INSERT INTO `bhapplication` (`id`, `owner`, `hname`, `haddress`, `contact_no`, `status`, `landlord`) VALUES ('', '$owner','$hname','$haddress', '$contactno', 'Pending', '$landlord')";
    mysqli_query($conn, $query);
    $query = "INSERT INTO `documents` (`id`, `bar_clear`, `bus_per`, `image`, `hname`) VALUES ('','images/$fileNameNew2', 'images/$fileNameNew3','images/$fileNameNew', '$hname')";
    mysqli_query($conn, $query);
    $query = "INSERT INTO `description` (`id`, `bh_description`, `hname`) VALUES ('','$description', '$hname')";
    mysqli_query($conn, $query);
   
}


if (isset($_GET['approve'])) {
    $hname = $_GET['approve'];
    
    // Fetch the data from the bhapplication table
    $query = "select * from bhapplication where hname = '$hname'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $fetch = mysqli_fetch_assoc($result);

        $owner = $fetch['owner'];
        $landlord = $fetch['landlord'];
        $hname = $fetch['hname'];
        $address = $fetch['haddress'];
        $contactno = $fetch['contact_no'];
        
        // Insert the data into the boardinghouses table
        $query_insert = "INSERT INTO boardinghouses (`id`, `owner`, `hname`, `haddress`, `contact_no`, `landlord`) VALUES ('', '$owner', '$hname', '$address', '$contactno', '$landlord')";
        
        if (mysqli_query($conn, $query_insert)) {
            // Update the status in the bhapplication table
            $query_update = "UPDATE bhapplication SET Status = 'Approved' WHERE hname = '$hname'";
            mysqli_query($conn, $query_update);

            $query_insert = "UPDATE documents SET hname = '$hname', owner = '$owner' where hname = '$hname'";
            mysqli_query($conn, $query_insert);

            $query_insert = "UPDATE description SET hname = '$hname', owner = '$owner' where hname = '$hname'";
            mysqli_query($conn, $query_insert);

            $query_insert = "UPDATE users SET hname = '$hname' where uname = '$owner'";
            mysqli_query($conn, $query_insert);
            
            header('Location: ../applicationapproved.php');
        } else {
            echo "Error: " . $query_insert . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

if (isset($_GET['reject'])) {
    $hname = $_GET['reject'];
    
    // Update the status in the bhapplication table
    $query_update = "UPDATE bhapplication SET Status = 'Rejected' WHERE hname = '$hname'";
    
    if (mysqli_query($conn, $query_update)) {


        $query_insert = "UPDATE users SET hname = '' where uname = '$owner'";
        mysqli_query($conn, $query_insert);

        $query_update = "UPDATE documents SET hname = '' where uname = '$owner'";
        mysqli_query($conn, $query_update);

        $query_update = "UPDATE description SET hname = '' where uname = '$owner'";
        mysqli_query($conn, $query_update);
        
        header('Location: ../applicationrejected.php');
    } else {
        echo "Error: " . $query_update . "<br>" . mysqli_error($conn);
    }
}

?>
<?php
if (isset($_POST['submit'])) {
    // Existing form handling logic...

    // Display success modal
    echo '<div class="alert-modal active" id="successModal">
            <h2>Submission Successful!</h2>
            <p>Thank you for submitting your boarding house details. Your application is under review.</p>
            <button onclick="closeModal()">Close</button>
          </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Boarding House</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f7f7f7;
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }

        nav {
            background-color: #343a40;
            padding: 5px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .navbar-brand img {
            width: 80px;
            height: 80px;
        }

        nav .nav-links {
            display: flex;
            gap: 20px;
        }

        nav .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        nav .login a {
            background-color: #ffc107;
            padding: 10px 15px;
            border-radius: 25px;
            color: white;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        nav .login a:hover {
            background-color: #d68918;
        }

        .section0 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 1200px;
            margin: 40px auto;
            gap: 30px;
        }

        .section1, .section2 {
            background-color: #b5afaf;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

       
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        .form-group button {
            padding: 12px 18px;
            background-color: #ffc107;
            color: white;
            border: none;
            font-weight: bold;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #d68918;
        }

        .form-group a {
            text-align: center;
            color: #333;
            font-size: 16px;
            text-decoration: none;
        }

        .form-group a:hover {
            text-decoration: underline;
        }

        .logo {
            display: block;
            margin: 0 auto 30px;
            width: 120px;
            height: 120px;
        }

        .title {
            font-size: 28px;
            font-weight: 500;
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        @media (max-width: 768px) {
            .section0 {
                grid-template-columns: 1fr;
                margin: 20px;
            }

            nav .nav-links {
                flex-direction: column;
                align-items: center;
            }

            .form-container {
                gap: 15px;
            }
        }

        /* Alert modal styles */
.alert-modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    display: none;
}

.alert-modal.active {
    display: block;
}

.alert-modal h2 {
    margin: 0 0 15px;
    color: #ffc107;
    font-size: 22px;
}

.alert-modal p {
    font-size: 16px;
    color: #555;
}

.alert-modal button {
    background-color: #ffc107;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.alert-modal button:hover {
    background-color: #ffc107;
}

    </style>
</head>
<body>
    <nav>
        <a class="navbar-brand" href="#">
            <img src="./images/logo.png" alt="Logo">
        </a>
        <div class="nav-links">
            <a href="/bhrm-main/php/bhfunction.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="../bhapplication.php">My Application</a>
            </div>
                <div class="login">
            <?php
    if (!empty($_SESSION['uname'])) {
        echo '<a href="logout.php" class="logout">Logout</a>';
    } else {
        echo '<a href="login.php">Login</a>';
    }
?>

        </div>
    </nav>

    <div class="section0">
        <div class="section1">
            <style>
                .thank-you-message {
                    background-color: #f9f9fc;
                    padding: 30px;
                    border: 2px solid #c1e1c1;
                    border-radius: 12px;
                    color: #333;
                    font-family: Arial, sans-serif;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    margin-bottom: 20px;
                }

                .thank-you-message h2 {
                    font-size: 26px;
                    margin-bottom: 15px;
                    color: #27ae60;
                }

                .thank-you-message p {
                    font-size: 16px;
                    margin: 10px 0;
                    line-height: 1.6;
                }

                .thank-you-message ul, .thank-you-message ol {
                    text-align: left;
                    margin: 10px auto;
                    max-width: 700px;
                }

                .thank-you-message ul {
                    list-style-type: disc;
                    padding-left: 20px;
                }

                .thank-you-message ol {
                    list-style-type: decimal;
                    padding-left: 20px;
                }

                .thank-you-message a {
                    color: #2980b9;
                    text-decoration: none;
                }

                .thank-you-message a:hover {
                    text-decoration: underline;
                }

                .thank-you-message h3 {
                    font-size: 20px;
                    margin-top: 20px;
                    color: #2c3e50;
                }

            </style>
            <div class="thank-you-message">
                <h2>Thank You for Registering as a Landlord!</h2>
                <p>Dear <?php echo $fetch['fname']; ?>,</p>
                <p>
                    Thank you for registering as a landlord with us! To complete your application and activate your account, we kindly request you to submit the following essential documents:
                </p>
                <ul>
                    <li><strong>Barangay Permit</strong></li>
                    <li><strong>Business Permit</strong></li>
                </ul>
                <p>
                    These documents are necessary to ensure compliance with local regulations and to validate your application. Below are the steps to acquire these documents if you haven’t obtained them yet:
                </p>

                <h3>How to Get a Barangay Permit</h3>
                <ol>
                    <li>Prepare required documents: Barangay Clearance, proof of property ownership or lease agreement, and a valid government-issued ID.</li>
                    <li>Visit your Barangay Hall where your boarding house is located.</li>
                    <li>Fill out the application form provided at the barangay office.</li>
                    <li>Pay the processing fee (₱200–₱500 depending on the barangay).</li>
                    <li>Barangay officials may inspect your boarding house for compliance.</li>
                    <li>Receive your Barangay Permit (processing usually takes 1–3 business days).</li>
                </ol>

                <h3>How to Get a Business Permit</h3>
                <ol>
                    <li>Start by securing your Barangay Clearance or Barangay Permit (this is a prerequisite for a business permit).</li>
                    <li>Gather the necessary documents, including your DTI Registration Certificate (for sole proprietors), SEC Registration (for corporations/partnerships), and Contract of Lease or proof of property ownership.</li>
                    <li>Visit the Municipal or City Hall and head to the Business Permits and Licensing Office (BPLO).</li>
                    <li>Submit your application form along with all required documents for processing.</li>
                    <li>Pay the applicable fees (amount depends on the size and type of your business).</li>
                    <li>Wait for your application to be processed and claim your Business Permit (processing times may vary).</li>
                </ol>
                <p>
                    Should you have any questions or need further guidance, feel free to reach out to our team. We are here to assist you throughout this process.
                </p>
                <p>
                    Thank you for trusting us with your property. We look forward to completing your application!
                </p>
                <p>
                    Best regards,<br>
                    <strong>The MBHC Team</strong>
                </p>
            </div>

        </div>

        <div class="section2">
            <img src="./images/logo.png" class="logo" alt="Logo">
            <div class="title">Add Boarding House</div>
            <form method="post" enctype="multipart/form-data" class="form-container">
                <div class="form-group">
                    <label for="landlord">Landlord Name</label>
                    <input type="text" id="landlord" name="landlord" placeholder="Enter here.." required>
                </div>
                <div class="form-group">
                    <label for="name">House Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter here.." required>
                </div>
                <div class="form-group">
                    <label for="address">House Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter here.." required>
                </div>
                <div class="form-group">
                    <label for="contactno">Contact Number</label>
                    <input type="text" id="contactno" name="contactno" placeholder="Enter here.." required>
                </div>
                <div class="form-group">
                    <label for="image">Provide Image of Boarding House</label>
                    <input type="file" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="image2">Provide Baranggay Permit BH Verification</label>
                    <input type="file" id="image2" name="barper" required>
                </div>
                <div class="form-group">
                    <label for="image2">Provide Business Permit for BH Verification</label>
                    <input type="file" id="image2" name="busper" required>
                </div>
                <div class="form-group">
                    <label for="description">Boarding House Additional Info (Free Water/Electricity, House Rules, Etc.)</label>
                    <textarea id="description" name="description" placeholder="Enter here.." rows="5" cols="40" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Submit</button>
                </div>
                <div class="form-group">
                    <?php 
                        if ($_SESSION['role'] != 'landlord'){
                            echo '<a href="../manageboardinghouse.php">Back</a>';
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <script>
    function closeModal() {
        document.getElementById('successModal').style.display = 'none';
    }
</script>

</body>
</html>
