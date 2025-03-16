<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>
<?php
if($_SESSION['LoggedInUser']['role'] != 1){
  header('Location: ../logout.php');
}
?>
<body class="login-bg">
<?php include '../includes/header.php' ?>
<?php include '../includes/sidebar.php' ?>

  <!-- Main Content -->
  <main id="main" class="main">
    <section class="section">
          <div class="card">
            <div class="card-body main-table">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Activity logs</h5>
                <a onclick="window.history.back();" class="btn btn-sm btn-danger">
                  Back
                </a>
              </div>

              <table id="example" class="display nowrap">
                <thead>
                  <tr>
                    <th>ACTION</th>
                    <th>TABLE</th>
                    <th>CREATED BY</th>
                    <th>CREATED AT</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $query = "SELECT * FROM activity_logs";

                if ($stmt = $conn->prepare($query)) {
                    $stmt->execute();
                
                    $result = $stmt->get_result();
                
                    $logs = $result->fetch_all(MYSQLI_ASSOC);
                
                    if ($logs) {
                        foreach ($logs as $log) {
                
                            // Format the date
                            $createdAtFormatted = date("l, F-d-Y h:i:s A", strtotime($log['created_at']));
                
                            // Default to 'Unknown' if user data is invalid or unavailable
                            $fullName = '';
                            $user = getById('users', $log['created_by']);
                            
                            if ($user && $user['status'] == 200) {
                                $fullName = empty($user['data']['full_name']) ? $user['data']['email'] : $user['data']['full_name'];
                            } else {
                                $fullName = 'INVALID USER';
                            }
                
                            // If the created date is invalid, set it to 'N/A'
                            $createdAtFormatted = isset($createdAtFormatted) ? $createdAtFormatted : 'N/A';
                
                            // Output the row
                            echo "
                            <tr>
                                <td>{$log['action_type']}</td>
                                <td>{$log['table_name']}</td>
                                <td>{$fullName}</td>
                                <td>{$createdAtFormatted}</td>
                            </tr>
                            ";
                        }
                
                    } 
                    $stmt->close();
                } else {
                    echo 'Error preparing query.';
                }

                ?>  
                </tbody>
              </table>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <?php include '../includes/footer.php' ?>
  <script>
    let totalEntries = 6; // Total number of entries in your table
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

    $(document).ready(function() {
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
    });
  </script>

</body>

</html>
