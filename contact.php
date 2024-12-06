<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roomy - Contact</title>
  <?php require('inc/links.php'); ?>
</head>
<body>
 <?php require('inc/header.php');  ?>
  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">UOB Contact</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">For inquiries or assistance, please feel free to reach out to us</p>
  </div>
<div class="container">
<div class="row">
  <div class="col-lg-6 col-md-6 mb-5 px-4">
    <div class="bg-white rounded shadow p-4">
      <iframe class="w-100 border-0 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11697.398768637!2d50.50737064919355!3d26.048143557531763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e484d5602da4725%3A0xbf673baa7596c6cd!2sUniversity%20of%20Bahrain!5e0!3m2!1sen!2sbh!4v1733222805707!5m2!1sen!2sbh"   loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <h5>Address</h5>
        <a href="https://maps.app.goo.gl/iAuscHptxCu5VBFP6" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
         <i class="bi bi-geo-alt-fill"></i> UOB
        </a>
        <h5 class="text-dark">contact UOB</h5>
        <a href="tel: +97317438888" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+973 1743 8888</a><br>
        <a href="email: website@admin.uob.bh" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-envelope"></i>website@admin.uob.bh</a>
     
    </div>
  </div>

  <div class="col-lg-6 col-md-6 mb-5 px-4 mt-2">
    <div class="bg-white rounded shadow p-4">
      <form method="POST">
        <h5>Send a message</h5>
        <div class="mt-3">
        <label class="form-label" style="font-weight:500;">Name</label>
        <input name="name" required type="text" class="form-control shadow-none">
        </div>

        <div class="mt-3">
        <label class="form-label" style="font-weight:500;">E-mail</label>
        <input type="email" name="email" required class="form-control shadow-none">
        </div>

        <div class="mt-3">
        <label class="form-label" style="font-weight:500;">Subject</label>
        <input type="text" name="subject" required class="form-control shadow-none">
        </div>

        <div class="mt-3">
        <label class="form-label" style="font-weight:500;">Message</label>
        <textarea class="form-control shadow-none" name="message" row="1" style="resize:none;"></textarea>
        </div>
        <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND</button>
      </form>
      <?php
if (isset($_POST['send'])) {
  // Sanitize and validate the input data
  $frm_data = [
      'name' => htmlspecialchars(trim($_POST['name'] ?? '')),
      'email' => htmlspecialchars(trim($_POST['email'] ?? '')),
      'subject' => htmlspecialchars(trim($_POST['subject'] ?? '')),
      'message' => htmlspecialchars(trim($_POST['message'] ?? '')),
  ];

  // Check if any required field is empty
  if (empty($frm_data['name']) || empty($frm_data['email']) || empty($frm_data['subject']) || empty($frm_data['message'])) {
      _alert('error', 'All fields are required.');
      return;
  }

  // Ensure valid email format
  if (!filter_var($frm_data['email'], FILTER_VALIDATE_EMAIL)) {
      _alert('error', 'Invalid email format.');
      return;
  }

  // Prepare the query
  $query = "INSERT INTO user_queries (`name`, `email`, `subject`, `message`) VALUES (?, ?, ?, ?)";
  $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

  try {
      $stmt = $pdo->prepare($query); // Use the PDO instance to prepare the query
      $res = $stmt->execute($values); // Execute with bound values

      if ($res) {
          _alert('success', 'Mail sent successfully!');
      } else {
          _alert('error', 'Failed to send the mail. Please try again.');
      }
  } catch (PDOException $e) {
      _alert('error', 'Database error: ' . $e->getMessage());
  }
}

?>
    </div>
  </div>
</div>
</div>





<!-- footer -->
<?php require('inc/footer.php');?>

</body>
</html>