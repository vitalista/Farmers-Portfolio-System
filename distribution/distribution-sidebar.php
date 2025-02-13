<?php
$pageInstance = Page::getInstance();
$page = $pageInstance->getPage();
?>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#distribution" data-bs-toggle="collapse" href="#">
    <i class="bi bi-hand-index-fill"></i>
    <span>Distribution</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="distribution" class="nav-content collapse <?= $page == "distributions-list.php" || $page == "distribution-multiple-add.php" ? "show": ""?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="../distribution/distributions-list.php" style="<?= page($page, "distributions-list.php", true);?>">
          <i class="bi bi-circle-fill"  style="<?= page($page, "distributions-list.php");?>"></i><span  style="<?= page($page, "distributions-list.php");?>">List</span>
        </a>
      </li>
      <?php if ($_SESSION['LoggedInUser']['can_create'] == 1) {?>
      <li>
        <a href="../distribution/distribution-multiple-add.php" style="<?= page($page, "distribution-multiple-add.php", true);?>">
          <i class="bi bi-circle-fill" style="<?= page($page, "distribution-multiple-add.php");?>"></i><span style="<?= page($page, "distribution-multiple-add.php");?>">Create</span>
        </a>
      </li>
      <?php }?>
    </ul>
  </li><!-- Distribution-->