
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