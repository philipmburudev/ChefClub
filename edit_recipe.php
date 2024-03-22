<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'connection.php';
include 'auth_session.php';


$userId = $_SESSION['id']; 

if (!isset($_GET['id'])) {
    echo "Recipe ID is not provided.";
    exit;
}
$recipeId = $_GET['id'];


$query = $conn->prepare("SELECT * FROM recipe WHERE id = ? AND user_id = ?");
if (!$query) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    exit;
}
$query->bind_param("ii", $recipeId, $userId);
$query->execute();

$result = $query->get_result();

// Check if the recipe exists
if ($result->num_rows === 0) {
    echo "Recipe not found or you do not have permission to edit it.";
    exit;
}

$recipe = $result->fetch_assoc();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $process = $_POST['process'];

 // Update the recipe
$update = $conn->prepare("UPDATE recipe SET title = ?, ingredients = ?, process = ? WHERE id = ? AND user_id = ?");
if (!$update) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    exit;
}
$update->bind_param("sssii", $title, $ingredients, $process, $recipeId, $userId);
$update->execute();





    if ($update->affected_rows > 0) {
        echo "Recipe updated successfully.";
    } else {
        echo "An error occurred or no changes were made.";
    }
    $update->close();
    // Redirect after update 
    header('Location: profile_view.php'); 
    exit;
}

$query->close();
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit_recipe.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,400;1,200;1,300;1,600&display=swap" rel="stylesheet">
    <title>Edit Recipe</title>


 
</head>  
 
<body>
    <h2>Edit Recipe</h2>
    <form action="" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>

        <label for="ingredients">Ingredients</label>
        <textarea name="ingredients" id="ingredients" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>

        <label for="process">Process</label>
        <textarea name="process" id="process" required><?php echo htmlspecialchars($recipe['process']); ?></textarea>

        <button type="submit">Update Recipe</button>
    </form>
</body>

</html>