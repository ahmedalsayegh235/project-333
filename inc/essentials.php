<?php
function userLogin()
{
    session_start();
    if (!(isset($_SESSION['userlogin']) && $_SESSION['userlogin'] == true)) {
        echo "<script>
        window.location.href='index.php';
        </script>";
        exit;
    }
    session_regenerate_id(true); // Regenerate session ID for security
}
?>
<?php
function redirect($url) {
    header("Location: " . $url);
    exit();
}
?>
