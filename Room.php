<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomy - Rooms</title>
  <?php require('inc/links.php'); ?>
</head>
<body>
 <?php require('inc/header.php');  ?>
  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">UOB Rooms</h2>
    <div class="h-line bg-dark"></div>
    
  </div>
<div class="container">
<div class="row">

  <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-0">
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
    <div class="card mb-4 border-0 shadow">
      <div class="row g-0 p-3 align-text-center">
        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
          <img src="images/placeholder.png" class="img-fluid rounded pe-5">
        </div>
        <div class="col-md-5 px-lg-3 px-md-3 px-0">
          <h5 class="">simple room name</h5>
          <div class="features mb-3">
        <h6 class="mb-1">Features</h6>
        <span class="badge badge-light custom-pill">
          20 intel i5 computers
        </span>
        <span class="badge badge-light custom-pill">
          20 seats
        </span>
        <span class="badge badge-light custom-pill">
          Smart board
        </span>
        </div>
        </div>
        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-align-center">
          <h6 class="mb-4">per 1 hour</h6>
          <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2 ">Book now!</a>
          <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none ">More info</a>
  
        </div>
      </div>
    </div>
    <div class="card mb-4 border-0 shadow">
      <div class="row g-0 p-3 align-text-center">
        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
          <img src="images/placeholder.png" class="img-fluid rounded pe-5">
        </div>
        <div class="col-md-5 px-lg-3 px-md-3 px-0">
          <h5 class="">simple room name</h5>
          <div class="features mb-3">
        <h6 class="mb-1">Features</h6>
        <span class="badge badge-light custom-pill">
          20 intel i5 computers
        </span>
        <span class="badge badge-light custom-pill">
          20 seats
        </span>
        <span class="badge badge-light custom-pill">
          Smart board
        </span>
        </div>
        </div>
        <div class="col-md-2 text-align-center">
          <h6 class="mb-4">per 1 hour</h6>
          <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2 ">Book now!</a>
          <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none ">More info</a>
  
        </div>
      </div>
    </div>
    <div class="card mb-4 border-0 shadow">
      <div class="row g-0 p-3 align-text-center">
        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
          <img src="images/placeholder.png" class="img-fluid rounded pe-5">
        </div>
        <div class="col-md-5 px-lg-3 px-md-3 px-0">
          <h5 class="">simple room name</h5>
          <div class="features mb-3">
        <h6 class="mb-1">Features</h6>
        <span class="badge badge-light custom-pill">
          20 intel i5 computers
        </span>
        <span class="badge badge-light custom-pill">
          20 seats
        </span>
        <span class="badge badge-light custom-pill">
          Smart board
        </span>
        </div>
        </div>
        <div class="col-md-2 text-align-center">
          <h6 class="mb-4">per 1 hour</h6>
          <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2 ">Book now!</a>
          <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none ">More info</a>
  
        </div>
      </div>
    </div>
  </div>


</div>
</div>





<!-- footer -->
<?php require('inc/footer.php');?>

</body>
</html>