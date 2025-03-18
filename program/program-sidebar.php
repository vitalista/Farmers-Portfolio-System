<?php
$pageInstance = Page::getInstance();
$page = $pageInstance->getPage();
?>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#programs" data-bs-toggle="collapse" href="#">
    <i class="bi bi-envelope-fill"></i>
    <span>Programs</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="programs" class="nav-content collapse <?= $page == "programs-list.php" || $page == "program-add.php" || $page == "resources-list.php" || $page == "programs.php"? "show": ""?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="../program/programs-list.php" style="<?= page($page, "programs-list.php", true);?>">
          <i class="bi bi-circle-fill" style="<?= page($page, "programs-list.php");?>"></i><span style="<?= page($page, "programs-list.php");?>">List</span>
        </a>
      </li>
      <?php if ($_SESSION['LoggedInUser']['can_create'] == 1) {?>
      <li>
        <a href="../program/program-add.php" style="<?= page($page, "program-add.php", true);?>">
          <i class="bi bi-circle-fill" style="<?= page($page, "program-add.php");?>"></i><span style="<?= page($page, "program-add.php");?>">Create</span>
        </a>
      </li>
      <?php } ?>
      <li>
        <a href="../program/resources-list.php" style="<?= page($page, "resources-list.php", true);?>">
          <i class="bi bi-circle-fill"  style="<?= page($page, "resources-list.php");?>"></i><span  style="<?= page($page, "resources-list.php");?>">Resources</span>
        </a>
      </li>
      <?php if (is_dir('../registration')) {?>
        <li class="nav-item">
  <a class="nav-link" href="../registration/programs.php" style="<?= page($page, "programs.php", true); ?>">
    <i class="bi bi-envelope" style="<?= page($page, "programs.php"); ?>"></i>
    <span style="<?= page($page, "programs.php"); ?>">Programs</span>
  </a>
</li>
        <?php } ?>
    </ul>
  </li><!-- Programs-->