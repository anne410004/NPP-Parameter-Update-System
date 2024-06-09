<?php
// Assuming you have a database connection established

// Function to securely hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Sample user data (replace this with your actual user data stored in a database)
$users = [
    'user@example.com' => hashPassword('password1'),
    'anotheruser@example.com' => hashPassword('password2')
];

// Function to verify password
function verifyPassword($email, $password) {
    global $users;
    if (isset($users[$email])) {
        return password_verify($password, $users[$email]);
    }
    return false;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verify password
    if (verifyPassword($email, $password)) {
        // Password is correct, redirect to dashboard or another page
        header('Location: /dashboard');
        exit;
    } else {
        // Password is incorrect, display error message
        $errorMessage = 'Invalid email or password';
    }
}
?>