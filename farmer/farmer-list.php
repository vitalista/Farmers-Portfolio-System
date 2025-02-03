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

             <?php include '../backend/status-messages.php';?>

              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Farmers list</h5>
                <div>
                <a href="farmer-list.php" class="btn btn-sm btn-danger">
                <i class="bi bi-arrow-counterclockwise"></i>
                </a>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                    <i class="bi bi-sort-down"></i>
                  </button>
                  <a href="../farmer/farmer-add.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus-lg"></i></a>
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
                        <td><strong><?= $row['ffrs_system_gen'] ?></strong></td>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['middle_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['farmer_brgy_address'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['farmer_municipality_address'] ?></td>
                        <?php if(!isset($_GET['archived'])):?>
                        <td>
                          <a href="farmer-view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-person-square"></i></a>
                          <a onclick="return confirm('Are you sure you want to archive it?')"
                            href="../backend/archive.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><i class="bi bi-archive-fill"></i></a>
                          <?php if ($_SESSION['LoggedInUser']['role'] == 1) {?>
                          <a class="btn btn-sm btn-secondary" href="../backend/activity-log.php?id=<?= $row['id']; ?>&farmers=Farmer"><i class="bi bi-info-circle-fill"></i></a>
                          <?php }?>
                        </td>
                        <?php else:?>
                          <td>
                          <a onclick="return confirm('Are you sure you want to restore it?')" 
                          href="../backend/restore.php?id=<?= $row['id'];?>" class="btn btn-sm btn-primary"><i class="bi bi-arrow-repeat"></i></a>
                          <?php if ($_SESSION['LoggedInUser']['role'] == 1) {?>
                          <a class="btn btn-sm btn-secondary" href="../backend/archived-log.php?id=<?= $row['id']; ?>&farmers=Farmer"><i class="bi bi-info-circle-fill"></i></a>
                          <?php }?>

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

    <script>
      const tds = document.querySelectorAll('td');

      let dataId = null;

      tds.forEach(td => {
        td.addEventListener('click', function() {
          dataId = this.getAttribute('data-id');
          console.log('Clicked TD with data-id: ' + dataId);
        });
      });

      function updateData(button) {
        const input = document.getElementById('ffrsCode');
        const inputValue = input.value;

        console.log('Input value:', inputValue);

        if (dataId) { // Ensure dataId is set before making the AJAX request
          $.ajax({
            url: 'update.php',
            type: 'POST',
            data: {
              id: dataId,
              ffrs: inputValue
            },
            success: function(response) {
              alert('Data updated successfully!');
              console.log(response);
              window.location.reload();
            },
            error: function(xhr, status, error) {
              alert('Error: ' + error);
            }
          });
        } else {
          alert('Please select a valid table row first!');
        }
      }
    </script>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>

  <!-- ======= JavaScript for List Table ======= -->
  <script src="./farmer-list.js"></script>

</body>

</html>