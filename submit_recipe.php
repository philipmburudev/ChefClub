<?php
session_start();
include 'connection.php';
include 'auth_session.php';

function redirectWithError($error)
{
    $_SESSION['error'] = $error;
    header('Location: recipes_view.php?error=' . urlencode($error));
    exit;
}

function insertMedia($fileName, $userId)
{
    global $conn;
    $filePath = "uploads/" . $fileName;
    $sql = "INSERT INTO media (fileName, user_id) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $filePath, $userId);
        if ($stmt->execute()) {
            $mediaId = $conn->insert_id;
            $stmt->close();
            return $mediaId;
        } else {
            error_log("Error inserting media: " . $stmt->error);
            $stmt->close();
            redirectWithError("Error inserting media: " . $conn->error);
        }
    } else {
        error_log("Error preparing media insert statement: " . $conn->error); // Log the error
        redirectWithError("Error preparing media insert statement: " . $conn->error);
    }
    return false;
}




function handleFileUpload($userId)
{
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $originalFileName = basename($_FILES["image"]["name"]);
        $fileName = time() . '_' . $originalFileName;
        $fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

        if (!in_array($fileType, ['jpg', 'jpeg', 'png'])) {
            redirectWithError("Invalid file type. Only JPG, JPEG, and PNG files are allowed.");
        }

        $targetDirectory = __DIR__ . "/uploads/";
        if (!file_exists($targetDirectory)) {
            if (!mkdir($targetDirectory, 0755, true)) {
                redirectWithError("Failed to create the upload directory.");
            }
        }

        $targetFilePath = $targetDirectory . $fileName;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            return insertMedia($fileName, $userId);
        } else {
            redirectWithError("There was an error uploading the file.");
        }
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Handling other file upload errors
        $errors = array(
            UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
            UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
            UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded.',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
            UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.',
        );
        $error_message = isset($errors[$_FILES['image']['error']]) ? $errors[$_FILES['image']['error']] : "Unknown error.";
        redirectWithError($error_message);
    }
    return null;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['id'];
    $title = $conn->real_escape_string(trim($_POST['title']));
    $ingredients = $conn->real_escape_string(trim($_POST['ingredients']));
    $process = $conn->real_escape_string(trim($_POST['process']));
    $category = $conn->real_escape_string(trim($_POST['category']));
    $author = $conn->real_escape_string(trim($_POST['author']));
    $mediaId = handleFileUpload($userId);

    $sql = "INSERT INTO recipe (title, ingredients, process, category, author, media_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssii", $title, $ingredients, $process, $category, $author, $mediaId, $userId);
        if ($stmt->execute()) {
            header('Location: recipes_view.php?success=1');
            exit;
        } else {
            redirectWithError("Error executing recipe insert: " . $stmt->error);
        }
    } else {
        redirectWithError("Error preparing recipe insert statement: " . $conn->error);
    }
}

$conn->close();
