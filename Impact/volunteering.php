<?php
// Include the database connection file
include '../connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $name = $email = $phone = $availability = $skills = $motivation = "";

    // Process form data when the form is submitted
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $availability = test_input($_POST["availability"]);
    $skills = test_input($_POST["skills"]);
    $motivation = test_input($_POST["motivation"]);

    // SQL query to insert form data into the database
    $sql = "INSERT INTO volunteer_form (name, email, phone, availability, skills, motivation) 
            VALUES ('$name', '$email', '$phone', '$availability', '$skills', '$motivation')";

    // Execute the SQL query
    if ($database->query($sql) === TRUE) {
        // Redirect to thank you page after successful form submission
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $database->error; // Display error message if query execution fails
    }

    // Close the database connection
    $database->close();
}

// Function to sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
