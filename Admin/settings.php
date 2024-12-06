<?php
require("inc/essentials.php");
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Settings</title>
    <?php require("inc/links.php"); ?>
</head>
<body class="bg-white">
   <?php require("inc/header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="main-content">
                <h3 class="mb-4">SETTINGS</h3>
<!-- general settings section -->     
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">General settings</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-toggle="modal" data-target="#general">
            <i class="bi bi-pencil-square"></i>edit
            </button>
             </div>
            <h6 class="card-subtitle mb-1 fw-bold">site title</h6>
            <p class="card-text" id="site_title"></p>
            <h6 class="card-subtitle mb-1 fw-bold">About UOB</h6>
            <p class="card-text" id="site_about"></p>
        </div>
    </div>
    <!-- general settings Modal -->
    <div class="modal fade" id="general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="general_s_form">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">General Settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
            <label class="form-label fw-bold">site title</label>
            <input type="text" name="site_title_inp" id="site_title_inp" class="form-control shadow-none" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">About UOB</label>
                <textarea class="form-control shadow-none" id="site_about_inp" name="site_about_inp" rows="6" required></textarea>
              </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn text-secondary shadow-none" data-dismiss="modal">Close</button>
        <button type="submit"  class="btn custom-bg text-white shadow-none">Submit</button>
      </div>
    </div>
    </form>
  </div>
    </div>
<!-- shutdown section -->
<div class="card mt-1">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Shutdown website</h5>
            <div class="form-check form-switch">
                <form>
            <input onchange="upd_shutdown(this)" class="form-check-input" type="checkbox" id="shutdown-toggle">
            </form>
            </div>
             </div>
            <p class="card-text" id="site_title"> no Student will be allowed to book a room, when shutdown mode is turned on</p>
        </div>
    </div>

            </div>
        </div>
    </div>
    
    <?php require("inc/scripts.php"); ?>
  <script src="scripts/settings.js"></script>
</body>
</html>