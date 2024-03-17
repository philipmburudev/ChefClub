<?php
include 'connection.php';
$highlightedId = isset($_GET['highlight']) ? intval($_GET['highlight']) : null;

// Fetch all recipes
$sql = "SELECT * FROM recipe ORDER BY id DESC";
$result = $conn->query($sql);

$recipesHtml = '';
if ($result->num_rows > 0) {
    $recipesHtml .= "<div class='recipe-grid'>";
    while ($row = $result->fetch_assoc()) {
        $highlightClass = ($row['id'] == $highlightedId) ? 'highlighted-recipe' : '';
        $recipesHtml .= "<div class='recipe-card {$highlightClass}' id='recipe-{$row['id']}'>";
        if (!empty($row['image'])) {
            $recipesHtml .= "<img class='recipe-image' src='uploads/" . htmlspecialchars($row['image']) . "' alt='Recipe Image'>";
        } else {
            $recipesHtml .= "<div class='recipe-image-placeholder'>No Image Available</div>";
        }
        $recipesHtml .= "<div class='recipe-info'>";
        $recipesHtml .= "<h3 class='recipe-title'>" . htmlspecialchars($row['title']) . "</h3>";
        $recipesHtml .= "<p class='recipe-category'>Category: " . htmlspecialchars($row['category']) . "</p>";
        $recipesHtml .= "</div>";
        $recipesHtml .= "</div>";
    }
    $recipesHtml .= "</div>";
} else {
    $recipesHtml = "<p>No recipes found.</p>";
}
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
                <li><a href="about.html">About</a></li>
                <li><a href="recipes_view.php">Recipes</a></li>
                <li><a href="categories_view.php">Categories</a></li>
                <li><a href="signin_view.php">Login</a></li>
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

                <!-- Ingredients  -->
                <div class="form-group">
                    <label for="ingredients">Ingredients:</label>
                    <textarea id="ingredients" name="ingredients" rows="4" required></textarea>
                </div>

                <!-- Process  -->
                <div class="form-group">
                    <label for="process">Process:</label>
                    <textarea id="process" name="process" rows="6" required></textarea>
                </div>



                <!-- @mohammed , @tinotenda , modify this to include the logic when a user has already logged in -->
                <div class="form-group" style="display:none;"> <!-- Hide this if you're setting the author automatically -->
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" value="Anon" required> <!-- Assuming Anon as a default value -->
                </div>

                <!-- Image upload for the recipe 
                <div class="form-group">
                    <label for="image">Recipe Image:</label>
                    <input type="file" id="image" name="image" required>
                </div>-->

                <button type="submit">Post Recipe</button>
            </form>
        </div>







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