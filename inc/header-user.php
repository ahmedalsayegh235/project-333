 <?php require('admin/inc/db_config.php');
 require('inc/essentials.php');

 session_start();
if (!isset($_SESSION['userlogin']) || $_SESSION['userlogin'] != true) {
    header("Location: index.php");
    exit();
}
?>
 <!-- navbar -->
 <nav class="navbar navbar-expand-lg navbar-light px-lg-3 py-lg-2 shadow sticky-top">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><i class="fas fa-door-open"></i>Roomy</a>
    <button class="navbar-toggler shadow-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link active me-2" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link me-2" href="room-user.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="facilities-user.php">Facilities</a>
        </li><li class="nav-item">
          <a class="nav-link me-2" href="contact-user.php">Contact us</a>
        </li><li class="nav-item">
          <a class="nav-link me-2" href="about-user.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="Booking.php">Bookings</a>
        </li>
      </ul>
      <div class="d-flex">
    
      <?php if (!empty($error_message)): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong> <?= $error_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
<!-- Display user name and student ID -->
<div class="me-3 text-dark d-flex align-items-center">
        <strong>Welcome </strong><?= htmlspecialchars($_SESSION['name']); ?>, 
        <strong>Student no. </strong><?= htmlspecialchars($_SESSION['student_id']); ?>
    </span>
    <img src="path_to_user_image/<?= htmlspecialchars($_SESSION['profile_picture']); ?>" 
         alt="User Image" 
         class="rounded-circle me-2" 
         style="width: 60px; height: 60px; object-fit: cover;">
</div>
                <div class="d-flex">
      <a href="logout.php" class="btn btn-light btn-md" style="margin-bottom:1rem; margin-top:1rem">LOG OUT</a>
      </div>
      </div>
    </div>
  </nav>

