<?php
include 'connection.php';
include 'auth_session.php';


$userId = $_SESSION['id'];

$userQuery = $conn->prepare("SELECT firstName, lastName, email, dob, gender, contact FROM users WHERE id = ?");
if (!$userQuery) {
    die("Prepare failed: " . $conn->error);
}
$userQuery->bind_param("i", $userId);
$userQuery->execute();
$userResult = $userQuery->get_result()->fetch_assoc();

$userQuery->close();

$recipesQuery = $conn->prepare("SELECT id, title, ingredients, process FROM recipe WHERE user_id = ?");
if (!$recipesQuery) {
    die("Prepare failed: " . $conn->error);
}
$recipesQuery->bind_param("i", $userId);
$recipesQuery->execute();
$recipesResult = $recipesQuery->get_result();

$recipesQuery->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,400;1,200;1,300;1,600&display=swap" rel="stylesheet">
    <title>Chef Club Recipes</title>
</head>

<body>

    <a href="index_view.php" class="button-homepage">Home</a>

    <div class="user-info">
        <h2><?php echo htmlspecialchars($userResult['firstName'] . ' ' . $userResult['lastName']); ?>'s Profile</h2>
        <p>Email: <?php echo htmlspecialchars($userResult['email']); ?></p>
        <p>Date of Birth (DOB): <?php echo htmlspecialchars($userResult['dob']); ?></p>
        <p>Gender: <?php echo htmlspecialchars($userResult['gender']); ?></p>
        <p>Contact: <?php echo htmlspecialchars($userResult['contact']); ?></p>

        <!-- Form to update user information -->
        <form action="update_profile.php" method="post">


            <label for="newContact">New Contact:</label>
            <input type="text" id="newContact" name="newContact" placeholder="Enter new contact number">

            <label for="newGender">New Gender:</label>
            <select id="newGender" name="newGender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <div class="recipes">
        <h3>Your Recipes</h3>
        <?php if ($recipesResult->num_rows > 0) : ?>
            <div class="recipe-grid">
                <?php while ($row = $recipesResult->fetch_assoc()) : ?>
                    <div class="recipe-card">
                        <div class="recipe-info">
                            <h4 class="recipe-title"><?php echo htmlspecialchars($row['title']); ?></h4>

                            <p><?php echo "Ingredients: " . htmlspecialchars($row['ingredients']); ?></p>
                            <p><?php echo "Process: " . htmlspecialchars($row['process']); ?></p>
                            <!-- Edit and Delete Links -->
                            <a href="edit_recipe.php?id=<?php echo $row['id']; ?>" class="button-edit">Edit</a>
                            <a href="delete_recipe.php?id=<?php echo $row['id']; ?>" class="button-delete" onclick="return confirm('Are you sure?');">Delete</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>You have not posted any recipes yet.</p>
        <?php endif; ?>
    </div>





    <!-- Logout Button -->
    <div class="form-container2">
        <form action="signin_view.php" class="button-login" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>



    </div>

</body>

</html>
