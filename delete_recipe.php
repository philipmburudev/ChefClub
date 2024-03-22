<?php
include 'connection.php';
include 'auth_session.php';

if (!isset($_GET['id'])) {
    echo "Recipe ID is not provided.";
    exit;
}

$recipeId = $_GET['id'];
$userId = $_SESSION['id']; 

$query = $conn->prepare("SELECT id FROM recipe WHERE id = ? AND user_id = ?");
if (!$query) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    exit;
}
$query->bind_param("ii", $recipeId, $userId);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "Recipe not found or you do not have permission to delete it.";
    exit;
}

$delete = $conn->prepare("DELETE FROM recipe WHERE id = ? AND user_id = ?");
if (!$delete) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    exit;
}
$delete->bind_param("ii", $recipeId, $userId);
$delete->execute();

if ($delete->affected_rows > 0) {
    echo "Recipe deleted successfully."; 
    header('Location: profile_view.php');
    exit;
} else {
    echo "An error occurred or no changes were made.";
}
$delete->close();


?>
