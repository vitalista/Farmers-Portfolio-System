<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<body class="login-bg">
<?php include '../includes/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php include '../includes/sidebar.php' ?>
  <!-- Database -->

  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body main-table">
            <?php include '../backend/status-messages.php';?>
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Resources list</h5>
                <div>
                  <a href="resources-list.php" class="btn btn-sm btn-danger">                <i class="bi bi-arrow-counterclockwise"></i>
                  </a>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                  <i class="bi bi-sort-down"></i>

                  </button>
                  <?php if ($_SESSION['LoggedInUser']['can_create'] == 1) {?>
                  <a href="program-add.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus-lg"></i></a>
                <?php } ?>
                </div>
              </div>
              <?php include 'resources-filter.php'; ?>

              <!-- <a href="#" class="btn btn-sm -btn-success">Completed</a> -->

              <table id="example" class="display nowrap d-none">
                <thead>
                  <tr>
                    <th class="text-start">FPS</th>
                    <th class="text-start">Program Name</th>
                    <th class="text-start">Resources Type</th>
                    <th class="text-start">Total Quantity</th>
                    <th class="text-start">Quantity Available</th>
                    <th class="text-start">Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                    <td class="text-start"><?= $row['fps_code'];?></td>
                    <td class="text-start"><?= $row['program_name'];?></td>
                    <td class="text-start"><?= $row['resource_type'];?></td>
                    <td class="text-start"><?= $row['total_quantity'];?></td>
                    <td class="text-start"><?= $row['quantity_available'];?></td>
                    <?php if(!isset($_GET['archived'])):?>
                    <td class="text-start">
                    <?php if ($_SESSION['LoggedInUser']['can_edit'] == 1) {?>
                      <a href="program-view.php?id=<?= $row['program_id'];?>" class="btn btn-sm btn-primary"><i class="bi bi-box2-fill"></i></a>
                      <?php } ?>
                      <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) {?>
                      <a onclick="return confirm('Are you sure you want to archive it?')" 
                         href="../backend/archive.php?resources_id=<?= $row['id'];?>" class="btn btn-sm btn-danger"><i class="bi bi-archive-fill"></i></a>
                         <?php }?>
                         <?php if ($_SESSION['LoggedInUser']['role'] == 1) {?>
                         <a href="../backend/activity-logs.php?id=<?= $row['id']; ?>&resources=Resources"
                        class="btn btn-sm btn-secondary"><i class="bi bi-info-circle-fill"></i></a>
                        <?php }?>
                    </td>
                    <?php else:?>
                          <td class="text-start">
                          <a onclick="return confirm('Are you sure you want to restore it?')" 
                          href="../backend/restore.php?resources_id=<?= $row['id'];?>" class="btn btn-sm btn-primary"><i class="bi bi-arrow-repeat"></i></a>
                          </td>
                    <?php endif;?>

                  </tr>
                  <?php
                    }
                  }
                  ?>

                </tbody>

              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>
  <script> const columns = [0, 1, 2, 3]; </script>
  <script src="../assets/js/dttable.js"></script>
</body>

</html>