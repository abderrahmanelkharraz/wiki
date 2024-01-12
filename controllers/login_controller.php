<?php
// session_start();
// echo $_POST['log_email'];
if (isset($_POST['log_email'])) {
    $userRegistration = new UserLogin($db);
    $registrationResult = $userRegistration->loginUser($_POST['log_email'], $_POST['log_password']);
    // echo $registrationResult ;
    if (is_int($registrationResult) === true) {
        $_SESSION['email'] = $_POST['log_email'];
        echo "Login successful";
        die();
    } else {
        echo $registrationResult;
        die();
    }
}
