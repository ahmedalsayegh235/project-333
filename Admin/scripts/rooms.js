document.addEventListener("DOMContentLoaded", function () {
    const roomTableBody = document.getElementById("room-data");
    const addRoomForm = document.getElementById("add_room_form");
    const editRoomForm = document.getElementById("edit_room_form");
    const editRoomModal = new bootstrap.Modal(document.getElementById("edit-room")); // Edit modal instance
    const addRoomModal = new bootstrap.Modal(document.getElementById("add-room")); // Add modal instance

    // Fetch Rooms on Page Load
    fetchRooms();

    function fetchRooms() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                roomTableBody.innerHTML = this.responseText;
            }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("action=fetch");
    }

    // Add Room Form Submission
    addRoomForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(addRoomForm);
        formData.append("action", "add");

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);
                if (response.status === "success") {
                    alert("Room added successfully!");
                    addRoomModal.hide();
                    addRoomForm.reset();
                    fetchRooms();
                } else {
                    alert("Failed to add room.");
                }
            }
        };
        xhr.send(formData);
    });

    // Edit Room Button Click Event
    roomTableBody.addEventListener("click", function (e) {
        if (e.target.classList.contains("edit-room")) {
            let roomId = e.target.dataset.id;

            // Fetch Room Data for Editing
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.onload = function () {
                if (this.status === 200) {
                    let room = JSON.parse(this.responseText);

                    if (room.id) {
                        // Populate the Edit Modal Form Fields
                        editRoomForm.elements["name"].value = room.name;
                        editRoomForm.elements["department"].value = room.department;
                        editRoomForm.elements["desc"].value = room.description;
                        editRoomForm.elements["status"].value = room.status;
                        editRoomForm.dataset.roomId = room.id; // Attach Room ID to the Form

                        // Show the Edit Modal
                        editRoomModal.show();
                    } else {
                        alert("Room data not found.");
                    }
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("action=edit-fetch&id=" + roomId);
        }
    });

    // Edit Room Form Submission
    editRoomForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(editRoomForm);
        formData.append("action", "update");
        formData.append("id", editRoomForm.dataset.roomId); // Include Room ID

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);

                if (response.status === "success") {
                    alert("Room updated successfully!");
                    editRoomModal.hide();
                    fetchRooms(); // Refresh the Room List
                } else {
                    alert("Failed to update room. Please try again.");
                }
            }
        };
        xhr.send(formData);
    });
     roomTableBody.addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-room")) {
            let roomId = e.target.dataset.id;

            if (confirm("Are you sure you want to delete this room?")) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/rooms.php", true);
                xhr.onload = function () {
                    if (this.status === 200) {
                        let response = JSON.parse(this.responseText);
                        if (response.status === "success") {
                            alert("Room deleted successfully!");
                            fetchRooms(); // Refresh the table
                        } else {
                            alert("Failed to delete room.");
                        }
                    }
                };
                xhr.onerror = function () {
                    alert("An error occurred while processing your request.");
                };
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("action=delete&id=" + roomId);
            }
        }
    });
});


