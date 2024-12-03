CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(15),
    student_id VARCHAR(20),
    picture VARCHAR(255),
    address TEXT,
    dob DATE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

<?php
// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=roomy", "root", ""); // Replace with your DB credentials
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Sign-up logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $student_id = $_POST['student_id'];
    $picture = $_FILES['picture']['name'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Upload picture
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($picture);
    move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile);

    // Insert user
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, student_id, picture, address, dob, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $student_id, $targetFile, $address, $dob, $password]);
        echo "Sign-up successful!";
    } catch (PDOException $e) {
        echo "Sign-up failed: " . $e->getMessage();
    }
}

// Login logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            echo "Login successful! Welcome, " . $user['name'];
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Login failed: " . $e->getMessage();
    }
}
?>
Integration with HTML Form
Update the forms in your HTML with action attributes pointing to auth.php and include appropriate fields:

Login Form
html
Copy code
<form method="POST" action="auth.php">
  <input type="hidden" name="login">
  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control shadow-none" name="email" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control shadow-none" name="password" required>
  </div>
  <div class="d-flex align-items-center justify-content-between mb-2">
    <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
  </div>
</form>
Sign-up Form
html
Copy code
<form method="POST" action="auth.php" enctype="multipart/form-data">
  <input type="hidden" name="signup">
  <!-- Include all signup fields with appropriate name attributes -->
  <input type="text" name="name" required placeholder="Name">
  <input type="email" name="email" required placeholder="Email">
  <input type="number" name="phone" required placeholder="Phone No.">
  <input type="number" name="student_id" required placeholder="Student ID">
  <input type="file" name="picture" required>
  <textarea name="address" required placeholder="Address"></textarea>
  <input type="date" name="dob" required>
  <input type="password" name="password" required placeholder="Password">
  <input type="password" name="confirm_password" required placeholder="Confirm Password">
  <button type="submit" class="btn btn-dark shadow-none">SIGN UP</button>
</form>
Step 1: Setup
1. Install Development Environment:
Install XAMPP (Apache, PHP, MySQL) or an equivalent stack.
Create a new MySQL database named room_booking_system.
2. Database Schema:
Create a basic schema based on the project requirements:

sql
Copy code
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(255),
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    capacity INT NOT NULL,
    equipment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);
Step 2: User Registration and Login
1. HTML Form for Registration (with Bootstrap):
html
Copy code
<div class="container">
    <form id="signup-form" method="POST" action="auth.php">
        <h3>Sign Up</h3>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">UoB Email</label>
            <input type="email" class="form-control" id="email" name="email" pattern=".+@uob\.edu\.bh" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>
2. PHP Backend for Registration (auth.php):
php
Copy code
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=room_booking_system", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Handle profile picture upload
        $profilePicture = null;
        if (!empty($_FILES['profile_picture']['name'])) {
            $profilePicture = 'uploads/' . basename($_FILES['profile_picture']['name']);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicture);
        }

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, profile_picture) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $profilePicture]);

        echo "User registered successfully!";
    }
}
?>
Step 3: Login System
1. Login Form:
html
Copy code
<div class="container">
    <form id="login-form" method="POST" action="auth.php">
        <h3>Login</h3>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
</div>
2. PHP Login Logic:
php
Copy code
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        echo "Login successful! Welcome, " . $user['name'];
    } else {
        echo "Invalid email or password.";
    }
}
Step 4: Room Browsing and Booking
Room Browsing Page: Use a Bootstrap grid to display room details fetched via PHP.
Booking Form: Collect room ID, booking date, and time.
Conflict Checking Logic: Query existing bookings to prevent double-booking.
Step 5: Admin Panel
Room Management: CRUD functionality for rooms using PHP and JavaScript.
Schedule Management: Show room schedules using a calendar (e.g., FullCalendar.js).
Next Steps
Add JS for Dynamic Validation: Ensure UoB emails are validated on the client side.
Integrate Analytics and Reporting: Use charts for usage stats.
Deploy to a Server: Use Apache or a cloud platform like Heroku for deployment.
If you need more detail about a specific step, let me know!






You said:
do the whole thing step 4 and 5
ChatGPT said:
ChatGPT
Step 4: Room Browsing and Booking
1. Room Browsing Page
Create a page that fetches room details from the database and displays them in a responsive layout. Use PHP and Bootstrap.

HTML and PHP Code
php
Copy code
<?php
// Fetch room details
try {
    $pdo = new PDO("mysql:host=localhost;dbname=room_booking_system", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM rooms");
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<div class="container">
    <h3 class="text-center my-4">Available Rooms</h3>
    <div class="row">
        <?php foreach ($rooms as $room): ?>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($room['name']); ?></h5>
                    <p class="card-text">Capacity: <?= htmlspecialchars($room['capacity']); ?></p>
                    <p class="card-text">Equipment: <?= htmlspecialchars($room['equipment']); ?></p>
                    <a href="booking.php?room_id=<?= $room['id']; ?>" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
2. Booking Form
Create a page to book rooms. Ensure there is conflict checking to prevent double-booking.

HTML and PHP Booking Form
php
Copy code
<?php
if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];
}

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'];
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    // Conflict checking
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE room_id = ? AND booking_date = ? AND booking_time = ?");
    $stmt->execute([$room_id, $booking_date, $booking_time]);
    if ($stmt->rowCount() > 0) {
        echo "Error: This time slot is already booked.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO bookings (user_id, room_id, booking_date, booking_time) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $room_id, $booking_date, $booking_time]);
        echo "Booking successful!";
    }
}
?>

<div class="container">
    <h3 class="text-center my-4">Book Room</h3>
    <form method="POST" action="">
        <input type="hidden" name="room_id" value="<?= $room_id; ?>">
        <div class="mb-3">
            <label for="booking_date" class="form-label">Date</label>
            <input type="date" class="form-control" id="booking_date" name="booking_date" required>
        </div>
        <div class="mb-3">
            <label for="booking_time" class="form-label">Time</label>
            <input type="time" class="form-control" id="booking_time" name="booking_time" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
Step 5: Admin Panel
1. Admin Dashboard
The admin dashboard should display an overview of all bookings and allow room management.

HTML and PHP for Admin Dashboard
php
Copy code
<?php
// Fetch all bookings
$stmt = $pdo->query("
    SELECT bookings.*, rooms.name AS room_name, users.name AS user_name
    FROM bookings
    JOIN rooms ON bookings.room_id = rooms.id
    JOIN users ON bookings.user_id = users.id
");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h3 class="text-center my-4">Admin Dashboard</h3>
    <h4>All Bookings</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Room</th>
                <th>User</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $booking['id']; ?></td>
                <td><?= htmlspecialchars($booking['room_name']); ?></td>
                <td><?= htmlspecialchars($booking['user_name']); ?></td>
                <td><?= htmlspecialchars($booking['booking_date']); ?></td>
                <td><?= htmlspecialchars($booking['booking_time']); ?></td>
                <td>
                    <a href="delete_booking.php?id=<?= $booking['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
2. Room Management
Allow admins to add, edit, and delete rooms.

HTML and PHP for Room Management
php
Copy code
<div class="container">
    <h4>Manage Rooms</h4>
    <a href="add_room.php" class="btn btn-success mb-3">Add Room</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Capacity</th>
                <th>Equipment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM rooms");
            $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rooms as $room):
            ?>
            <tr>
                <td><?= $room['id']; ?></td>
                <td><?= htmlspecialchars($room['name']); ?></td>
                <td><?= htmlspecialchars($room['capacity']); ?></td>
                <td><?= htmlspecialchars($room['equipment']); ?></td>
                <td>
                    <a href="edit_room.php?id=<?= $room['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_room.php?id=<?= $room['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
This approach handles browsing, booking, and admin functionalities step-by-step. Let me know if you need any further customizations!






You said:
where is the JS
ChatGPT said:
ChatGPT
To include JavaScript functionality, you can enhance the room booking system with validation, AJAX for seamless interactions, and interactive UI elements. Here's how JavaScript can be integrated:

1. Dynamic Form Validation for Booking and Registration
Use JavaScript to validate user inputs before submitting forms.

Registration Form Validation
javascript
Copy code
document.getElementById("signup-form").addEventListener("submit", function (e) {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

    if (!email.endsWith("@uob.edu.bh")) {
        e.preventDefault();
        alert("Please use a valid UoB email address.");
    } else if (password !== confirmPassword) {
        e.preventDefault();
        alert("Passwords do not match.");
    }
});
Booking Form Validation
javascript
Copy code
document.getElementById("booking-form").addEventListener("submit", function (e) {
    const bookingDate = document.getElementById("booking_date").value;
    const bookingTime = document.getElementById("booking_time").value;

    if (!bookingDate || !bookingTime) {
        e.preventDefault();
        alert("Please select a valid booking date and time.");
    }
});
2. AJAX for Room Booking
Use AJAX to send booking data to the server without reloading the page.

AJAX for Submitting Booking
javascript
Copy code
document.getElementById("booking-form").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent default form submission
    const formData = new FormData(this);

    fetch("process_booking.php", {
        method: "POST",
        body: formData,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            alert("Booking successful!");
            location.reload(); // Reload the page or redirect
        } else {
            alert(data.error);
        }
    })
    .catch((error) => console.error("Error:", error));
});
Server-Side PHP for AJAX
In process_booking.php:

php
Copy code
<?php
header('Content-Type: application/json');
try {
    $pdo = new PDO("mysql:host=localhost;dbname=room_booking_system", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $room_id = $_POST['room_id'];
    $user_id = $_SESSION['user_id']; // Assume logged in
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    // Conflict checking
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE room_id = ? AND booking_date = ? AND booking_time = ?");
    $stmt->execute([$room_id, $booking_date, $booking_time]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'error' => 'This time slot is already booked.']);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, room_id, booking_date, booking_time) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $room_id, $booking_date, $booking_time]);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
3. Interactive Admin Panel
Use JavaScript for dynamic content loading, e.g., updating room availability without refreshing the page.

Interactive Room Deletion
javascript
Copy code
document.querySelectorAll(".delete-room").forEach((button) => {
    button.addEventListener("click", function () {
        const roomId = this.dataset.roomId;
        if (confirm("Are you sure you want to delete this room?")) {
            fetch(`delete_room.php?id=${roomId}`, { method: "DELETE" })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Room deleted successfully!");
                        location.reload(); // Reload the admin panel
                    } else {
                        alert(data.error);
                    }
                })
                .catch((error) => console.error("Error:", error));
        }
    });
});
Server-Side PHP for Room Deletion
In delete_room.php:

php
Copy code
<?php
header('Content-Type: application/json');
try {
    $pdo = new PDO("mysql:host=localhost;dbname=room_booking_system", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $room_id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM rooms WHERE id = ?");
    $stmt->execute([$room_id]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
4. Calendar for Room Schedules
Use a library like FullCalendar.js to visualize room bookings.

Initialize Calendar
javascript
Copy code
document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        events: "fetch_bookings.php", // Fetch events from server
    });

    calendar.render();
});
Server-Side PHP to Fetch Bookings
In fetch_bookings.php:

php
Copy code
<?php
header('Content-Type: application/json');
try {
    $pdo = new PDO("mysql:host=localhost;dbname=room_booking_system", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM bookings");
    $events = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $events[] = [
            'title' => "Room ID: " . $row['room_id'],
            'start' => $row['booking_date'] . "T" . $row['booking_time'],
        ];
    }
    echo json_encode($events);
} catch (Exception $e) {
    echo json_encode([]);
}
?>
Outcome
With these JavaScript enhancements, the system is interactive, responsive, and user-friendly:

Validation ensures accurate data submission.
AJAX enables seamless booking and admin interactions.
The calendar provides a clear view of room schedules.
Let me know if you need further adjustments!