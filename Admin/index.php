<?php  require('inc/db_config.php');
require("inc/essentials.php");
session_start();
if((isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']==true))
    {
        redirect("dashboard.php");
    }
$error_message = "";
if (isset($_POST['login'])) {
    // Sanitize input data
    $frm_data = filteration($_POST);

    // Query syntax
    $query = "SELECT * FROM admin_cred WHERE admin_name = ? AND admin_pass = ?";
    $values = [$frm_data['admin_name'], $frm_data['admin_pass']];

    try {
        // Prepare and execute the query
        $stmt = $pdo->prepare($query); 
        $stmt->execute($values);

        // Check if any rows were returned
        if ($stmt->rowCount() >= 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['adminlogin'] = true;
            $_SESSION['adminID'] = $row['sr_no'];

            // Redirect to dashboard
            redirect("dashboard.php");
            exit;
        } else {
            $error_message = "Invalid username or password. Please try again.";
        }
    } catch (PDOException $e) {
        $error_message = "An error occurred: " . $e->getMessage();
    }
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <?php require('inc/links.php') ?>
    <style>
        .login-form{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10rem;
        padding: 10%;
        }
    </style>
</head>
<body class="bg-light">
  <div class="login-form text-center rounded shadow overflow-hidden">
    <form  method="POST">
        <h4 class="bg-dark text-white py-3">Admin Login</h4>
        <div class="p-4">
        <div class="p-4">
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong> <?= $error_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
        <div class="mb-3">
          <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name ">
       </div>  
       <div class="mb-3">
          <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
       </div> 
       <button name="login" type="submit" class="btn text-white custom-bg shadow-none">Login</button>
    </div>
    </form>
  </div>  

</body>
</html>