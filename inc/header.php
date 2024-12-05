 <?php require('admin/inc/db_config.php');
 require('admin/inc/essentials.php');
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
          <a class="nav-link active me-2" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link me-2" href="room.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="facilities.php">Facilities</a>
        </li><li class="nav-item">
          <a class="nav-link me-2" href="contact.php">Contact us</a>
        </li><li class="nav-item">
          <a class="nav-link me-2" href="about.php">About</a>
        </li>
      </ul>
      <div class="d-flex">
      <button type="button" class="btn btn-outline-light shadow-none custom-spacing" data-toggle="modal" data-target="#loginModal">
    Login
</button>
        <button type="button" class="btn btn-outline-light shadow-none custom-spacing" data-toggle="modal" data-target="#signupModal">
        Sign up
        </button>
      </div>
    </div>
  </nav>
<!--Login-->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <form>
        <div class="modal-header">
          <h5 class="modal-title">
          <i class="bi bi-person-circle fs-3 me-2"></i> User Login
          </h5>
          <button type="reset" class="close shadow-none" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Email address</label>
          <input type="email" class="form-control shadow-none">
       </div>  
       <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control shadow-none">
       </div> 
       <div class="d-flex align-items-center justify-content-between mb-2">
        <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
        <a href="javascript: void(0)" class="text-secondary text-decoration-none">forgot your password?</a>
       </div>
        </div>
        </form>
      </div>
    </div>
</div>
<!-- signup-->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <form>
        <div class="modal-header">
          <h5 class="modal-title">
          <i class="bi bi-person-add fs-3 me-2"></i> User Signup
          </h5>
          <button type="reset" class="close shadow-none" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <span class="badge badge-light custom-pill">
          Note: your details must match with your ID (Student id, cpr, etc...)
          that will be required during room usage.
        </span>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control shadow-none">
            </div>
            <div class="col-md-6 p-auto mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control shadow-none">
            </div>
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">Phone No.</label>
            <input type="number" class="form-control shadow-none">
            </div>
            <div class="col-md-6 p-auto mb-3">
            <label class="form-label">Student ID</label>
            <input type="number" class="form-control shadow-none">
            </div>
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">picture</label>
            <input type="file" class="form-control-file shadow-none">
            </div>
            <div class="col-md-12 p-0 mb-3">
              <label class="form-label">Address</label>
                <textarea class="form-control shadow-none" rows="1"></textarea>
              </div>
              <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">date of birth</label>
            <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control shadow-none">
            </div>
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">confirm password</label>
            <input type="password" class="form-control shadow-none">
            </div>
          </div>
        </div>
        <div class="text-center my-1">
        <button type="submit" class="btn btn-dark shadow-none">SIGN UP</button>
        </div>
        </div>
        </form>
      </div>
    </div>
</div>