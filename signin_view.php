<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include 'connection.php';

$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($email) && !empty($password)) {
        $query = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        if ($query) {
            $query->bind_param("s", $email);
            if ($query->execute()) {
                $result = $query->get_result();
                if ($row = $result->fetch_assoc()) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['id'] = $row['id'];
                        header("Location: index_view.php");
                        exit;
                    } else {
                        $errorMsg = "Incorrect password.";
                    }
                } else {
                    $errorMsg = "Email not found.";
                }
            } else {
                $errorMsg = 'Execution failed: ' . htmlspecialchars($conn->error);
            }
            $query->close();
        } else {
            $errorMsg = 'Query preparation failed: ' . htmlspecialchars($conn->error);
        }
    } else {
        $errorMsg = "Please fill in all fields.";
    }
}
$conn->close();
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chores Management</title>
    <link rel="stylesheet" href="SignIn.css">
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <h1>Log In</h1>
            <!-- Display Error Messages -->
            <?php if (!empty($errorMsg)) : ?>
                <p class="error"><?php echo $errorMsg; ?></p>
            <?php endif; ?>
            <div class="Email">
                <label for="email">Email</label>
                <input type="email" placeholder="Email Address" id="email" name="email" required>
            </div>
            <div class="password">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password" required>
            </div>
            <div class="login">
                <button type="submit" class="button">Log In</button>
            </div>
            <div class="login">
                <p>Don't have an account? <a href="signup_view.php">Sign up</a></p>
            </div>
        </form>
    </div>
</body>

</html>