<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'marina');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO marina_project (name, email, subject, message) VALUES (?, ?, ?, ?)");
        
        // Check if the prepare() call was successful
        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }
        
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            echo "Registration successfully...";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>
