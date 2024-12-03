<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomy - Home</title>
  <?php require('inc/links.php'); ?>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<link rel="stylesheet" href="css/index-css.css">

</head>
<body>
 <?php require('inc/header.php');  ?>
<!-- carousel -->
<div class="container-fluid mt-2">
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="images/caro/2.jpg"class="custom-car" alt=""></div>
      <div class="swiper-slide"><img src="images/caro/1.jpg" class="custom-car" alt=""></div>
      <div class="swiper-slide"><img src="images/caro/3.jpg"class="custom-car" alt=""></div>
      <div class="swiper-slide"><img src="images/caro/4.jpeg" class="custom-car" alt=""></div>
      <div class="swiper-slide"><img src="images/caro/5.jpg"class="custom-car" alt=""></div>
    </div>
  </div>
</div>
<!-- availability -->
<div class="container mb-3 availability-form">
<div class="row">
  <div class="col-lg-12 bg-white shadow p-4 rounded">
    <h5 class="mb-4">Check booking availability</h5>
    <form>
      <div class="row align-items-end">
        <div class="col-lg-3 mb-3">
        <label class="form-label" style="font-weight:500;">booking date</label>
        <input type="date" class="form-control shadow-none">
        </div>
        <div class="col-lg-3 mb-3">
        <label class="form-label" style="font-weight:500;">booking time</label>
        <input type="time" class="form-control shadow-none">
        </div>
        <div class="col-lg-1 mb-lg-3 mt-2 ml-5">
          <button type="submit" class="btn text-white shadow-none custom-bg">Check</button>
        </div>
      </div>
    </form>
  </div>
</div>

</div>
<!-- rooms -->
<h2 class="mt-5 pt-5 mb-4 text-center fw-bold h-font">UOB ROOMS</h2>
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
        <img class="card-img-top" src="images/placeholder.png" alt="Card image cap">

      <div class="card-body">
        <h5>simple room name</h5>
        <h6 class="mb-3">per 1 hour</h6>
        <div class="features mb-1">
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
        <div class="facilities mb-1">
          <h6 class="mb-1">Facilities</h6>
          <span class="badge badge-light custom-pill">
          wifi
        </span><span class="badge badge-light custom-pill">
          ethernet
        </span>
        <span class="badge badge-light custom-pill">
          A/C
        </span>
        </div>
        <div class="rating mb-1">
        <h6 class="mb-1">Ratings</h6>
        <span class="badge rounded-pill bg-light"></span>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        </div>
        <div class="d-flex">
        <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book now!</a>
        <a href="#" class="btn btn-sm btn-outline-dark shadow-none ml-2">More info</a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
        <img class="card-img-top" src="images/placeholder.png" alt="Card image cap">

      <div class="card-body">
        <h5>simple room name</h5>
        <h6 class="mb-3">per 1 hour</h6>
        <div class="features mb-1">
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
        <div class="facilities mb-1">
          <h6 class="mb-1">Facilities</h6>
          <span class="badge badge-light custom-pill">
          wifi
        </span><span class="badge badge-light custom-pill">
          ethernet
        </span>
        <span class="badge badge-light custom-pill">
          A/C
        </span>
        </div>
        <div class="rating mb-1">
        <h6 class="mb-1">Ratings</h6>
        <span class="badge rounded-pill bg-light"></span>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        </div>
        <div class="d-flex">
        <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book now!</a>
        <a href="#" class="btn btn-sm btn-outline-dark shadow-none ml-2">More info</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
        <img class="card-img-top" src="images/placeholder.png" alt="Card image cap">

      <div class="card-body">
        <h5>simple room name</h5>
        <h6 class="mb-3">per 1 hour</h6>
        <div class="features mb-1">
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
        <div class="facilities mb-1">
          <h6 class="mb-1">Facilities</h6>
          <span class="badge badge-light custom-pill">
          wifi
        </span><span class="badge badge-light custom-pill">
          ethernet
        </span>
        <span class="badge badge-light custom-pill">
          A/C
        </span>
        </div>
        <div class="rating mb-1">
        <h6 class="mb-1">Ratings</h6>
        <span class="badge rounded-pill bg-light"></span>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        </div>
        <div class="d-flex">
        <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book now!</a>
        <a href="#" class="btn btn-sm btn-outline-dark shadow-none ml-2">More info</a>
        </div>
      </div>
    </div>
  </div>

    <div class="col-lg-12 text-center mt-5">
    <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms</a>
    </div>
  </div>
</div>
<!--Facilities -->
<h2 class="mt-5 pt-5 mb-4 text-center fw-bold h-font">UOB FACILITIES</h2>
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-6 my-3">
    <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
        <img class="card-img-top" src="images/placeholder.png" alt="Card image cap">
      <div class="card-body">
        <h5>Benefit lab</h5>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 my-3">
    <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
        <img class="card-img-top" src="images/placeholder.png" alt="Card image cap">
      <div class="card-body">
        <h5>Open lab</h5>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 my-3">
    <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
        <img class="card-img-top" src="images/placeholder.png" alt="Card image cap">
      <div class="card-body">
        <h5>Cloud innovation center</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 text-center mt-5">
    <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities</a>
    </div>
</div>
<!--Find UOB-->
<h2 class="mt-5 pt-5 mb-4 text-center fw-bold h-font">UOB Map</h2>
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 shadow" style="background-color:#5585b5; border-radius:1%;">
    <iframe class="w-100 border-0 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11697.398768637!2d50.50737064919355!3d26.048143557531763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e484d5602da4725%3A0xbf673baa7596c6cd!2sUniversity%20of%20Bahrain!5e0!3m2!1sen!2sbh!4v1733222805707!5m2!1sen!2sbh"   loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col-lg-4 col-md-4">
      <div class="p-4 rounded mb-4" style="background-color:#5585b5">
        <h5 class="text-white">contact UOB</h5>
        <a href="tel: +97317438888" class="d-inline-block mb-2 text-decoration-none text-white"><i class="bi bi-telephone-fill"></i>+973 1743 8888</a>
        <a href="email: website@admin.uob.bh" class="d-inline-block mb-2 text-decoration-none text-white"><i class="bi bi-envelope"></i>website@admin.uob.bh</a>
      </div>
      <div class="p-4 rounded mb-4" style="background-color:#5585b5">
        <h5 class="text-white">Follow UOB</h5>
        <a href="#" class="d-inline-block mb-2 text-decoration-none text-white">
          <span class="badge bg-light text-dark fs-6 p-2">
             <i class="bi bi-twitter-x me-1 mb-"></i> Twitter
          </span>
        </a>
        <br>
        <a href="#" class="d-inline-block mb-2 text-decoration-none text-white">
        <span class="badge bg-light text-dark fs-6 p-2">
           <i class="bi bi-instagram"></i> Instagram
        </span>
        </a>
        <br>
        <a href="#" class="d-inline-block mb-2 text-decoration-none text-white">
        <span class="badge bg-light text-dark fs-6 p-2">
           <i class="bi bi-snapchat"></i> Snapchat
        </span>
        <br>
        </a>
        <a href="#" class="d-inline-block mb-2 text-decoration-none text-white">
        <span class="badge bg-light text-dark fs-6 p-2">
           <i class="bi bi-facebook"></i> Facebook
        </span>
        </a>
        <br>
      </div>
    </div>
  </div>
</div>
<!-- footer -->
<?php require('inc/footer.php');?>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
      loop:true,
      autoplay: {
        delay: 3500,
        disableOnInteraction:false,

      }
    });
  </script>
</body>
</html>