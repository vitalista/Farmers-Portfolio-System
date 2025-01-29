<?php
function isValidUserSession($sessionData) {
    return isset($sessionData['role']) && is_int($sessionData['role']) &&
           isset($sessionData['can_edit']) && is_int($sessionData['can_edit']) &&
           isset($sessionData['can_create']) && is_int($sessionData['can_create']) &&
           isset($sessionData['can_delete']) && is_int($sessionData['can_delete']) &&
           isset($sessionData['id']) && is_int($sessionData['id']) &&
           isset($sessionData['full_name']) && is_string($sessionData['full_name']);
}

if (!isset($_SESSION['LoggedInUser']) || empty($_SESSION['LoggedInUser']) || !isValidUserSession($_SESSION['LoggedInUser'])) {
    header("Location: ../logout.php");
    exit;
}
?>