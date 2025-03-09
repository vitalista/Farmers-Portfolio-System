<?php
$pageInstance = Page::getInstance();
$page = $pageInstance->getPage();
?>
<li class="nav-item">
  <a class="nav-link" href="../dashboard/dashboard.php" style="<?= page($page, "dashboard.php", true); ?>">
    <i class="bi bi-bar-chart-fill" style="<?= page($page, "dashboard.php"); ?>"></i>
    <span style="<?= page($page, "dashboard.php"); ?>">DashBoard</span>
  </a>
</li><!--DashBoard -->