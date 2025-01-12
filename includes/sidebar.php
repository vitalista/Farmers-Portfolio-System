<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

<?php includes('../dashboard/dashboard-sidebar.php') ?>

<?php includes('../map/map-sidebar.php')?>

<?php includes('../farmer/farmer-sidebar.php') ?>

<?php includes('../farmer-assets/assets-sidebar.php')?>

<?php includes('../program/program-sidebar.php')?>

<?php includes('../prices/price-sidebar.php')?>

<?php includes('../distribution/distribution-sidebar.php') ?>

<?php
if ($_SESSION['LoggedInUser']['role'] == 1) {
includes('../user/users-sidebar.php');
} 
?>


</ul>

</aside><!-- End Sidebar-->