<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>

<body class="login-bg">
  <?php include '../includes/header.php'; ?>
  <?php include '../includes/sidebar.php'; ?>

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
            <?php
            try {
                $selectedColumns = isset($_GET['columns']) ? $_GET['columns'] : ['ffrs', 'first_name', 'last_name'];
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            ?>
                    <?php include 'farmer-th-content.php'; ?>
                  
                    <th class="notExport">Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr>
                        <?php include 'farmer-td-content.php'; ?>
                        
                        <?php if (!isset($_GET['archived'])): ?>
                          <td>
                          <!-- <a href="../farmer-assets/parcels.php?fps=" data-bs-toggle="tooltip" data-bs-placement="top" title="View Parcels" class="btn btn-sm btn-primary"><i class="bi bi-puzzle-fill"></i></a> -->
                          <a href="farmer-view.php?id=<?= $row['id']?>&farms=true" data-bs-toggle="tooltip" data-bs-placement="top" title="View Parcels" class="btn btn-sm btn-primary"><i class="bi bi-house-door"></i></i></a>
                            <?php if ($_SESSION['LoggedInUser']['can_edit'] == 1) { ?>
                              <a href="farmer-view.php?id=<?= $row['id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="View Farmer Profile" class="btn btn-sm btn-success"><i class="bi bi-person-circle"></i></a>
                            <?php } ?>
                            <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) { ?> 
                              <a onclick="return confirm('Are you sure you want to archive it?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive"
                                href="../backend/archive.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><svg class="svg-archive" height="17" viewBox="0 0 46 46" width="17" xmlns="http://www.w3.org/2000/svg"><path d="M41.09 10.45l-2.77-3.36c-.56-.66-1.39-1.09-2.32-1.09h-24c-.93 0-1.76.43-2.31 1.09l-2.77 3.36c-.58.7-.92 1.58-.92 2.55v25c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4v-25c0-.97-.34-1.85-.91-2.55zm-17.09 24.55l-11-11h7v-4h8v4h7l-11 11zm-13.75-25l1.63-2h24l1.87 2h-27.5z"/><path d="M0 0h48v48h-48z" fill="none"/></svg></a>
                            <?php } ?>
                            <?php if ($_SESSION['LoggedInUser']['role'] == 1) { ?>
                              <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="View Logs" href="../backend/activity-logs.php?id=<?= $row['id']; ?>&farmers=Farmer"><i class="bi bi-info-circle-fill"></i></a>
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