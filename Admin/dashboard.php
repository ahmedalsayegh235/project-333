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
    $cancelledBookingsCount = $pdo->query("SELECT COUNT(*) AS count FROM bookings WHERE status = 'cancelled'")->fetch()['count'];
    $confirmedBookingsCount = $pdo->query("SELECT COUNT(*) AS count FROM bookings WHERE status = 'confirmed'")->fetch()['count'];
    $activeroomsCount = $pdo->query("SELECT COUNT(*) AS count FROM rooms WHERE status=1")->fetch()['count'];
    $unactiveroomsCount = $pdo->query("SELECT COUNT(*) AS count FROM rooms WHERE status=0")->fetch()['count'];
    $activeusersCount = $pdo->query("SELECT COUNT(*) AS count FROM users WHERE status=1")->fetch()['count'];
    $unactiveusersCount = $pdo->query("SELECT COUNT(*) AS count FROM users WHERE status=0")->fetch()['count'];
    $userQueriesCount = $pdo->query("SELECT COUNT(*) AS count FROM user_queries")->fetch()['count'];
    $unseenuserQueriesCount = $pdo->query("SELECT COUNT(*) AS count FROM user_queries WHERE seen = 0")->fetch()['count'];
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
                    <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Users</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($usersCount); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Rooms Card -->
                    <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Rooms</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($roomsCount); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Bookings Card -->
                    <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Bookings</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($bookingsCount); ?></p>
                            </div>
                        </div>
                    </div>
                     <!-- Pending Bookings Card -->
                     <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Pending Bookings</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($pendingBookingsCount); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- cancelled bookings card -->
                    <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Cancelled Bookings</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($cancelledBookingsCount); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Confirmed bookings card -->
                    <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Confirmed Bookings</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($confirmedBookingsCount); ?></p>
                            </div>
                        </div>
                    </div> 
                       <!-- active rooms card -->
                       <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Active rooms</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($activeroomsCount); ?></p>
                            </div>
                        </div>
                    </div> 
                     <!-- active rooms card -->
                  <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Inactive rooms</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($unactiveroomsCount); ?></p>
                            </div>
                        </div>
                    </div> 
                        <!-- active users -->
                  <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">active users</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($activeusersCount); ?></p>
                            </div>
                        </div>
                    </div> 
                        <!-- inactive users -->
                  <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">Inactive users</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($unactiveusersCount); ?></p>
                            </div>
                        </div>
                    </div> 
                           <!-- users_queries -->
                  <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">users queries</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($userQueriesCount); ?></p>
                            </div>
                        </div>
                    </div> 
                              <!-- users_queries -->
                  <div class="col-md-4 col-lg-5">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <h5 class="card-title">unseen queries</h5>
                                <p class="card-text fs-3 fw-bold"><?= htmlspecialchars($unseenuserQueriesCount); ?></p>
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