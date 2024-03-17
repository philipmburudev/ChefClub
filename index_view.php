<?php include 'connection.php';
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
    <div class="hero">
        <div class="content">
            <h1>Discover Your Cooking Game</h1>
            <h3>Elevate Your Cooking Game</h3>
            <div class="button">Start Cooking</div>


        </div>
    </div>


    <!----About Section Start---------------------------------->
    <section class="about">
        <h2>About Us</h2>
        <div class="main">
            <img src="20 Indian Thali Ideas.jfif" alt="">
            <div class="about-text">
                <p>
                    Welcome to Chief Chef, where culinary enthusiasts of all levels come together
                    to explore a world of flavor and creativity. Dive into our curated collection of
                    recipes spanning various cuisines, each accompanied by clear instructions and
                    helpful tips to ensure success in the kitchen. From classic comfort foods to
                    exotic delights, we're here to empower you to unleash your inner chef. Join
                    our vibrant community, swap cooking secrets, and embark on a delicious journey
                    of discovery. Let Chief Chef be your trusted companion as you create memorable
                    meals and culinary masterpieces in the comfort of your own home.</p>

            </div>
        </div>
    </section>


    <!-----Recipes Section Start---------------------------------->
    <div class="recipe">
        <h2>Featured Recipes</h2>
        <div class="box">
            <?php
            // This is to fetch random recipes
            $sql = "SELECT * FROM recipe ORDER BY RAND() LIMIT 8";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card" onclick="window.location.href=\'recipes_view.php?highlight=' . $row["id"] . '\';">';
                    echo '<img src="' . $row["image"] . '" alt="">';
                    echo '<div class="content">';
                    echo '<h3>' . $row["title"] . '</h3>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo "No recipes found.";
            }
            ?>
        </div>

    </div>

    <!--------------submit recipes section-------------------------------->

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




        <!------------contact section-------------------------->
        <section class="contact">
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p><strong>Address:</strong> PMB CT3 Cantonments</p>
                <p><strong>Phone:</strong>+233549034289</p>
                <p><strong>Email:</strong>hello@chiefchef.com</p>
            </div>
            <div class="contact-form">
                <h2>Contact Form</h2>
                <form>
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </section>
        <footer>
            <div class="social-icons">
                <a href="#" class="social-icon"> <i class="fab fa-facebook"></i> </a>
                <a href="#" class="social-icon"> <i class="fab fa-twitter"></i> </a>
                <a href="#" class="social-icon"> <i class="fab fa-instagram"></i> </a>
            </div>
            <h5>CopyRight © 2024. All right reserved </h5>
        </footer>
</body>


</html>