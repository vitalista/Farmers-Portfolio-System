<?php
if (!isset($_SESSION['LoggedInUser']) || empty($_SESSION['LoggedInUser'])) {
    redirect('../login/', 500, 'Unauthorized Access! Please login to access the page.');
    exit;
}

if ($_SESSION['LoggedIn'] == false) {
     redirect('../logout.php', 500, 'Unauthorized Access! Please login to access the page.');
    exit;
}
