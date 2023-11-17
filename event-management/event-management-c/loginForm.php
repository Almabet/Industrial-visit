
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['name'];
    $password = $_POST['pwd'];

    // Validate username and password (You can add more validation as needed)
    if (empty($username) || empty($password)) {
        $errorMessage = "Please enter both username and password.";
    } else {
        // Establish a database connection (Update the database credentials accordingly)
        $host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "db_event_management";

        $conn = new mysqli($host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize user input to prevent SQL injection
        $username = $conn->real_escape_string($username);

        // Query to fetch user data by username
        $sql = "SELECT * FROM user_reg_form WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            // User exists, check password
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            if (password_verify($password, $hashedPassword)) {
                // Password is correct, user is authenticated
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                // Redirect to a dashboard or another page
                header("Location: index.php");
                exit();
            } else {
                // Invalid password
                $errorMessage = "Invalid password. Please try again.";
            }
        } else {
            // User does not exist
            $errorMessage = "User not found. Please check your username.";
        }

        // Close the database connection
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./loginForm.css">
    <style>
        .invalid-password {
            border-color: #ff0000 !important;
        }
        a:link {
            color: red;
        }
        a:visited {
            color: red;
        }
        a:hover{
            color:red;
        }
    </style>
     <script>
        function validatePassword() {
            var password = document.getElementById("pwd").value;
            var passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,10}$/;
            var passwordField = document.getElementById("pwd");
            var feedback = document.getElementById("password-feedback");

            if (!passwordRegex.test(password)) {
                // Password does not meet the requirements
                passwordField.classList.add("invalid-password");
                feedback.innerHTML = "Password should contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be between 6 and 10 characters in length.";
                return false;
            } else {
                // Password is valid, remove the red border and clear the feedback
                passwordField.classList.remove("invalid-password");
                feedback.innerHTML = "";
                return true;
            }
        }
    </script> 
</head>
<body class="d-flex align-items-center" style="height:100vh; background-image: linear-gradient(rgba(255, 0, 0, 0.4),rgba(0, 0, 0, 0.6)), url('./assets/images/red.jpg');">
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3>Login</h3></div>
                    <div class="card-body">
                        <form  method="post" onsubmit="return validatePassword();">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Username" required minlength="4">
                                <!-- <div class="invalid-feedback">Please enter a valid username with a minimum of 4 characters.</div> -->
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password" required>
                                <!-- <div class="invalid-feedback">Password should contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be between 6 and 10 characters in length.</div> -->
                                <!-- <div id="password-feedback" class="text-danger"></div>Feedback message for password -->
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-danger btn-block" >Sign In</button>
                            </div>
                        </form>
                        <?php
                        if (isset($errorMessage)) {
                            echo '<div class="alert alert-danger">'.$errorMessage.'</div>';
                        }
                        ?>
                    </div>
                    <div class="card-footer text-center">
                        <a href="./registration.php">Don't have an account? Register here</a><br>
                        <a href="../event-management/login.php">Are you an admin? Admin Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
