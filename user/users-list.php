<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>
<?php
if($_SESSION['LoggedInUser']['role'] == 0){
  header('Location: ../logout.php');
}
?>
<body class="login-bg">
<?php include '../includes/header.php' ?>
<?php include '../includes/sidebar.php' ?>
  <main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body main-table">
              <?php include '../backend/status-messages.php' ?>
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Users list</h5>
                <a href="user-add.php" class="btn btn-sm btn-sm btn-primary">
                  Add user
                </a>
              </div>

              <?php
              $tableName = "users";
              $id = $_SESSION['LoggedInUser']['id'];

              $sql = "SELECT * FROM $tableName WHERE id != $id OR id != 3";
              $result = $conn->query($sql);

              ?>
              <script>
                function getTotalEntries() {
                  return <?= $result->num_rows ?>;
                }
              </script>

              <table id="example" class="display nowrap">
                <thead>
                  <tr>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Role</th>
                    <th>isBanned</th>
                    <th>Last Activity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  
                  ?>
                  <tr>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['full_name']; ?></td>
                    <td><?= $row['role'] == 1 ? '<a class="btn btn-sm btn-success">ADMIN</a>' : '<a class="btn btn-sm btn-primary">STANDARD</a>';?></td>
                    <td><?= $row['is_banned']  == 1 ? '<a class="btn btn-sm btn-warning">Banned</a>' : '<a class="btn btn-sm btn-success">Allowed</a>'; ?></td>
                    <td><?= $row['last_activity']?></td>
                    <td>
                      <a href="user-edit.php?id=<?= $row['id']?>" class="btn btn-sm btn-info">view</a>
                      <a href="../backend/activity-logs.php?id=<?= $row['id']; ?>&users=Users"
                        class="btn btn-sm btn-secondary"><i class="bi bi-info-circle-fill"></i></a>
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
  <script src="user.js"></script>
</body>

</html>