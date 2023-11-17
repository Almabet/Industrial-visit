

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
    $fullName = $_POST["fullName"];
    $departmentName = $_POST["departmentName"];
    $contactNumber = $_POST["contactNumber"];
    $whatsappNumber = $_POST["whatsappNumber"];
    $academicYear = $_POST["studentyear"];
    $levelOfEducation = $_POST["level"];

    // Validate the form data here as needed.

    // If validation is successful, proceed with database insertion.
    $sql = "INSERT INTO stu_reg (collegeName, fullName, departmentName, contactNumber, whatsappNumber, academicYear, levelOfEducation)
    VALUES ('$collegeName', '$fullName', '$departmentName', '$contactNumber', '$whatsappNumber', '$academicYear', '$levelOfEducation')";

    $result = $conn->query($sql);

    
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="stu_reg.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
      body{
        height: 100vh;
      }
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
     <script>
      
      function submitForm() {
        
        // Get form elements
        var collegeName = document.getElementsByName("collegeName")[0].value;
        var fullName = document.getElementsByName("fullName")[0].value;
        var departmentName = document.getElementsByName("departmentName")[0].value;
        var contactNumber = document.getElementsByName("contactNumber")[0].value;
        var whatsappNumber = document.getElementsByName("whatsappNumber")[0].value;

        // Simple validation
        if (collegeName === "" || fullName === "" || departmentName === "" || contactNumber === "" || whatsappNumber === "") {
            alert("All fields are required.");
            return;
        }

        // Phone number validation (10 digits)
        var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(contactNumber) || !phonePattern.test(whatsappNumber)) {
            alert("Please enter a valid 10-digit phone number.");
            return;
        }

        // If all validations pass, submit the form
        document.querySelector("form").submit();
      }
     </script>
   </head>
<body class="b3" style="background: linear-gradient(-135deg, #000000, #ff0000);">
  <div class="container">
    <div class="title">Student Registration Form</div>
    <div class="content">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="user-details">
        <div class="input-box">
            <span class="details">Collage Name</span>
            <input type="text" name="collegeName" placeholder="Enter College Name" required>
          </div>
          <div class="input-box">
            <span class="details">Full Name of Student</span>
            <input type="text" name="fullName" placeholder="Full Name of Student" required>
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
            <span class="details">Academic Year Of Student</span>
            <select name="studentyear">
                <option value="FE">FE</option>
                <option value="SE">SE</option>
                <option value="TE">TE</option>
                <option value="BE">BE</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Level of Education</span>
            <select name="level">
                <option value="Diploma">Diploma</option>
                <option value="Bachelors of Engineering">Bachelors of Engineering</option>
                <option value="BCA">BCA</option>
                <option value="BCS">BCS</option>
                <option value="BSc">BSc</option>
                <option value="MCA">MCA</option>
                <option value="MSc">MSc</option>
                <option value="ME">ME</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Join the whatsapp group link:</span>
            <a class="join-link" target="_blank" href="https://chat.whatsapp.com/Kg5jUUlw8d09TO8JSqVjcT" style="background: linear-gradient(-135deg, #000000, #ff0000);">JOIN HERE</a>
          </div>
          <div class="button">
            <input type="button" value="Submit" style="background: linear-gradient(-135deg, #000000, #ff0000);" onclick="submitForm() || sendMessage()">
          </div>
      </form>
    </div>
  </div>
</body>
</html>

