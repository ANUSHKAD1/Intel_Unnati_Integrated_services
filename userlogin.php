<?php
session_start();
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
$stmt = $conn->prepare("SELECT name, username,password FROM user WHERE username = ?");
$stmt->bind_param("s", $userInputUsername);

// Execute the statement
$stmt->execute();

// Store the result
$stmt->store_result();

// Check if the username exists
if ($stmt->num_rows > 0) {
    // Bind the result to variables
    $stmt->bind_result($name, $username, $hashedPassword);
    $stmt->fetch();
    // Verify the password
    if (password_verify($userInputPassword, $hashedPassword)) {
        $_SESSION['name'] = $name;
        echo "<script> window.location.assign('userresults.php'); </script>";
        //echo "Login successful!";
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