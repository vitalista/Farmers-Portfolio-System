<?php
$pageInstance = Page::getInstance();
$page = $pageInstance->getPage();
?>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#users" data-bs-toggle="collapse" href="#">
    <i class="bi bi-person-circle"></i>
    <span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="users" class="nav-content collapse <?= $page == "users-list.php" || $page == "user-add.php" || $page == "activity-logs.php" || $page == "registrations.php" ? "show": ""?>" data-bs-parent="#sidebar-nav">
      <?php if(is_dir('../registration')){?>
        <li>
        <a href="../user/registrations.php" style="<?= page($page, "registrations.php", true);?>">
          <i class="bi bi-circle-fill" style="<?= page($page, "registrations.php");?>"></i><span style="<?= page($page, "registrations.php");?>">Registrations</span>
        </a>
      </li>
      <?php }?>
      <li>
        <a href="../user/users-list.php" style="<?= page($page, "users-list.php", true);?>">
          <i class="bi bi-circle-fill" style="<?= page($page, "users-list.php");?>"></i><span style="<?= page($page, "users-list.php");?>">List</span>
        </a>
      </li>
      <li>
        <a href="../user/user-add.php" style="<?= page($page, "user-add.php", true);?>">
          <i class="bi bi-circle-fill" style="<?= page($page, "user-add.php");?>"></i><span style="<?= page($page, "user-add.php");?>">Create</span>
        </a>
      </li>
      <li>
        <a href="../user/activity-logs.php" style="<?= page($page, "activity-logs.php", true);?>">
          <i class="bi bi-circle-fill" style="<?= page($page, "activity-logs.php");?>"></i><span style="<?= page($page, "activity-logs.php");?>">Activity Logs</span>
        </a>
      </li>
    </ul>
  </li><!-- users-->