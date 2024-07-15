<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $value1 = $_POST['value1'];
    $value2 = $_POST['value2'];
    $value3 = $_POST['value3'];
    

    // Validate form valuesgttyi
    if (!empty($value2) && !empty($value3)) {
        // Database credentials
        $servername = "localhost";
        $usernamee = "root";
        $password = "";
        $dbname = "health";

        // Create connection
        $conn = new mysqli($servername, $usernamee, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $hashed_password = password_hash($value3, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO user (name, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $value1, $value2, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New user created successfully"; 
			
        
		} else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill in both values.";
    }
} else {
    echo "Invalid request.";
}
?>