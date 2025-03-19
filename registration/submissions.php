<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>

<body class="login-bg">
  <?php
  if ($_SESSION['LoggedInUser']['role'] == 0 || $_SESSION['LoggedInUser']['role'] == 1) {
    include '../includes/header.php';
  }
  if ($_SESSION['LoggedInUser']['role'] == 2) {
    include '../registration/registration-header.php';
  }
  ?>

  <!-- ======= Sidebar ======= -->
  <?php
  if ($_SESSION['LoggedInUser']['role'] == 0 || $_SESSION['LoggedInUser']['role'] == 1) {
    include '../includes/sidebar.php';
  }

  if ($_SESSION['LoggedInUser']['role'] == 2) {
    include '../registration/registration-sidebar.php';
  }
  ?>

  <main id="main" class="main">

    <section class="section">
      <div class="card">
        <div class="card-body main-table pt-5">

          <table id="example" class="display">
            <thead>
              <tr>
                <th class="text-start">FFRS</th>
                <th class="text-start">Status</th>
                <th class="text-start">Created at</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $id = validate($_SESSION['LoggedInUser']['id']);
              $sql = "SELECT * FROM `farmers` WHERE `created_by` = " . $id;
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
              ?>
                  <tr>
                    <td><?= empty($row['ffrs_system_gen']) ? 'Unregistered' : $row['ffrs_system_gen'];?></td>
                    <td class="text-start fw-bold"><?= $row['selected_enrollment'] == '' ? 'None': $row['selected_enrollment'] ; ?></td>
                    <td class="text-start"><?= $row['created_at']; ?></td>
                  </tr>
              <?php
                }
              }

              ?>
              <script>
                  function getTotalEntries() {
                      return <?= $result->num_rows; ?>
                  }
              </script>

            </tbody>

          </table>

        </div>
      </div>
    </section>
  </main>
  <?php include '../includes/footer.php' ?>
  <script src="../user/user.js"></script>

</body>

</html>