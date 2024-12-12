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
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Farmers list</h5>
                <div>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                    Filter
                  </button>
                  <a href="../farmer/farmer-add.php" class="btn btn-secondary"><i class="bi bi-plus-lg"></i></a>
                </div>
              </div>

              <?php include 'filter.php'; ?>

              <table id="example" class="display nowrap d-none">
                <thead>
                  <tr>
                    <th>Registration</th>
                    <th>FFRS</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Barangay</th>
                    <th>Gender</th>
                    <th>Birthday</th>
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
                        <td><?= $row['ffrs_system_gen'] === "" ? "UNREGISTERED" : "REGISTERED"; ?></td>
                        <td><?= $row['ffrs_system_gen'] ?></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['middle_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['farmer_brgy_address'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['birthday'] ?></td>
                        <td><?= $row['farmer_municipality_address'] ?></td>
                        <td>
                          <a href="farmer-view.php" class="btn btn-primary"><i class="bi bi-person-square"></i></a>
                          <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                          <a class="btn btn-secondary" href="activity-log.php?user_id=<?= $row['id']; ?>"><i class="bi bi-info-circle-fill"></i></a>

                        </td>
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

  <!-- ======= JavaScript for List Table ======= -->
  <script src="./farmer-list.js"></script>

</body>

</html>