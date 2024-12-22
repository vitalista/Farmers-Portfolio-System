<?php
// Database connection
$host = 'localhost';  // your database host
$dbname = 'baliwag_agriculture_office';  // your database name
$username = 'root';  // your database username
$password = '';  // your database password

// Create PDO instance for database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>
   
<body class="login-bg">
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/sidebar.php'; ?>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        .close-btn {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <div id="activityLogModal" class="modal fade" style="display: <?php echo isset($_GET['id']) ? 'block' : 'none'; ?>;" data-aos="fade-up" data-aos-delay="100">
        <div class="modal-content">
             <div class="d-flex p-2 mb-4"  style="border-bottom: 1px solid #dee2e6;">
             <h5 class="model-title">
                    Activity Log
                </h5>
            <a onclick="window.history.back();" class="close-btn">&times;</a>
             </div>
            
            <div id="activityLogContent">
                <?php
               
               if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                // Sanitize and assign the id
                $id = (int)$_GET['id'];
            
                // Fetch activity log for the user from the database

                $table;

                if(isset($_GET['farmers']) && is_string($_GET['farmers'])){
                    $table = $_GET['farmers'];
                    $stmt = $pdo->prepare('SELECT modified_by, modified_at, modified_times FROM farmers WHERE id = :id');
                }

                if(isset($_GET['parcels']) && is_string($_GET['parcels'])){
                    $table = $_GET['parcels'];
                    $stmt = $pdo->prepare('SELECT modified_by, modified_at, modified_times FROM parcels WHERE id = :id');
                }

                if(isset($_GET['crops']) && is_string($_GET['crops'])){
                    $table = $_GET['crops'];
                    $stmt = $pdo->prepare('SELECT modified_by, modified_at, modified_times FROM crops WHERE id = :id');
                }

                if(isset($_GET['livestocks']) && is_string($_GET['livestocks'])){
                    $table = $_GET['livestocks'];
                    $stmt = $pdo->prepare('SELECT modified_by, modified_at, modified_times FROM livestocks WHERE id = :id');
                }

                if(isset($_GET['programs']) && is_string($_GET['programs'])){
                    $table = $_GET['programs'];
                    $stmt = $pdo->prepare('SELECT modified_by, modified_at, modified_times FROM programs WHERE id = :id');
                }

                if(isset($_GET['resources']) && is_string($_GET['resources'])){
                    $table = $_GET['resources'];
                    $stmt = $pdo->prepare('SELECT modified_by, modified_at, modified_times FROM resources WHERE id = :id');
                }

                $stmt->execute(['id' => $id]);
                $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                if ($logs) {
                    foreach ($logs as $log) {
                        // Format the modified_at if needed (assuming it's a timestamp)
                        $modifiedAtFormatted = date("l, F-d-Y h:i:s A", strtotime($log['modified_at']));
                        
                        echo "
                            <h5 style='text-align: center;'>{$table}</h5>
                            <p><strong>Modified By:</strong> {$log['modified_by']}</p>
                            <p><strong>Modified At:</strong> {$modifiedAtFormatted}</p>
                            <p><strong>Modified Times:</strong> {$log['modified_times']}</p>
                        ";
                    }
                } else {
                    echo 'No activity logs found.';
                }
            } else {
                echo 'Invalid or missing user ID.';
            }                    
                ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Close modal when clicking the "x" button
            const closeBtn = document.querySelector('.close-btn');
            const modal = document.getElementById('activityLogModal');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    modal.style.display = 'none'; // Hide modal on close
                });
            }

            // Close modal when clicking outside of the modal
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    // modal.style.display = 'none';
                    window.history.back();
                }
            });
        });
    </script>

    <!-- ======= Footer ======= -->
    <?php include '../includes/footer.php' ?>

</body>

</html>