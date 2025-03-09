<?php require 'database.php';?>

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
            <div class="d-flex p-2 mb-4" style="border-bottom: 1px solid #dee2e6;">
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

                    // Initialize the table variable
                    $table = "";

                    // Check which table is being requested
                    if (isset($_GET['farmers']) && is_string($_GET['farmers'])) {
                        $table = $_GET['farmers'];
                        $query = 'SELECT archived_by, archived_at, modified_times FROM farmers WHERE id = ?';
                    } elseif (isset($_GET['parcels']) && is_string($_GET['parcels'])) {
                        $table = $_GET['parcels'];
                        $query = 'SELECT archived_by, archived_at, modified_times FROM parcels WHERE id = ?';
                    } elseif (isset($_GET['crops']) && is_string($_GET['crops'])) {
                        $table = $_GET['crops'];
                        $query = 'SELECT archived_by, archived_at, modified_times FROM crops WHERE id = ?';
                    } elseif (isset($_GET['livestocks']) && is_string($_GET['livestocks'])) {
                        $table = $_GET['livestocks'];
                        $query = 'SELECT archived_by, archived_at, modified_times FROM livestocks WHERE id = ?';
                    } elseif (isset($_GET['programs']) && is_string($_GET['programs'])) {
                        $table = $_GET['programs'];
                        $query = 'SELECT archived_by, archived_at, modified_times FROM programs WHERE id = ?';
                    } elseif (isset($_GET['resources']) && is_string($_GET['resources'])) {
                        $table = $_GET['resources'];
                        $query = 'SELECT archived_by, archived_at, modified_times FROM resources WHERE id = ?';
                    } elseif (isset($_GET['distributions']) && is_string($_GET['distributions'])) {
                        $table = $_GET['distributions'];
                        $query = 'SELECT archived_by, archived_at, modified_times FROM distributions WHERE id = ?';
                    }

                    if ($table !== "") {
                        // Prepare the SQL statement
                        if ($stmt = $conn->prepare($query)) {
                            // Bind the ID parameter to the prepared statement
                            $stmt->bind_param('i', $id);

                            // Execute the statement
                            $stmt->execute();

                            // Get the result
                            $result = $stmt->get_result();

                            // Fetch all logs
                            $logs = $result->fetch_all(MYSQLI_ASSOC);

                            if ($logs) {
                                foreach ($logs as $log) {
                                    // Format the archived_at if needed (assuming it's a timestamp)
                                    $modifiedAtFormatted = date("l, F-d-Y h:i:s A", strtotime($log['archived_at']));

                                    $fullName = '';
                                    $user = getById('users', $log['archived_by']);
                                    
                                    if ($user && $user['status'] == 200) {
                                        $fullName = isset($user['data']['full_name']) ? $user['data']['full_name'] : 'Unknown';
                                    } else {
                                        $fullName = 'Unknown';
                                    }
                                    $modifiedAtFormatted = isset($modifiedAtFormatted) ? $modifiedAtFormatted : 'N/A';
                                    
                                    // Echo the HTML
                                    echo "
                                        <h5 style='text-align: center;'>{$table}</h5>
                                        <p><strong>Archived By:</strong> {$fullName}</p>
                                        <p><strong>Archived At:</strong> {$modifiedAtFormatted}</p>
                                        <p><strong>Modified Times:</strong> {$log['modified_times']}</p>
                                    ";
                                }
                            } else {
                                echo 'No activity logs found.';
                            }

                            // Close the prepared statement
                            $stmt->close();
                        } else {
                            echo 'Error preparing query.';
                        }
                    } else {
                        echo 'Invalid table name.';
                    }
                } else {
                    echo 'Invalid or missing ID.';
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
                    window.history.back();
                }
            });
        });
    </script>

    <!-- ======= Footer ======= -->
    <?php include '../includes/footer.php' ?>

</body>

</html>
