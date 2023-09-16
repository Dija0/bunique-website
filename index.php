<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bunique_data');
    
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Hash the password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Prepare and execute the SQL statement with placeholders
        $stmt = $conn->prepare("INSERT INTO bunique_table (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            echo "Registration Successful...";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>



