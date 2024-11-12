<?php
$pageInstance = Page::getInstance();
$page = $pageInstance->getPage();

?>
<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#assets" data-bs-toggle="collapse" href="#">
    <i class="bi bi-house-fill"></i>
    <span>Assets</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="assets" class="nav-content collapse <?= $page == "crops.php" || $page == "parcels.php" || $page == "livestocks.php"? "show": ""?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="../farmer-assets/parcels.php" style="<?= page($page, "parcels.php", true);?>">
          <i class="bi bi-puzzle-fill" style="<?= page($page, "parcels.php");?>"></i><span style="<?= page($page, "parcels.php"); ?>">Parcels</span>
        </a>
      </li>
      <li>
        <a href="../farmer-assets/crops.php" style="<?= page($page, "crops.php", true);?>">
          <i class="bi bi-sun-fill" style="<?= page($page, "crops.php");?>"></i><span style="<?= page($page, "crops.php");?>">Crops</span>
        </a>
      </li>
      <li>
        <a href="../farmer-assets/livestocks.php" style="<?= page($page, "livestocks.php", true);?>">
          <i class="bi bi-piggy-bank-fill" style="<?= page($page, "livestocks.php");?>"></i><span style="<?= page($page, "livestocks.php");?>">Livestocks</span>
        </a>
      </li>
    </ul>
</li><!-- Assets-->