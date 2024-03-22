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