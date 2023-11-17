<?php
// Replace these with your database credentials
$host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "db_event_management";

$conn = new mysqli($host, $db_username, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $collegeName = $_POST["collegeName"];
    $email = $_POST["email"];
    $coordinatorName = $_POST["coordinatorName"];
    $departmentName = $_POST["departmentName"];
    $contactNumber = $_POST["contactNumber"];
    $whatsappNumber = $_POST["whatsappNumber"];

    // Prepare and execute the SQL INSERT statement
    $sql = "INSERT INTO sta_reg (collegeName, email, coordinatorName, departmentName, contactNumber, whatsappNumber)
    VALUES ('$collegeName', '$email', '$coordinatorName', '$departmentName', '$contactNumber', '$whatsappNumber')";

    $result = $conn->query($sql);

    // if ($result) {
    //     echo "Staff registration successful!";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Staff Registration Form</title> <!-- Fixed the title tag -->
    <link rel="stylesheet" href="sta_reg.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
      /* Add CSS styles for the link here */
      .join-link {
        display: inline-block;
        text-decoration: none;
        background-color: #0073e6;
        color: #fff;
        padding: 10px 110px;
        border-radius: 5px;
      }
      .join-link:hover {
        background-color: #0056b3; /* Change to a darker shade on hover */
        transform: scale(1.05); /* Scale up slightly on hover */
      }
      .container .title::before{
        background: linear-gradient(-135deg, #000000, #ff0000);
      }
     </style>
   </head>
<body class="b3" style="background: linear-gradient(-135deg, #000000, #ff0000);">
  <div class="container">
    <div class="title" >Staff Registration Form</div>
    <div class="content">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- Added action attribute -->
        <div class="user-details">
          <div class="input-box">
            <span class="details">Collage Name</span>
            <input type="text" name="collegeName" placeholder="Enter College Name" required>
          </div>

          <div class="input-box">
            <span class="details">Email ID</span>
            <input type="email" name="email" placeholder="Email ID" required>
          </div>

          <div class="input-box">
            <span class="details">Name of Co-Ordinator</span>
            <input type="text" name="coordinatorName" placeholder="Enter Name of Coordinator" required>
          </div>
          
          <div class="input-box">
            <span class="details">Department Name</span>
            <input type="text" name="departmentName" placeholder="Enter Department Name" required>
          </div>
          <div class="input-box">
            <span class="phone">Contact Number</span>
            <input type="tel" name="contactNumber" pattern="[0-9]{10}" title="Ten digits code" class="input-field" placeholder="Contact no." required>
          </div>
          <div class="input-box">
            <span class="phone">Whatsapp Number</span>
            <input type="tel" name="whatsappNumber" pattern="[0-9]{10}" title="Ten digits code" class="input-field" placeholder="Whatsapp no." required>
          </div>

          <div class="input-box">
            <span class="details" >Join the whatsapp group link:</span>
            <a class="join-link" target="_blank" href="https://chat.whatsapp.com/Kg5jUUlw8d09TO8JSqVjcT" style="background: linear-gradient(-135deg, #000000, #ff0000);">JOIN HERE</a>
          </div>

          <div class="button">
            <input type="submit" value="Submit" style="background: linear-gradient(-135deg, #000000, #ff0000);">
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
