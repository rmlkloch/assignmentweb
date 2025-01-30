<?php
// Replace with your actual InfinityFree database credentials
$servername = "sql210.infinityfree.com"; // Find this in your InfinityFree MySQL settings
$username = "if0_38208139";
$password = "gHdewo8jLIg0D";
$dbname = "if0_38208139_slblog";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input data
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Check if required fields are not empty
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die("All fields are required!");
    }

    // Sanitize and prepare statement
    $insertFormQuery = "INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($insertFormQuery)) {
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            echo "Thank you for contacting us! We will get back to you soon.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
}

$conn->close();
?>
