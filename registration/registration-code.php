<?php
require '../backend/functions.php';

// Step 2: Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $formData = [
        'fullname' => $_POST['fullname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'create' => 0,
        'edit' => 0,
        'delete' => 0,
        'export' => 0,
        'banned' => 0,
        'promote' => 2,
    ];

    if(emailExists($formData['email'])){
        redirect('register-farmer.php', 500, 'Email already exist');
    }

    if (strlen($formData['password']) < 8) {
        redirect('register-farmer.php', 404, 'Password should be 8 characters or more.');
    }

    if($formData['password'] !== $_POST['retype']){
        redirect('register-farmer.php', 404, 'Password mismatch.');
    }

    // Step 3: Hash the password for security
    $hashedPassword = password_hash($formData['password'], PASSWORD_DEFAULT);

    // Step 4: Insert the data into the database
    $sql = "INSERT INTO users (full_name, email, password, can_create, can_edit, can_archive, can_export, is_banned, role)
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
        redirect('../login', 200, "You're account has been successfully created.");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        redirect('register-farmer.php', 500, 'Something Went Wrong.');
    }

}