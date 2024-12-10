<?php
require("inc/essentials.php");
require('inc/db_config.php');
adminLogin();
?>
<?php
 // Query the counts
   try{ $usersCount = $pdo->query("SELECT COUNT(*) AS count FROM users")->fetch()['count'];
    $roomsCount = $pdo->query("SELECT COUNT(*) AS count FROM rooms")->fetch()['count'];
    $bookingsCount = $pdo->query("SELECT COUNT(*) AS count FROM bookings")->fetch()['count'];
    $pendingBookingsCount = $pdo->query("SELECT COUNT(*) AS count FROM bookings WHERE status = 'pending'")->fetch()['count'];
}
catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <?php require("inc/links.php"); ?>
</head>
<body class="bg-white">
   <?php require("inc/header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="main-content">
                <div class="row g-3">

                    <!-- Users Card -->
                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Users</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($usersCount); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Rooms Card -->
                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Rooms</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($roomsCount); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Bookings Card -->
                    <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Bookings</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($bookingsCount); ?></p>
                            </div>
                        </div>
                    </div>
                     <!-- Pending Bookings Card -->
                     <div class="col-md-4">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Pending Bookings</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($pendingBookingsCount); ?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <?php require("inc/scripts.php"); ?>
</body>
</html>