<?php
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

// Get the form data
$service = $_POST['service'];
$area = $_POST['area'];

// Prepare the SQL statement
$sql = "SELECT * FROM serviceprovider WHERE column3 = ? AND column5 = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $service, $area);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Display the results in a table
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                
                <th>Service</th>
                <th>Phone number</th>
                <th>Area</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                
                <td>" . $row["column3"] . "</td>
                <td>" . $row["column4"] . "</td>
                <td>" . $row["column5"] . "</td>
              </tr>";
    }
    echo "</table>";
    ?>
    <br>
<a href="userresults.php">Back </a>
<?php
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>