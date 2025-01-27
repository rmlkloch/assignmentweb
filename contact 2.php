<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "contact"; 


$conn = new mysqli('localhost', 'root', '', 'contact');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    
    $insertFormQuery = "INSERT INTO contact_form (name, email, subject, message) 
                        VALUES (?, ?, ?, ?)";

    
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