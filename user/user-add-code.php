<?php
require '../backend/database.php';

// Step 2: Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $formData = [
        'fullname' => $_POST['fullname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'create' => isset($_POST['create']) ? 1 : 0,
        'edit' => isset($_POST['edit']) ? 1 : 0,
        'delete' => isset($_POST['delete']) ? 1 : 0,
        'export' => isset($_POST['export']) ? 1 : 0,
        'banned' => isset($_POST['bannedSwitch']) ? 1 : 0,
        'promote' => isset($_POST['promoteSwitch']) ? 1 : 0,
    ];

    $sample = [
        'aries' => '1',
        'vitalista' => '2',
        'gonzales' => '3',
    ];

    // Step 3: Hash the password for security
    $hashedPassword = password_hash($formData['password'], PASSWORD_DEFAULT);

    // Step 4: Insert the data into the database
    $sql = "INSERT INTO users (full_name, email, password, can_create, can_edit, can_delete, can_export, is_banned, role)
            VALUES 
            ('{$formData['fullname']}', 
            '{$formData['email']}', 
            '$hashedPassword', 
            {$formData['create']}, 
            {$formData['edit']}, 
            {$formData['delete']}, 
            {$formData['export']}, 
            {$formData['banned']}, 
            {$formData['promote']})";

    if ($conn->query($sql) === TRUE) {
        echo "New user added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Step 5: Dynamically echo the POST data using a loop
    echo "<h3>Form Data Submitted:</h3>";
    foreach ($formData as $key => $value) {
        if ($key == 'password') {
            // We don't want to show the password for security reasons
            echo ucfirst($key) . ": [hidden]<br>";
        } else {
            echo ucfirst($key) . ": " . ($value ? 'Yes' : 'No') . "<br>";
        }
    }

}

// Step 6: Close the database connection
$conn->close();
?>
