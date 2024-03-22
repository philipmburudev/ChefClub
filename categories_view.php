<?php

include 'auth_session.php';
session_start();
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['logged_in'] = true;


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,400;1,200;1,300;1,600&display=swap" rel="stylesheet">
    <title>Categories | Chef Club Recipes</title>
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

    <div class="categories">
        <h2>Categories</h2>
        <div class="box">
            <div class="ca-card">
                <a href="recipes_view.php?category=breakfast">
                    <img src="breakfast.jfif" alt="Breakfast" class="category-image">
                    <div class="content">
                        <h3>Breakfast</h3>
                        <p>Start your day with energy.</p>
                        <a href="recipes_view.php?category=breakfast" class="button-link">Click to see Breakfast Recipes</a>
                    </div>
                </a>
            </div>
            <div class="ca-card">
                <a href="recipes_view.php?category=lunch">
                    <img src="lunch.jfif" alt="Lunch" class="category-image">
                    <div class="content">
                        <h3>Lunch</h3>
                        <p>Midday meals to keep you going.</p>
                        <a href="recipes_view.php?category=lunch" class="button-link">Click to see Lunch Recipes</a>
                    </div>
                </a>
            </div>
            <div class="ca-card">
                <a href="recipes_view.php?category=dinner">
                    <img src="dinner.jfif" alt="Dinner" class="category-image">
                    <div class="content">
                        <h3>Dinner</h3>
                        <p>End your day with a delicious dinner.</p>
                        <a href="recipes_view.php?category=dinner" class="button-link">Click to see Dinner Recipes</a>
                    </div>
                </a>
            </div>
            <div class="ca-card">
                <a href="recipes_view.php?category=desserts">
                    <img src="desserts.jfif" alt="Desserts" class="category-image">
                    <div class="content">
                        <h3>Desserts</h3>
                        <p>Sweet treats for any occasion.</p>
                        <a href="recipes_view.php?category=desserts" class="button-link">Click to see Desserts Recipes</a>
                    </div>
                </a>
            </div>
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
</body>

</html>