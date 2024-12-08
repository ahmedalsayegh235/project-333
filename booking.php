<?php require('inc/header-user.php'); ?>
<?php
//  error reporting 
error_reporting(E_ALL);
ini_set('display_errors', 1);




// Initialize messages
$error_message = '';
$success_message = '';

// Booking logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        die("User not logged in. Please log in to book a room.");
    }

    $user_id = $_SESSION['user_id'];
    $room_id = $_POST['room_id'];
    $selected_date = $_POST['selected_date'];

    try {
        // Validate room and date input
        if (empty($room_id) || empty($selected_date)) {
            throw new Exception("Invalid input. Please select a valid room and date.");
        }

        // Check if the room is already booked by any user on the selected date
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM bookings 
            WHERE room_id = ? AND selected_date = ? AND status != 'Cancelled'
        ");
        $stmt->execute([$room_id, $selected_date]);
        $isBooked = $stmt->fetchColumn() > 0;

        if ($isBooked) {
            $error_message = "This room is already booked by another user for the selected date.";
        } else {
            // Insert booking into the database
            $stmt = $pdo->prepare("
                INSERT INTO bookings (user_id, room_id, selected_date, status) 
                VALUES (?, ?, ?, 'Pending')
            ");
            if ($stmt->execute([$user_id, $room_id, $selected_date])) {
                $success_message = "Room booked successfully! Your booking is pending confirmation.";
            } else {
                $errorInfo = $stmt->errorInfo();
                $error_message = "Failed to book room: " . $errorInfo[2];
            }
        }
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Fetch user's bookings
$user_bookings = [];
if (isset($_SESSION['user_id'])) {
    try {
        $stmt = $pdo->prepare("
            SELECT b.id, r.name AS room_name, b.selected_date, b.status 
            FROM bookings b 
            JOIN rooms r ON b.room_id = r.id 
            WHERE b.user_id = ?
        ");
        $stmt->execute([$_SESSION['user_id']]);
        $user_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error_message = "Error fetching bookings: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book a Room</title>
  <?php require('inc/links.php'); ?>
</head>
<body>


  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">Book a Room</h2>
    <div class="h-line bg-dark"></div>
  </div>

  <div class="container">
    <!-- Success or Error Message -->
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($success_message); ?>
        </div>
        <script>
          alert("Booking Successful!");
        </script>
    <?php endif; ?>

    <!-- Booking Form -->
    <form method="POST" class="card p-4 shadow mb-5">
      <div class="mb-3">
        <label for="room_id" class="form-label">Select Room</label>
        <select name="room_id" id="room_id" class="form-select" required>
          <option value="" disabled selected>Select a room</option>
          <?php
          // Fetch active rooms
          try {
              $stmt = $pdo->query("SELECT id, name FROM rooms WHERE status = 1");
              while ($room = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo "<option value='" . htmlspecialchars($room['id']) . "'>" . htmlspecialchars($room['name']) . "</option>";
              }
          } catch (PDOException $e) {
              echo "<option disabled>Error loading rooms: " . htmlspecialchars($e->getMessage()) . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="selected_date" class="form-label">Booking Date</label>
        <input type="date" name="selected_date" id="selected_date" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Book Now</button>
    </form>

    <!-- User Bookings Table -->
    <h3 class="mb-4">My Bookings</h3>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Room</th>
            <th>Booking Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($user_bookings)): ?>
            <?php foreach ($user_bookings as $booking): ?>
              <tr>
                <td><?php echo htmlspecialchars($booking['id']); ?></td>
                <td><?php echo htmlspecialchars($booking['room_name']); ?></td>
                <td><?php echo htmlspecialchars($booking['selected_date']); ?></td>
                <td><?php echo htmlspecialchars($booking['status']); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center">No bookings found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>
</body>
</html>
