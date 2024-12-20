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
    <title>Admin Panel - user queries</title>
    <?php require('inc/links.php');?>
</head>
<body class="bg-light">
    <?php require('inc/header.php') ?>
    
    <div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">Rooms Management</h3>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <!-- Add Room Button -->
                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                            <i class="bi bi-plus-square"></i> Add Room
                        </button>
                    </div>

                    <!-- Rooms Table -->
                    <div class="table-responsive-md" style="height:450px; overflow-y:auto;">
                        <table class="table table-hover border">
                            <thead class="sticky-top bg-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="room-data">
                                <!-- Dynamic room data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Room Modal -->
<div class="modal fade" id="add-room" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="add_room_form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Room Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Room Name</label>
                            <input type="text" name="name" class="form-control shadow-none" required>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Department</label>
                            <input type="text" name="department" class="form-control shadow-none" required>
                        </div>

                        <!-- Description -->
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="desc" class="form-control shadow-none" rows="3" required></textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select shadow-none">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Edit Room Modal -->
<div class="modal fade" id="edit-room" tabindex="-1" aria-labelledby="editRoomLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="edit_room_form" autocomplete="off">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editRoomLabel">Edit Room</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- Room Name -->
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Room Name</label>
              <input type="text" name="name" class="form-control shadow-none" required>
            </div>

            <!-- Department -->
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Department</label>
              <input type="text" name="department" class="form-control shadow-none" required>
            </div>

            <!-- Description -->
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Description</label>
              <textarea name="desc" class="form-control shadow-none" rows="3" required></textarea>
            </div>

            <!-- Status -->
            <div class="col-12 mb-3">
              <label class="form-label fw-bold">Status</label>
              <select name="status" class="form-select shadow-none">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success text-white shadow-none">Update Room</button>
        </div>
      </div>
    </form>
  </div>
</div>





    <?php require ('inc/scripts.php')?>
    <script src="scripts/rooms.js"></script>
</body>
</html>