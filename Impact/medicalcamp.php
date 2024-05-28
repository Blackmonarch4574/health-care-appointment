<?php
// Include the database connection file
include('../connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $villageName = $database->real_escape_string($_POST['villageName']);
    $contactPerson = $database->real_escape_string($_POST['contactPerson']);
    $contactNumber = $database->real_escape_string($_POST['contactNumber']);
    $email = $database->real_escape_string($_POST['email']);
    $details = $database->real_escape_string($_POST['details']);

    // Attempt to insert the data into the database
    $sql = "INSERT INTO medical_setup (village_name, contact_person, contact_number, email, details) 
            VALUES ('$villageName', '$contactPerson', '$contactNumber', '$email', '$details')";
    if ($database->query($sql) === TRUE) {
        // Record added successfully, redirect to co.php
        header("Location: index.html");
        exit; // Stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . $database->error;
    }
}
?>
