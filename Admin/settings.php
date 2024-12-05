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
    <script>
    let general_data;
    let general_s_form =document.getElementById('general_s_form');
    let site_title_val = document.getElementById('site_title_inp').value;
    let site_about_val = document.getElementById('site_about_inp').value;

    function get_general() {
    let site_title = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');

    let site_title_inp = document.getElementById('site_title_inp');
    let site_about_inp = document.getElementById('site_about_inp');

    let shutdown_toggle =document.getElementById('shutdown_toggle');

    if (!site_title || !site_about) {
        console.error("Elements with IDs 'site_title' or 'site_about' not found in the DOM.");
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        try {
            const general_data = JSON.parse(this.responseText);

            if (general_data.error) {
                console.error("Error:", general_data.error);
            } else {
                site_title.innerText = general_data.site_title;
                site_about.innerText = general_data.site_about;

                site_title_inp.value= general_data.site_title;
                site_about_inp.value= general_data.site_about;

                if(general_data.shutdown == 0)
            {
                shutdown_toggle.checked = false;
                shutdown_toggle.value =0;

            }else
            {
                shutdown_toggle.checked = true;
                shutdown_toggle.value =1;
            }

            }
        } catch (e) {
            console.error("Invalid JSON response:", e, this.responseText);
        }
    };

    xhr.onerror = function () {
        console.error("Request failed.");
    };

    xhr.send("get_general=true");
}

function upd_general() {
    // Get values from input fields
    let site_title_val = document.getElementById('site_title_inp').value;
    let site_about_val = document.getElementById('site_about_inp').value;

    // Create an XMLHttpRequest
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        console.log("Raw response:", this.responseText); // Debug raw response
        try {
            const response = JSON.parse(this.responseText); // Parse JSON response
            console.log("Parsed response:", response); // Debug parsed response

            if (response.success) {
                _alert("success", "Changes saved successfully!");
                get_general(); // Reload settings to update the DOM
            } else if (response.error) {
                _alert("error", `Error: ${response.error}`);
            } else {
                _alert("error", "Unexpected response format.");
            }
        } catch (e) {
            console.error("Invalid JSON response:", e, this.responseText);
            alert("An error occurred. Please try again.");
        }
    };

    xhr.onerror = function () {
        console.error("Request failed.");
        alert("Failed to send request. Please check your connection.");
    };

    // Send the data
    xhr.send(
        `site_title=${encodeURIComponent(site_title_val)}&site_about=${encodeURIComponent(site_about_val)}&upd_general=true`
    );
}

general_s_form.addEventListener('submit',function(e){
e.preventDefault();
upd_general(site_title_inp.value,site_about_inp.value);

})

function upd_shutdown(toggleElement) {
    const shutdownValue = toggleElement.checked ? 1 : 0; // Convert toggle state to 1 or 0
    console.log("Shutdown value sent to server:", shutdownValue); // Debugging

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        try {
            const response = JSON.parse(this.responseText);
            console.log("Response from server:", response); // Debugging

            if (response.success) {
                _alert("success","Shutdown updated successfully.");
            } else {
                _alert("error","Failed to update shutdown.");
            }

            // Optional: Reload the settings
            get_general();
        } catch (e) {
            console.error("Invalid JSON response:", e, this.responseText);
            _alert("error", "An error occurred. Please try again.");
        }
    };

    xhr.onerror = function () {
        console.error("Request failed.");
        _alert("error", "Failed to send request. Please check your connection.");
    };

    // Send shutdown value to the backend
    xhr.send(`upd_shutdown=${shutdownValue}`);
}

    // Execute on window load
    window.onload = function () {
        get_general();
    };
</script>

</body>
</html>