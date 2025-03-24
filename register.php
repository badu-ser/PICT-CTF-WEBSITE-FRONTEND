<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required fields
    if (
        empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['username']) || 
        empty($_POST['email']) || empty($_POST['number']) || empty($_POST['tournament']) || 
        !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    ) {
        die("Error: Missing required fields or invalid email format.");
    }

    // Sanitize inputs
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $number = htmlspecialchars(trim($_POST['number']));
    $tournament = htmlspecialchars(trim($_POST['tournament']));
    $new = isset($_POST['new']) ? htmlspecialchars(trim($_POST['new'])) : "No";
    $refer = isset($_POST['refer']) ? htmlspecialchars(trim($_POST['refer'])) : NULL;

    // Database connection details
    $servername = "sql313.byetcluster.com"; // Your server name
    $dbUsername = "if0_38226882"; // Your database username
    $password = "vPwSH5XcSms"; // Replace with your actual database password
    $dbname = "if0_38226882_register"; // Your database name

    // Create database connection
    $conn = new mysqli($servername, $dbUsername, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO registrations (first_name, last_name, username, email, number, tournament, new, refer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $firstName, $lastName, $username, $email, $number, $tournament, $new, $refer);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect on success
        header("Location: success.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
