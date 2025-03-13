<?php
session_start();
include 'auth-check.php';
// MySQL connection settings
// require 'functions.php';
require 'database.php';
// include 'auth-check.php';
if($_SESSION['LoggedInUser']['role'] != 1 || $_SESSION['LoggedInUser']['id'] != 3){
  header('Location: ../logout.php');
}

if (isset($_POST['submit'])) {
    $table = $_POST['table'];
    // Handle the file upload
    if ($_FILES['csv_file']['error'] == 0) {
        $csvFile = $_FILES['csv_file']['tmp_name'];

        // Open the CSV file
        if (($handle = fopen($csvFile, 'r')) !== false) {
            // Read the first row (header row) for column names
            $columns = fgetcsv($handle);
            // print_r($columns);
            // Build the SQL INSERT statement dynamically based on the columns
            $columnsString = implode(", ", $columns);
            $placeholders = implode(", ", array_fill(0, count($columns), "?"));

            // Prepare SQL insert statement
            $stmt = $conn->prepare("INSERT INTO $table ($columnsString) VALUES ($placeholders)");

            // Dynamically bind the parameters based on the number of columns
            $types = str_repeat("s", count($columns)); // Assuming all columns are of type 'string' (you can adjust this if needed)
            $stmt->bind_param($types, ...array_fill(0, count($columns), null)); // Bind the parameters dynamically

            // Read each line of the CSV (data rows)
            while (($data = fgetcsv($handle)) !== false) {
                // Bind the actual data values to the prepared statement
                $stmt->bind_param($types, ...$data);
                // print_r($handle);
                // Execute the insert statement
                $stmt->execute();
                // addFpsCode($table, $stmt->insert_id, $data[8]);
            }
            
            // Close the file and statement
            fclose($handle);
            $stmt->close();

            echo "Data imported successfully!";
        } else {
            echo "Could not open the file.";
        }
    } else {
        echo "Error uploading file.";
    }
}

// Handle truncate single table button
if (isset($_POST['truncate'])) {
    $table = $_POST['truncate_table'];

    // Sanitize table name (basic approach)
    $table = preg_replace("/[^a-zA-Z0-9_]/", "", $table); // Allow only alphanumeric and underscores

    // Check if the table name is valid before truncating
    $validTables = ['crops', 'parcels', 'livestocks', 'farmers', 'programs', 'resources', 'distributions', 'images'];
    if (in_array($table, $validTables)) {
        // Truncate the table securely
        $stmt = $conn->prepare("TRUNCATE TABLE `$table`");
        if ($stmt->execute()) {
            echo "Table '$table' truncated successfully!";
        } else {
            echo "Error truncating table '$table'.";
        }
        $stmt->close();
    } else {
        echo "Invalid table name.";
    }
}

// Handle truncate all tables button
if (isset($_POST['truncate_all'])) {
    // List of tables to truncate
    $validTables = ['crops', 'parcels', 'livestocks', 'farmers', 'programs', 'resources', 'distributions', 'images'];

    foreach ($validTables as $table) {
        // Truncate each valid table
        $stmt = $conn->prepare("TRUNCATE TABLE `$table`");
        if (!$stmt->execute()) {
            echo "Error truncating table '$table'.<br>";
        } else {
            echo "Table '$table' truncated successfully!<br>";
        }
        $stmt->close();
    }
}

// Close the MySQL connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV to MySQL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input[type="file"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        .truncate-all-button {
            background-color: #f44336;
        }
        .truncate-all-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<div class="container">
        <a class="btn btn-danger" href="../dashboard/dashboard.php">Back</a>
    <h2>Upload CSV File to MySQL</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="csv_file">Choose CSV file</label><br>   
        <select name="table">
            <option value="crops">Crops</option>
            <option value="parcels">Parcels</option>
            <option value="livestocks">Livestocks</option>
            <option value="farmers">Farmers</option>
        </select>
        <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
        <input type="submit" name="submit" value="Upload and Import">
    </form>
</div>

<div class="container">
    <h2>Truncate Table</h2>
    <form action="" method="POST">
        <label for="truncate_table">Enter Table Name to Truncate (e.g. crops, parcels, etc.):</label><br>
        <input type="text" name="truncate_table" required>
        <input type="submit" name="truncate" value="Truncate Table">
    </form>
</div>

<div class="container">
    <h2>Truncate All Tables</h2>
    <form action="" method="POST">
        <input type="submit" name="truncate_all" value="Truncate All Tables" class="truncate-all-button">
    </form>
</div>

</body>
</html>
