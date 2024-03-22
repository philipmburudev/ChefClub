<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($firstName) || empty($lastName) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        exit('Invalid input');
    }

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        exit('User already exists');
    }
    $stmt->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, firstName, lastName, password, access, email) VALUES (?, ?, ?, ?, 'REGULAR', ?)");
    $username = strtolower($firstName . $lastName);
    $stmt->bind_param("sssss", $username, $firstName, $lastName, $hashedPassword, $email);
    if ($stmt->execute()) {
        header("Location: signin_view.php"); // Redirect on success
    } else {
        // Handle insertion error
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
