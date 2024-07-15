<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: user.html");
    exit();
}
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



// Fetch providers
$provider_sql = "SELECT column5 FROM serviceprovider";
$provider_result = $conn->query($provider_sql);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   <title> AyuCare :Integrated health service at your doors </title>

    <link rel="stylesheet" href="userresults.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    <script src="userresults.js"></script>
  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="#">AyuCare</a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name">AyuCare</span>
          <i class='bx bx-x' ></i>
        </div>
        <ul class="links">
          <!-- <li><a href="#">HOME</a></li> -->
          <li>
            <a href="#">Hi <?php echo $_SESSION['name']; ?></a>
            
          </li>
          
          <li><a href="logout.php">Logout</a></li>
          <!-- <li><a href="#">CONTACT US</a></li> -->
        </ul>
      </div>
      <div class="search-box">
        <i class='bx bx-search'></i>
        <div class="input-box">
          <input type="text" placeholder="Search...">
        </div>
      </div>
    </div>
  </nav>
<br>
<br>
<br>

  <h2>Service Selection Form</h2>
  <form action="search.php" method="post">
      <label for="service">Select a Service:</label>
      <select id="service" name="service">
        <option value="hospital services">Hospital servies</option>
        <option value="lab testing services">Lab testing services</option>
        <option value="nursing services">Nursing services</option>
        <option value="nearby pharmacies">Nearby Pharmacies Open</option>
        <option value="clinic services">Clinic services</option>
        <option value="health insurances">Health Insurances</option>
      </select>
      <br><br>
      <label for="area">Select Area:</label>
      <select id="area" name="area">
      <?php
            if ($provider_result->num_rows > 0) {
                // Output data of each row
                while($row = $provider_result->fetch_assoc()) {
                    echo "<option value='" . $row["column5"] . "'>" . $row["column5"] . "</option>";
                }
            } else {
                echo "<option value=''>No providers available</option>";
            }
            ?>
      </select>
      <br><br>
      <button type="submit">Submit</button>
  </form>


  <script src="script.js"></script>
</body>
</html>