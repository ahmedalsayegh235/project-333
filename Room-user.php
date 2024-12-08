<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomy - Rooms</title>
  <?php require('inc/links.php'); ?>
</head>
<body>
 <?php require('inc/header-user.php');  ?>
  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">UOB Rooms</h2>
    <div class="h-line bg-dark"></div>
    
  </div>
<div class="container-fluid">
<div class="row">

  <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
      <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
      <div class="container-fluid flex-lg-column align-items-stretch">
      <h4 class="mt-2">Filter</h4>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
      <div class="border bg-light p-3 rounded mb-3">
        <h5 class="mb-3" style="font-size:18px;">Check availability</h5>
        <label class="form-label">date</label>
          <input type="date" class="form-control shadow-none mb-3">
          <label class="form-label">time</label>
          <input type="time" class="form-control shadow-none">
      </div>
      </div>
      </div>
    </nav>
  </div>

  <div class="col-lg-9 col-md-12 px-4">
<?php
try {
  // Fetch only active rooms
  $stmt = $pdo->prepare("SELECT * FROM rooms WHERE status = 1");
  $stmt->execute();
  $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if ($rooms) {
      foreach ($rooms as $room) {
          echo "
          <div class='card mb-4 border-0 shadow'>
              <div class='row g-0 p-3 align-items-center'>
                  <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                      <img src='images/placeholder.png' class='img-fluid rounded pe-5' alt='Room Image'>
                  </div>
                  <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                      <h5 class='fw-bold'>{$room['name']}</h5>
                      <div class='department mb-3'>
                        <h6 class='mb-1'>Department</h6>
                        <span class='badge badge-light custom-pill'>{$room['department']}</span>
                      </div>
                      <div class='features mb-3'>
                          <h6 class='mb-1'>Features</h6>
                          <span class='badge badge-light custom-pill'>Intel i5 Computers</span>
                          <span class='badge badge-light custom-pill'>20 Seats</span>
                          <span class='badge badge-light custom-pill'>Smart Board</span>
                      </div>
                      <h6 class='mb-1'>Description</h6>
                      <p>{$room['description']}</p>
                  </div>
                  <div class='col-md-2 text-center'>
                      <h6 class='mb-4'>Per 1 Hour</h6>
                      <a href='booking.php' type='button' class='btn btn-sm text-white custom-bg shadow-none mb-1'>
                            Book now
                            </a>
                      <a href='#' class='btn btn-sm btn-outline-dark shadow-none '>More Info</a>
                  </div>
              </div>
          </div>";
      }
  } else {
      echo "<p class='text-center'>No rooms available at the moment.</p>";
  }
} catch (Exception $e) {
  echo "<p class='text-center text-danger'>Failed to load rooms. Please try again later.</p>";
}
?>

   
  </div>


</div>
</div>





<!-- footer -->
<?php require('inc/footer.php');?>

</body>
</html>