<?php
$servername = "localhost";
$username = "root"; // Change if your username is different
$password = ""; // Change if your password is different
$dbname = "contact"; // Replace with your database name

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
$conn = new mysqli('localhost', 'root', "", 'contact');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize form data to prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Prepare SQL query to insert the form data into the database
    $insertFormQuery = "INSERT INTO contact_form (name, email, subject, message) 
                        VALUES (?, ?, ?, ?)";

    // Prepare statement
    if ($stmt = $conn->prepare($insertFormQuery)) {
        // Bind parameters
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Thank you for contacting us! We will get back to you soon.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>