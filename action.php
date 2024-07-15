<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $value1 = $_POST['value1'];
    $value2 = $_POST['value2'];
    $value3 = $_POST['value3'];
    $value4 = $_POST['value4'];
    $value5 = $_POST['value5'];

    // Validate form valuesgttyi
    if (!empty($value1) && !empty($value2)) {
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
        $hashed_password = password_hash($value2, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO serviceprovider (column1, column2, column3, column4, column5) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $value1, $hashed_password, $value3, $value4, $value5);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully"; 
			
        
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