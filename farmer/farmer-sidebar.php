<?php
$pageInstance = Page::getInstance();
$page = $pageInstance->getPage();
?>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#farmers" data-bs-toggle="collapse" href="#">
    <i class="bi bi-person-fill"></i><span>Farmers</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="farmers" class="nav-content collapse <?= $page == "farmer-list.php" || $page == "farmer-add.php" ? "show": "";?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="../farmer/farmer-list.php" style="<?= page($page, "farmer-list.php", true);?>">
          <i class="bi bi-circle-fill" style="<?= page($page, "farmer-list.php");?>"></i><span style="<?= page($page, "farmer-list.php");?>">List</span>
        </a>
      </li>
         <?php if ($_SESSION['LoggedInUser']['can_create'] == 1) {?>
      <li>
        <a href="../farmer/farmer-add.php" style="<?= page($page, "farmer-add.php", true);?>">
          <i class="bi bi-circle-fill"  style="<?= page($page, "farmer-add.php");?>"></i><span  style="<?= page($page, "farmer-add.php");?>">Create</span>
        </a>
      </li>
        <?php } ?>
    </ul>
  </li><!-- Farmers-->