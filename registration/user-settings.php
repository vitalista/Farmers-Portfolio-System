<?php
require '../backend/functions.php';

// if($_SESSION['LoggedInUser']['role'] != 1){
//   header('Location: ../logout.php');
//   exit;
// }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['settings'])) {
    // Collect form data
    $formData = [
        'id' => $_POST['id'], // Add an ID field to identify the user to update
        'fullname' => $_POST['fullname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];

    if (!empty($formData['password']) && strlen($formData['password']) < 8) {
        redirect('user-settings.php', 404, 'Password should be 8 characters or more');
    }

    if($formData['password'] !== $_POST['retype']){
        redirect('user-settings.php', 404, 'Password mismatch.');
    }

    // Step 3: Hash the password for security, only if it's updated
    $hashedPassword = !empty($formData['password']) ? password_hash($formData['password'], PASSWORD_DEFAULT) : null;

    // Step 4: Build the SQL query for updating the user
    $sql = "UPDATE users SET 
                full_name = '{$formData['fullname']}',
                email = '{$formData['email']}'";

    // Include password update only if it's not empty (i.e., user changed their password)
    if ($hashedPassword) {
        $sql .= ", password = '{$hashedPassword}'";
    }

    $sql .= " WHERE id = {$formData['id']}"; // Ensure you update the user based on their unique ID

    // Step 5: Execute the update query
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
        redirect('../registration/index.php', 200, 'User updated successfully');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        redirect('user-settings.php', 500, 'Something Went Wrong');
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
