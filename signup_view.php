<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chores Management</title>
    <!-- Linking the css file to the html file -->
    <link rel="stylesheet" href="Signup.css">
</head>

<body>
    <div class="container">
        <form action="signup.php" method="post" onsubmit="return validateForm()">
            <h1>Chef Club</h1>
            <h3>Sign Up Here</h3>

            <div class="name">
                <label for="firstname"> First Name</label>
                <input type="text" placeholder="First Name" id="firstname" name="firstname">
            </div>

            <div class="name">
                <label for="lastname"> Last Name</label>
                <input type="text" placeholder="Last Name" id="lastname" name="lastname">
            </div>

            <div class="Email">
                <label for="email">Email</label>
                <input type="email" placeholder="Email Address" id="email" name="email">
            </div>

            <div class="password">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password">
            </div>

            <div class="signups">
                <button type="submit">Sign Up</button>
            </div>

            <div class="login">
                <p>Already have an account? <a href="signin_view.php">Login</a></p>
            </div>
        </form>
    </div>

    <script>

    </script>
</body>

</html>