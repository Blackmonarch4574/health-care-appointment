<?php
// Include the database connection file
include "../connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $donationAmount = $_POST["donation-amount"];
    $donationType = $_POST["donation-type"];
    $name = $_POST["name"];
    $email = isset($_POST["email"]) ? $_POST["email"] : null; // Make email optional
    $additionalInfo = $_POST["additional-info"];
    $honorName = isset($_POST["honor-name"]) ? $_POST["honor-name"] : null; // Make honor name optional
    $honorRelationship = isset($_POST["honor-relationship"]) ? $_POST["honor-relationship"] : null; // Make honor relationship optional

    // Prepare and execute SQL query to insert data into the database
    $sql = "INSERT INTO donations (donation_amount, donation_type, name, email, additional_info, honor_name, honor_relationship) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $database->prepare($sql); // Use $database instead of $conn
    $stmt->bind_param("dssssss", $donationAmount, $donationType, $name, $email, $additionalInfo, $honorName, $honorRelationship);
    
    if ($stmt->execute()) {
        // Close statement
        $stmt->close();

        // Redirect to a thank you page
        header("Location: index.html");
        exit();
    } else {
        // Handle execution error
        echo "Error: " . $stmt->error;
    }
} else {
    // Handle form not submitted
    echo "Form not submitted!";
}
?>
