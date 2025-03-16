<?php
if ($_SESSION['LoggedInUser']['role'] === 2) {
    redirect('../logout.php', 500, 'Access denied');
}
