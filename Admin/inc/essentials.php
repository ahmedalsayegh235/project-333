<?php
function adminLogin()
{
    session_start();
    if(!(isset($_SESSION['adminlogin'])&& $_SESSION['adminlogin']==true))
    {
        echo "<script>
        window.location.href='index.php';
        </script>";
    }
    session_regenerate_id(true);
}
function redirect($url)
{
    echo "<script>
        window.location.href='$url';
        </script>"; 
}
// fix this stupid alert sign, it doesnt want to go in place 
function alert($type,$msg)
{
    $bs_class=($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
    <div class="alert" $bs_class alert-dismissible fade show custom-alert" role="alert">
        <strong class="me-3">$msg</strong»
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></buttons>
    </div>
    alert;
}


