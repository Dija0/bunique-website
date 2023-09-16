<?php
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection
$con = new mysqli("localhost", "root", "", "bunique_data");

if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM bunique_table WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        // Verify the password using password_verify
        if (password_verify($password, $data['password'])) {
            echo "<h2>Login Successful...</h2>";
        } else {
            echo "<h2>Invalid Email or Password. <a href='sign.html'>Register</a> if you don't have an account.</h2>";
        }
    } else {
        echo "<h2>Invalid Email or Password. <a href='sign.html'>Register</a> if you don't have an account.</h2>";
    }
}

$con->close();
?>
