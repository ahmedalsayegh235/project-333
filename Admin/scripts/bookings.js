document.addEventListener("DOMContentLoaded", function () {
    const bookingTableBody = document.getElementById("booking-data");
    const addBookingForm = document.getElementById("add_booking_form");
    const editBookingForm = document.getElementById("edit_booking_form");
    const editBookingModal = new bootstrap.Modal(document.getElementById("edit-booking"));

    fetchBookings();

    // get and display bookings
    function fetchBookings() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/bookings.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                bookingTableBody.innerHTML = this.responseText;
            }
        };
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("action=fetch");
    }
// Delete Booking
bookingTableBody.addEventListener("click", function (e) {
    if (e.target.classList.contains("delete-booking")) {
        const bookingId = e.target.dataset.id;

        if (confirm("Are you sure you want to delete this booking?")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/bookings.php", true);
            xhr.onload = function () {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    if (response.status === "success") {
                        alert("Booking deleted successfully!");
                        fetchBookings(); // Refresh the table
                    } else {
                        alert("Failed to delete booking.");
                    }
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("action=delete&id=" + bookingId);
        }
    }
});

    // Handle Add Booking Form Submission
    addBookingForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(addBookingForm);
        formData.append("action", "add");

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/bookings.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);
                if (response.status === "success") {
                    alert("Booking added successfully!");
                    addBookingForm.reset();
                    fetchBookings();
                } else {
                    alert("Failed to add booking.");
                }
            }
        };
        xhr.send(formData);
    });

    // Handle Edit Button Click
    bookingTableBody.addEventListener("click", function (e) {
        if (e.target.classList.contains("edit-booking")) {
            let bookingId = e.target.dataset.id;

            // Fetch booking data
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/bookings.php", true);
            xhr.onload = function () {
                if (this.status === 200) {
                    let booking = JSON.parse(this.responseText);

                    if (booking.id) {
                        // Populate the Edit Modal with booking data
                        editBookingForm.elements["user_id"].value = booking.user_id;
                        editBookingForm.elements["room_id"].value = booking.room_id;
                        editBookingForm.elements["selected_date"].value = booking.selected_date;
                        editBookingForm.elements["status"].value = booking.status;
                        editBookingForm.dataset.bookingId = booking.id;

                        // Show the modal
                        editBookingModal.show();
                    } else {
                        alert("Booking not found.");
                    }
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("action=edit-fetch&id=" + bookingId);
        }
    });

    // Handle Edit Booking Form Submission
    editBookingForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(editBookingForm);
        formData.append("action", "update");
        formData.append("id", editBookingForm.dataset.bookingId);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/bookings.php", true);
        xhr.onload = function () {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);

                if (response.status === "success") {
                    alert("Booking updated successfully!");
                    editBookingModal.hide();
                    fetchBookings();
                } else {
                    alert("Failed to update booking.");
                }
            }
        };
        xhr.send(formData);
    });
});
