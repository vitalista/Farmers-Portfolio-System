
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">
<?php
$pageInstance = Page::getInstance();
$page = $pageInstance->getPage();
?>
<li class="nav-item">
  <a class="nav-link" href="../registration/index.php" style="<?= page($page, "index.php", true); ?>">
    <i class="bi bi-person-lines-fill" style="<?= page($page, "index.php"); ?>"></i>
    <span style="<?= page($page, "index.php"); ?>">RSBSA</span>
  </a>
</li><!--DashBoard -->
<li class="nav-item">
  <a class="nav-link" href="../registration/programs.php" style="<?= page($page, "programs.php", true); ?>">
    <i class="bi bi-envelope" style="<?= page($page, "programs.php"); ?>"></i>
    <span style="<?= page($page, "programs.php"); ?>">Programs</span>
  </a>
</li><!--DashBoard -->

</ul>
</aside>