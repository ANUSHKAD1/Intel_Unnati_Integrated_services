<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User input
$userInputUsername = $_POST['username'];
$userInputPassword = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT id, column1, column2 FROM serviceprovider WHERE column1 = ?");
$stmt->bind_param("s", $userInputUsername);

// Execute the statement
$stmt->execute();

// Store the result
$stmt->store_result();

// Check if the username exists
if ($stmt->num_rows > 0) {
    // Bind the result to variables
    $stmt->bind_result($id, $username, $hashedPassword);
    $stmt->fetch();
$_SESSION['username']=$username;
    // Verify the password
    if (password_verify($userInputPassword, $hashedPassword)) {
        echo "Login successful!";
        // Set session variables or do other login-related tasks here
    } else {
        echo "Invalid password.";
    }
} else {
    echo "Invalid username.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>