<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chores Management</title>
    <!-- Linking the CSS file to the HTML file -->
    <link rel="stylesheet" href="SignIn.css">
</head>

<body>
    <div class="container">
        <form action="signin.php" method="post">
            <h1></h1>
            <div class="Email">
                <label for="email">Email</label>
                <input type="email" placeholder="Email Address" id="email" name="email">
            </div>
            <div class="password">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password">
            </div>
            <div class="login">
                <button type="submit">Log In</button>
            </div>

            <div class="forgot-password">
                <a href="forgot-password.html">Forgot Password?</a>
            </div>

            <div class="login">
                <p>Don't have an account? <a href="signup_view.php">Sign up</a></p>
            </div>

            <!-- <div class="sign-up">
                <button type="button" onclick="redirectToSignup()">Sign Up</button>
                <script>
                    function redirectToSignup() {
                        window.location.href = "index.php";
                    }
                </script>
            </div> -->
        </form>
    </div>


</body>

</html>