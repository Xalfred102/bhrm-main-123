<?php
require 'php/connection.php';

if (!empty($_SESSION["uname"]) && !empty($_SESSION["role"])) {
    $uname = $_SESSION["uname"];
    $role = $_SESSION["role"];
    $result = mysqli_query($conn, "select * from users where uname = '$uname'");
    $fetch = mysqli_fetch_assoc($result);
} else {
    echo '<script> alert("YOU MUST LOG IN FIRST")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        .section1 {
            height: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content{
            background-color: gray;
            width: 600px;
            margin: auto;
            text-align: center;
            margin: auto;
            color: white;
              
            padding: 30px;
            border-radius: 10px;
        }

        .content h1 {
            margin-bottom: 20px;
        }

        .content p {
            text-align: justify;
        }
    </style>
</head>

<body>
    
    <?php include 'navbar.php'; ?>

    <div class="section1">
        <div class="content">
            <h1>Thank you For Booking in! <?php if (empty($_SESSION)) {
                                                echo '';
                                            } else {
                                                echo $fetch['fname'];
                                            } ?></h1>
            <p>"We would like to express our deepest gratitude to all our valued tenants for choosing  as your home away from home. Your trust and confidence in our services have greatly contributed to our success and growth. It's been a privilege to serve you, and we look forward to providing you with the comfort and convenience you've come to expect from us. Thank you for being a part of our Azzians Place family." now just wait for our confirmation and visit us for further discussions.</p>
        </div>
    </div>
</body>

</html>
