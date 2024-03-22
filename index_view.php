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
    <div class="hero">
        <div class="content">
            <h1>Discover Your Cooking Game</h1>
            <h3>Elevate Your Cooking Game</h3>


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
                    of discovery. Let Chef Club be your trusted companion as you create memorable
                    meals and culinary masterpieces in the comfort of your own home.</p>

            </div>
        </div>
    </section>


    <!-----Recipes Section Start---------------------------------->
    <div class="recipe">
        <h2>Featured Recipes</h2>
        <div class="box">
            <div class="card">
                <img src="r1.jfif" alt="">
                <div class="content">
                    <h3>Recipe 1</h3>
                    <P>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</P>
                    <button>View Recipe</button>
                </div>
            </div>
            <div class="card">
                <img src="r2.jfif" alt="">
                <div class="content">
                    <h3>Recipe 2</h3>
                    <P>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</P>
                    <button>View Recipe</button>
                </div>
            </div>
            <div class="card">
                <img src="r3.jfif" alt="">
                <div class="content">
                    <h3>Recipe 3</h3>
                    <P>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</P>
                    <button>View Recipe</button>
                </div>
            </div>
            <div class="card">
                <img src="r4.jfif" alt="">
                <div class="content">
                    <h3>Recipe 4</h3>
                    <P>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</P>
                    <button>View Recipe</button>
                </div>
            </div>
            <div class="card">
                <img src="r5.jfif" alt="">
                <div class="content">
                    <h3>Recipe 5</h3>
                    <P>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</P>
                    <button>View Recipe</button>
                </div>
            </div>
            <div class="card">
                <img src="r6.png" alt="">
                <div class="content">
                    <h3>Recipe 6</h3>
                    <P>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</P>
                    <button>View Recipe</button>
                </div>
            </div>
            <div class="card">
                <img src="r7.jfif" alt="">
                <div class="content">
                    <h3>Recipe 7</h3>
                    <P>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</P>
                    <button>View Recipe</button>
                </div>
            </div>
            <div class="card">
                <img src="r8.jfif" alt="">
                <div class="content">
                    <h3>Recipe 8</h3>
                    <P>Lorem ipsum dolor sit amet,consectetur adipiscing elit.</P>
                    <button>View Recipe</button>
                </div>
            </div>
        </div>
    </div>
    <!--------------submit recipes section-------------------------------->
    <div class="main-container">

        <div class="recipe-submission-container">
            <h2>Submit Your Recipe</h2>
            <form id="recipeForm" action="YOUR_SERVER_ENDPOINT" method="POST">
                <div class="form-group">
                    <label for="recipeName">Recipe Name:</label>
                    <input type="text" id="recipeName" name="recipeName" required>
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
                <div class="form-group">
                    <label for="recipe">Recipe:</label>
                    <textarea id="recipe" name="recipe" rows="6" required></textarea>
                </div>
                <button type="submit">Post Recipe</button>
            </form>
        </div>
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