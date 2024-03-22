<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';
include 'auth_session.php';

$highlightedId = isset($_GET['highlight']) ? intval($_GET['highlight']) : null;
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

$baseImageUrl = '';

// SQL statement depending on whether a category is selected
if ($selectedCategory) {
    $sql = "SELECT recipe.*, media.fileName AS imagePath, CONCAT(users.firstName, ' ', users.lastName) AS authorName
            FROM recipe
            LEFT JOIN media ON recipe.media_id = media.id
            LEFT JOIN users ON recipe.user_id = users.id
            WHERE recipe.category = ?
            ORDER BY recipe.id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedCategory);
} else {
    $sql = "SELECT recipe.*, media.fileName AS imagePath, CONCAT(users.firstName, ' ', users.lastName) AS authorName
            FROM recipe
            LEFT JOIN media ON recipe.media_id = media.id
            LEFT JOIN users ON recipe.user_id = users.id
            ORDER BY recipe.id DESC";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

$recipesHtml = '';
if ($result->num_rows > 0) {
    $recipesHtml .= "<div class='recipe-grid'>";
    while ($row = $result->fetch_assoc()) {
        $highlightClass = ($row['id'] == $highlightedId) ? 'highlighted-recipe' : '';
        $recipesHtml .= "<div class='recipe-card {$highlightClass}' id='recipe-{$row['id']}' data-category='" . htmlspecialchars($row['category']) . "'>";
        
        if (!empty($row['imagePath'])) {
            $imagePath = htmlspecialchars($baseImageUrl . $row['imagePath']);
            $recipesHtml .= "<img class='recipe-image' src='" . $imagePath . "' alt='Recipe Image'>";
        } else {
            $recipesHtml .= "<div class='recipe-image-placeholder'>No Image Available</div>";
        }
        
        $recipesHtml .= "<div class='recipe-info'>";
        $recipesHtml .= "<h3 class='recipe-title'>" . htmlspecialchars($row['title']) . "</h3>";
        $recipesHtml .= "<p class='recipe-category'>Category: " . htmlspecialchars($row['category']) . "</p>";
        $recipesHtml .= "<p class='recipe-ingredients'>Ingredients: " . nl2br(htmlspecialchars($row['ingredients'])) . "</p>";
        $recipesHtml .= "<p class='recipe-process'>Process: " . nl2br(htmlspecialchars($row['process'])) . "</p>";
        $recipesHtml .= "<p class='recipe-author'>Author: " . htmlspecialchars($row['authorName']) . "</p>"; 
        $recipesHtml .= "</div></div>";
    }

    $recipesHtml .= "</div>";
} else {
    $recipesHtml = "<p>No recipes found.</p>"; 
}

$stmt->close();
$conn->close();
?>



















<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,400;1,200;1,300;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title> Chef Club Recipes</title>
</head>

<body>
    <header>


        <div class="logo">Chef Club</div>
        <div class="nav-bar">
            <ul>
                <li><a href="index_view.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="recipes_view.php">Recipes</a></li>
                <li><a href="categories_view.php">Categories</a></li>
                <li><a href="profile_view.php">Profile Page</a></li>
            </ul>
        </div>
    </header>

    <div class="main-container">
        <h2>Recipes</h2>
        <div class="recipes-display">
            <?php echo $recipesHtml; ?>
        </div>
    </div>
    <div class="main-container2">
        <div class="recipe-submission-container">
            <h2>Submit Your Recipe</h2>
            <form id="recipeForm" action="submit_recipe.php" method="POST" enctype="multipart/form-data">
                <!-- Title of the recipe -->
                <div class="form-group">
                    <label for="title">Recipe Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                        <option value="desserts">Desserts</option>
                    </select>
                </div>

                <!-- Ingredients -->
                <div class="form-group">
                    <label for="ingredients">Ingredients:</label>
                    <textarea id="ingredients" name="ingredients" rows="4" required></textarea>
                </div>

                <!-- Process -->
                 <div class="form-group">
                    <label for="process">Process:</label>
                    <textarea id="process" name="process" rows="6" required></textarea>
                </div>

                <!-- Author -->
       <div class="form-group" style="display:none;"> 
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" value="Anon" required> <!-- Assuming Anon as a default value -->
                </div>

                <!-- Image upload for the recipe -->
                <div class="form-group" action="submit_recipe.php" method="POST" enctype="multipart/form-data">
                    <label for="image">Recipe Image:</label>
                    <input type="file" id="image" name="image">
                </div> 

                <!-- Submit button -->
                <button type="submit">Post Recipe</button>
            </form>
        </div>
    </div>
  <footer>
            <div class="social-icons">
                <a href="#" class="social-icon"> <i class="fab fa-facebook"></i> </a>
                <a href="#" class="social-icon"> <i class="fab fa-twitter"></i> </a>
                <a href="#" class="social-icon"> <i class="fab fa-instagram"></i> </a>
            </div>
            <h5>CopyRight © 2024. All right reserved </h5>
        </footer>





     <script>
  window.onload = function() {
                var highlightedId = '<?php echo $highlightedId; ?>';
                if (highlightedId) {
                    var element = document.getElementById('recipe-' + highlightedId);
                    if (element) {
                        element.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        element.classList.add('highlight');
                    }
                }
            
};


        </script> 


</body>



</html>