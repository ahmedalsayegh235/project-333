<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Booking Management</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Booking Management</h3>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <!-- Add Booking Button -->
                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-booking">
                                <i class="bi bi-plus-square"></i> Add Booking
                            </button>
                        </div>

                        <!-- Bookings Table -->
                        <div class="table-responsive-md" style="height:450px; overflow-y:auto;">
                            <table class="table table-hover border">
                                <thead class="sticky-top bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Room</th>
                                        <th>Booking Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="booking-data">
                                    <!-- Dynamic booking data will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-booking" tabindex="-1" aria-labelledby="editBookingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="edit_booking_form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- User Selection -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">User</label>
                            <select name="user_id" class="form-select shadow-none" required>
                                <option value="" disabled>Select User</option>
                                <?php
                                $users = $pdo->query("SELECT id, name FROM users WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($users as $user) {
                                    echo "<option value='{$user['id']}'>{$user['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Room Selection -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Room</label>
                            <select name="room_id" class="form-select shadow-none" required>
                                <option value="" disabled>Select Room</option>
                                <?php
                                $rooms = $pdo->query("SELECT id, name FROM rooms WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rooms as $room) {
                                    echo "<option value='{$room['id']}'>{$room['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Booking Date -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Booking Date</label>
                            <input type="date" name="selected_date" class="form-control shadow-none" required>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select shadow-none" required>
                                <option value="Pending">Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success text-white shadow-none">Update Booking</button>
                </div>
            </div>
        </form>
    </div>
</div>


    <!-- Add Booking Modal -->
    <div class="modal fade" id="add-booking" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_booking_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- User Selection -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">User</label>
                                <select name="user_id" class="form-select shadow-none" required>
                                    <option value="" disabled selected>Select User</option>
                                    <?php
                                    $users = $pdo->query("SELECT id, name FROM users WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($users as $user) {
                                        echo "<option value='{$user['id']}'>{$user['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Room Selection -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Room</label>
                                <select name="room_id" class="form-select shadow-none" required>
                                    <option value="" disabled selected>Select Room</option>
                                    <?php
                                    $rooms = $pdo->query("SELECT id, name FROM rooms WHERE status = 1")->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($rooms as $room) {
                                        echo "<option value='{$room['id']}'>{$room['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Booking Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Booking Date</label>
                                <input type="date" name="selected_date" class="form-control shadow-none" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success text-white shadow-none">Add Booking</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?>
    <script src="scripts/bookings.js"></script>
</body>
</html>
