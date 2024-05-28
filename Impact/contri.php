<?php
// Include the database connection file
include('../connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define upload directory
    $uploadDir = "uploads/";

    // Check if the upload directory exists, if not create it
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Define allowed file types
    $allowedTypes = array('pdf', 'doc', 'docx');

    // Get file details
    $fileName = basename($_FILES["fileUpload"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileSize = $_FILES["fileUpload"]["size"];
    $fileTemp = $_FILES["fileUpload"]["tmp_name"];
    $filePath = $uploadDir . $fileName;

    // Check file type and size
    if (in_array($fileType, $allowedTypes)) {
        // Move uploaded file to destination directory
        if (move_uploaded_file($fileTemp, $filePath)) {
            // Insert file details into the database
            $sql = "INSERT INTO uploaded_files (file_name, file_type, file_size, file_path) 
                    VALUES ('$fileName', '$fileType', '$fileSize', '$filePath')";
            if ($database->query($sql) === TRUE) {
                // File uploaded successfully, redirect to co.html
                header("Location: co.html");
                exit; // Stop further execution
            } else {
                echo "Error: " . $sql . "<br>" . $database->error;
            }
        } else {
            echo "Error uploading file";
        }
    } else {
        echo "Invalid file type. Allowed types are: pdf, doc, docx";
    }
}
?>
