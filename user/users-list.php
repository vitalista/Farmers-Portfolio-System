<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<body class="login-bg">

  <!-- ======= Header ======= -->
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
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Users list</h5>
                <a href="user-add.php" class="btn btn-primary">
                  Create
                </a>
              </div>

              <?php
              $tableName = "users";
              $id = $_SESSION['LoggedInUser']['id'];

              $sql = "SELECT * FROM $tableName WHERE id != $id";
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
                    <th>isLoggedIn</th>
                    <th>isBanned</th>
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
                    <td><?= $row['role'] == 1 ? '<a class="btn btn-success">ADMIN</a>' : '<a class="btn btn-primary">STANDARD</a>';?></td>
                    <td><?= $row['is_logged_in'] == 1 ? '<a class="btn btn-success">Logged in</a>' : '<a class="btn btn-danger">Logged out</a>';?></td>
                    <td><?= $row['is_banned']  == 1 ? '<a class="btn btn-warning">Banned</a>' : '<a class="btn btn-success">Allowed</a>'; ?></td>
                    <td>
                      <a href="user-edit.php?id=<?= $row['id']?>" class="btn btn-info">view</a>
                      <!-- <a href="#" class="btn btn-danger">  </a> -->
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
  <script>
    let totalEntries = getTotalEntries();
    let twentyFivePercent = Math.ceil(totalEntries * 0.25);
    let fiftyPercent = Math.ceil(totalEntries * 0.50);
    let seventyFivePercent = Math.ceil(totalEntries * 0.75);

    let lengthMenuValues = [10, twentyFivePercent, fiftyPercent, seventyFivePercent, -1];
    let lengthMenuLabels = [10,
      `${twentyFivePercent} (25%)`,
      `${fiftyPercent} (50%)`,
      `${seventyFivePercent} (75%)`,
      "Show All"
    ];

    document.addEventListener("DOMContentLoaded", function() {
      const example = document.getElementById("example");

      setTimeout(() => {
        $('#example').DataTable({
          dom: 'ftp',
          responsive: true,
          colReorder: true,
          fixedHeader: true,
          rowReorder: false,
          lengthMenu: [
            lengthMenuValues, // Values for entries
            lengthMenuLabels // Labels for entries
          ],
          columnDefs: [{
            targets: 0,
            render: function(data, type, row) {
              if (type === 'display' || type === 'filter') {
                return `<strong>${data}</strong>`;
              }
              return null;
            }
          }]
        });
      }, 500);
    });
  </script>
</body>

</html>