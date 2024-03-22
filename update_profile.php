<?php
session_start();
include 'connection.php'; 
include 'auth_session.php';


if (!isset($_SESSION['id'])) {
    die('You must be logged in to update your profile.');
}

$userId = $_SESSION['id'];
$newContact = filter_input(INPUT_POST, 'newContact', FILTER_SANITIZE_STRING);
$newGender = filter_input(INPUT_POST, 'newGender', FILTER_SANITIZE_STRING);


$query = $conn->prepare("UPDATE users SET contact = ?, gender = ? WHERE id = ?");
$query->bind_param("ssi", $newContact, $newGender, $userId);

if ($query->execute()) {
    // Success
    $_SESSION['update_success'] = "Profile updated successfully.";
    header("Location: profile_view.php"); // Redirect to profile view
    exit;
} else {
    // Error
    echo "Error updating profile: " . $query->error;
}

$query->close();
$conn->close();
 