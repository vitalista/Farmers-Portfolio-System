<?php
require '../backend/database.php';

// Step 2: Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Collect form data
    $formData = [
        'id' => $_POST['id'], // Add an ID field to identify the user to update
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

    // Step 3: Hash the password for security, only if it's updated
    $hashedPassword = !empty($formData['password']) ? password_hash($formData['password'], PASSWORD_DEFAULT) : null;

    // Step 4: Build the SQL query for updating the user
    $sql = "UPDATE users SET 
                full_name = '{$formData['fullname']}',
                email = '{$formData['email']}',
                can_create = {$formData['create']},
                can_edit = {$formData['edit']},
                can_delete = {$formData['delete']},
                can_export = {$formData['export']},
                is_banned = {$formData['banned']},
                role = {$formData['promote']}";

    // Include password update only if it's not empty (i.e., user changed their password)
    if ($hashedPassword) {
        $sql .= ", password = '{$hashedPassword}'";
    }

    $sql .= " WHERE id = {$formData['id']}"; // Ensure you update the user based on their unique ID

    // Step 5: Execute the update query
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Step 6: Dynamically echo the POST data using a loop
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
