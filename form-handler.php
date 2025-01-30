<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
?>

<?php
$servername = "sql210.infinityfree.com"; 
$username = "if0_38208139";
$password = "gHdewo8jLIg0D";
$dbname = "if0_38208139_slblog";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die("All fields are required!");
    }

    
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
