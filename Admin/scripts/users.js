document.addEventListener("DOMContentLoaded", function () {
    const userTableBody = document.getElementById("user-data");
    const addUserForm = document.getElementById("add_user_form");
    const editUserForm = document.getElementById("edit_user_form");
    const editUserModal = new bootstrap.Modal(document.getElementById("edit-user")); // Edit modal instance
    const addUserModal = new bootstrap.Modal(document.getElementById("add-user")); // Add modal instance

    // Fetch Users on Page Load
    fetchUsers();

    function fetchUsers() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                userTableBody.innerHTML = this.responseText;
            }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("action=fetch");
    }

    // Add User Form Submission
    addUserForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(addUserForm);
        formData.append("action", "add");

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);
                if (response.status === "success") {
                    alert("User added successfully!");
                    addUserModal.hide();
                    addUserForm.reset();
                    fetchUsers();
                } else {
                    alert("Failed to add user.");
                }
            }
        };
        xhr.send(formData);
    });

    // Edit User Button Click Event
    userTableBody.addEventListener("click", function (e) {
        if (e.target.classList.contains("edit-user")) {
            let userId = e.target.dataset.id;

            // Fetch User Data for Editing
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/users.php", true);
            xhr.onload = function () {
                if (this.status === 200) {
                    let user = JSON.parse(this.responseText);

                    if (user.id) {
                        // Populate the Edit Modal Form Fields
                        editUserForm.elements["name"].value = user.name;
                        editUserForm.elements["email"].value = user.email;
                        editUserForm.elements["phone"].value = user.phone;
                        editUserForm.elements["status"].value = user.status;
                        editUserForm.dataset.userId = user.id; // Attach User ID to the Form

                        // Show the Edit Modal
                        editUserModal.show();
                    } else {
                        alert("User data not found.");
                    }
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("action=edit-fetch&id=" + userId);
        }
    });

    // Edit User Form Submission
    editUserForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(editUserForm);
        formData.append("action", "update");
        formData.append("id", editUserForm.dataset.userId); // Include User ID

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);

                if (response.status === "success") {
                    alert("User updated successfully!");
                    editUserModal.hide();
                    fetchUsers(); // Refresh the User List
                } else {
                    alert("Failed to update user. Please try again.");
                }
            }
        };
        xhr.send(formData);
    });

    // Delete User Button Click Event
    userTableBody.addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-user")) {
            let userId = e.target.dataset.id;

            if (confirm("Are you sure you want to delete this user?")) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/users.php", true);
                xhr.onload = function () {
                    if (this.status === 200) {
                        let response = JSON.parse(this.responseText);
                        if (response.status === "success") {
                            alert("User deleted successfully!");
                            fetchUsers(); // Refresh the table
                        } else {
                            alert("Failed to delete user.");
                        }
                    }
                };
                xhr.onerror = function () {
                    alert("An error occurred while processing your request.");
                };
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("action=delete&id=" + userId);
            }
        }
    });
});
