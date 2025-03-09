<?php
if (!isset($_SESSION['LoggedInUser']) || empty($_SESSION['LoggedInUser'])) {
    header("Location: ../logout.php");
    exit;
}
