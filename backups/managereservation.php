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
</head>
    <style>
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


       

    </style>

<body>
    <?php include 'navigationbar.php'; ?>

    <?php if (!empty($_SESSION) && $_SESSION['role'] == 'landlord'): ?>
    

    <?php if (!empty($_SESSION) && $_SESSION['role'] == 'landlord') { ?>
    
    
        


    <?php } ?>
    
</body>
</html>
