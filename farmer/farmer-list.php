<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>

<body class="login-bg">
  <?php include '../includes/header.php'; ?>
  <?php include '../includes/sidebar.php'; ?>
  <?php require '../backend/database.php'; ?>


  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body main-table">

              <?php include '../backend/status-messages.php'; ?>

              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Farmers list</h5>
                <div>
                  <a href="farmer-list.php" class="btn btn-sm btn-danger">
                    <i class="bi bi-arrow-counterclockwise"></i>
                  </a>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                    <i class="bi bi-sort-down"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#columnSelectionModal">
                    <i class="bi bi-table"></i>
                  </button>
                  <?php if ($_SESSION['LoggedInUser']['can_create'] == 1) { ?>
                    <a href="../farmer/farmer-add.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus-lg"></i></a>
                  <?php } ?>
                </div>
              </div>

              <?php include 'filter.php'; ?>
              <?php include 'columns-selection-modal.php'; ?>

              <table id="example" class="display nowrap">
                <thead>
                  <tr>
                    <th>Registration</th>
                    <th>FPS</th>
                    <th>FFRS</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Barangay</th>
                    <th>Gender</th>
                    <th>Municipality</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr>
                        <input type="hidden" value="<?= $row['id'] ?>">
                        <td data-id="<?= $row['id'] ?>"><?= $row['ffrs_system_gen'] === "" ? "UNREGISTERED" : "REGISTERED"; ?></td>
                        <td><strong><?= $row['fps_code'] ?></strong></td>
                        <td><strong><?= $row['ffrs_system_gen'] ?></strong></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['middle_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['farmer_brgy_address'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['farmer_municipality_address'] ?></td>
                        <?php if (!isset($_GET['archived'])): ?>
                          <td>
                            <?php if ($_SESSION['LoggedInUser']['can_edit'] == 1) { ?>
                              <a href="farmer-view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success"><i class="bi bi-person-square"></i></a>
                            <?php } ?>
                            <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) { ?>
                              <a onclick="return confirm('Are you sure you want to archive it?')"
                                href="../backend/archive.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><i class="bi bi-archive-fill"></i></a>
                            <?php } ?>
                            <?php if ($_SESSION['LoggedInUser']['role'] == 1) { ?>
                              <a class="btn btn-sm btn-secondary" href="../backend/activity-logs.php?id=<?= $row['id']; ?>&farmers=Farmer"><i class="bi bi-info-circle-fill"></i></a>
                            <?php } ?>
                          </td>
                        <?php else: ?>
                          <td>
                            <a onclick="return confirm('Are you sure you want to restore it?')"
                              href="../backend/restore.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-arrow-repeat"></i></a>
                          </td>
                        <?php endif; ?>
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
  </main>
  <script src="./farmer-list.js"></script>
  <?php include '../includes/footer.php' ?>

</body>

</html>