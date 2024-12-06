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