 <?php require('admin/inc/db_config.php');
 require('inc/essentials.php');

session_start();

$error_message = ""; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    try {
        // Retrieve and sanitize inputs
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Check if both fields are filled
        if (empty($email) || empty($password)) {
            $error_message = "Please fill in both email and password.";
        } else {
            // Prepare the SQL query
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND status = 1 LIMIT 1");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch the user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Set session variables
                    $_SESSION['userlogin'] = true;
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['phone'] = $user['phone'];
                    $_SESSION['student_id'] = $user['student_id'];
                    $_SESSION['profile_picture'] = $user['profile_picture'];

                    // Redirect to the dashboard
                    redirect("dashboard.php");
                    exit;
                } else {
                    $error_message = "Invalid password. Please try again.";
                }
            } else {
                $error_message = "User not found. Please check your email.";
            }
        }
    } catch (PDOException $e) {
        $error_message = "An error occurred: " . $e->getMessage();
    }
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
    
      <?php if (!empty($error_message)): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong> <?= $error_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>


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
            <form method="POST">
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
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control shadow-none" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button name="login" type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                        <a href="javascript:void(0)" class="text-secondary text-decoration-none">Forgot your password?</a>
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
        <form id="register-form">
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
            <input name="name" type="text" class="form-control shadow-none" required>
            </div>
            <div class="col-md-6 p-auto mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control shadow-none" required>
            </div>
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">Phone No.</label>
            <input type="phonenum" name="phone" class="form-control shadow-none" required>
            </div>
            <div class="col-md-6 p-auto mb-3">
            <label class="form-label">Student ID</label>
            <input type="number" name="st_id" class="form-control shadow-none" required>
            </div>
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">picture</label>
            <input type="file" name="profile" accept=".jpg, .jpeg, .png .webp " class="form-control-file shadow-none">
            </div>
            <div class="col-md-12 p-0 mb-3">
              <label class="form-label">Address</label>
                <textarea class="form-control shadow-none" name="address" rows="1" required></textarea>
              </div>
              <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">date of birth</label>
            <input type="date" class="form-control shadow-none" name="dob" required>
            </div>
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control shadow-none" name="pass" required>
            </div>
            <div class="col-md-6 ps-auto mb-3">
            <label class="form-label">confirm password</label>
            <input type="password" class="form-control shadow-none" name="cpass" required>
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