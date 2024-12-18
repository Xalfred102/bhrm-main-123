<?php

require 'php/connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .background {
            background: linear-gradient(45deg, #343a40, #aeb5bb, #343a40, #ffffff);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            min-height: 100vh;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-bottom: 80px; /* Ensure footer space */
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
        }

        .card-content h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card-content p {
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .row-container {
            margin-top: 20px; /* Small gap between cards and top content */
            max-width: 1200px; /* Set a maximum width for the card grid */
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include 'navadmin.php'; ?>

    <div class="background">
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center row-container">
            <?php
                $query = "SELECT * FROM boardinghouses INNER JOIN documents ON boardinghouses.hname = documents.hname";
                $result = mysqli_query($conn, $query);
                while ($fetch = mysqli_fetch_assoc($result)) :
                    $hname = $fetch['hname'];
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $fetch['image']; ?>" class="card-img-top" alt="Boarding House">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $fetch['hname']; ?></h5>
                            <p class="card-text"><strong>Owner:</strong> <?php echo $fetch['landlord']; ?></p>
                            <p class="card-text"><strong>Address:</strong> <?php echo $fetch['haddress']; ?></p>
                            <p class="card-text"><strong>Contact:</strong> <?php echo $fetch['contact_no']; ?></p>
                            <?php 
                            
                            $desquery = "SELECT * FROM description where hname = '$hname'"; 
                            $desresult = mysqli_query($conn, $desquery);
                            $desfetch = mysqli_fetch_assoc($desresult);
                            ?>
                            <p class="card-text"><strong>Description:</strong> <?php echo $desfetch['bh_description']; ?></p>
                            <div>
                                <?php if (!empty($_SESSION['uname']) && $_SESSION['role'] == 'admin') : ?>
                                    <a href="php/function.php?edit=<?php echo $fetch['id']; ?>" class="btn btn-warning me-2">Update</a>
                                    <button class="btn btn-danger delete" data-href="php/function.php?delete=<?php echo $fetch['id']; ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</button>
                                <?php else : ?>
                                    <a href="boardinghouse.php?hname=<?php echo $hname; ?>" class="btn btn-primary">More Details</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this landlord's boarding house?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const deleteUrl = this.getAttribute('data-href');
                    confirmDeleteBtn.setAttribute('href', deleteUrl);
                });
            });
        });
    </script>
</body>

</html>
