<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string(trim($_POST['title']));
    $ingredients = $conn->real_escape_string(trim($_POST['ingredients']));
    $process = $conn->real_escape_string(trim($_POST['process']));
    $category = $conn->real_escape_string(trim($_POST['category']));
    $author = 'Anon';


    //placeholder
    $imagePlaceholder = 'no_image_available.png';

    $sql = "INSERT INTO recipe (title, ingredients, process, category, author, image) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $title, $ingredients, $process, $category, $author, $imagePlaceholder);

        if ($stmt->execute()) {
            echo "New record created successfully.";
            header('Location: index_view.php'); // Redirect after successful insertion
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
} else {
    echo "No data submitted.";
}

$conn->close();
