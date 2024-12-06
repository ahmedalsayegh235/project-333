<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate form data
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $student_id = trim($_POST['st_id']);
        $address = trim($_POST['address']);
        $dob = trim($_POST['dob']);
        $password = trim($_POST['pass']);
        $confirm_password = trim($_POST['cpass']);
        $profile = $_FILES['profile'];

        // Check if passwords match
        if ($password !== $confirm_password) {
            echo json_encode(['status' => 'error', 'message' => 'Passwords do not match']);
            exit;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Validate and upload profile picture
        if (isset($profile) && $profile['error'] === UPLOAD_ERR_OK) {
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
            $allowed_mime_types = ['image/jpeg', 'image/png', 'image/webp'];
        
            // Get file extension and MIME type
            $file_extension = strtolower(pathinfo($profile['name'], PATHINFO_EXTENSION));
            $file_mime_type = mime_content_type($profile['tmp_name']);
        
            // Validate file extenstion
            if (!in_array($file_extension, $allowed_extensions) || !in_array($file_mime_type, $allowed_mime_types)) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid profile picture type']);
                exit;
            }
        
            // Generate unique file name and move file to uploads
            $profile_path = '../uploads/' . uniqid() . '.' . $file_extension;
            if (!move_uploaded_file($profile['tmp_name'], $profile_path)) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to upload profile picture']);
                exit;
            }
        } else {
            // Set a default placeholder profile picture
            $profile_path = '../img/placeholder.png'; // Ensure this file exists
        }

        // Insert user data into the database
        $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, student_id, profile_picture, address, dob, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([$name, $email, $phone, $student_id, $profile_path, $address, $dob, $hashed_password]);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to register user']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
