<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<body class="login-bg">
<?php include '../includes/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php include '../includes/sidebar.php' ?>

  <main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body main-table">
              <?php include '../backend/status-messages.php';?>
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Distribution list</h5>
                <div>
                <a href="distributions-list.php" class="btn btn-sm btn-danger">
                <i class="bi bi-arrow-counterclockwise"></i>

                </a>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                  <i class="bi bi-sort-down"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#columnSelectionModal">
                    <i class="bi bi-table"></i>
                  </button>
                  <?php if ($_SESSION['LoggedInUser']['can_create'] == 1) {?>
                  <a href="distribution-multiple-add.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus-lg"></i></a>
                <?php } ?>
                </div>

              </div>
              
              <?php include 'filter.php'; ?>
              <?php include 'columns-selection-modal.php'; ?>

              <table id="example" class="display nowrap mt-3">
                <thead>
                  <tr>
                    <?php $selectedColumns = isset($_GET['columns']) ? $_GET['columns'] : ['distribution_code', 'distribution_date', 'quantity_distributed'];?>
                    <?php include 'distributions-th-content.php';?>
                    <?php include '../farmer/farmer-th-content.php';?>
                    <?php include '../program/programs-th-content.php';?>
                    <?php include '../program/resources-th-content.php';?>
                    
                    <th class="text-start notExport">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr>

                      <?php include 'distributions-td-content.php';?>
                      <?php include '../farmer/farmer-td-content.php';?>
                      <?php include '../program/programs-td-content.php';?>
                      <?php include '../program/resources-td-content.php';?>
                         
                        <?php if(!isset($_GET['archived'])):?>
                        <td class="text-start">
                        <?php if ($_SESSION['LoggedInUser']['can_edit'] == 1) {?>
                        <a href="distribution-view.php?id=<?= $row['id']?>" class="btn btn-sm btn-secondary"><i class="bi bi-pencil-square"></i></a>
                        <a href="../farmer/farmer-view.php?id=<?= $row['farmer_id'];?>" class="btn btn-sm btn-success"><i class="bi bi-person-square"></i></a>
                        <a href="../program/program-view.php?id=<?= $row['program_id'];?>" class="btn btn-sm btn-primary"><i class="bi bi-box2-fill"></i></a>
                        <?php } ?>
                        <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) {?>
                        <a onclick="return confirm('Are you sure you want to archive it?')" 
                         href="../backend/archive.php?distributions_id=<?= $row['id'];?>" class="btn btn-sm btn-danger"><i class="bi bi-archive-fill"></i></a>
                         <?php }?>
                         <?php if ($_SESSION['LoggedInUser']['role'] == 1) {?>
                         <a href="../backend/activity-logs.php?id=<?= $row['id']; ?>&distributions=Distributions"
                        class="btn btn-sm btn-secondary"><i class="bi bi-info-circle-fill"></i></a>
                        <?php }?>
                        </td>
                        <?php else:?>
                          <td class="text-start">
                          <a onclick="return confirm('Are you sure you want to archive it?')" 
                          href="../backend/restore.php?distributions_id=<?= $row['id'];?>" class="btn btn-sm btn-primary"><i class="bi bi-arrow-repeat"></i></a>
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
  <script src="../assets/js/dttable.js"></script>
</body>

</html>