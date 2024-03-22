<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];

    // Hash  password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insertQuery = $conn->prepare("INSERT INTO users (username, firstName, lastName, password, email, dob, gender, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $insertQuery->bind_param("ssssssss", $username, $firstName, $lastName, $hashedPassword, $email, $dob, $gender, $contact);
    if ($insertQuery->execute()) {
        echo "Signup successful. You can now <a href='signin_view.php'>login</a>.";
    } else {
        // If insertion fails, display an error message.
        echo "Signup failed. Error: " . $insertQuery->error;
    }
    $insertQuery->close(); // Close the prepared statement
    $conn->close(); // Close the database connection
} // } else {
//     // Redirect to the signup page if the form is not submitted via POST
//     header("Location: signup_view.php");
//     exit;
// }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="Signup.css">
</head>

<body>
    <div class="container">
        <form method="post" onsubmit="return validateForm()">
            <h1>Sign Up</h1>

            <div class="form-group">
                <label for="username">Username:</label>

                <input type="text" id="username" name="username" required>
            </div>

            <!-- First Name field -->
            <div class="form-group">
                <label for="firstName">First Name:</label>

                <input type="text" id="firstName" name="firstName" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>

                <input type="text" id="lastName" name="lastName" required>
            </div>



            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob">
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>

                <input type="email" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>

                <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>

                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact Number:</label>

                <input type="text" id="contact" name="contact" required>
            </div>

            <button type="submit">Sign Up</button>

            <p>Already have an account? <a href="signin_view.php">Login</a></p>
        </form>
    </div>

</body>

<script>
    function validateForm() {
        var username = document.getElementById('username').value;
        var firstName = document.getElementById('firstName').value;
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

        if (username.trim() === "") {
            alert("Username is required.");
            return false;
        }

        if (firstName.trim() === "") {
            alert("Please enter your first name.");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }


        return true; // To allow form submission
    }
</script>

</html>