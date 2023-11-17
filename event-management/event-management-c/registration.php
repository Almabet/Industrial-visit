<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Perform server-side validation
    $errorMessages = array();

    // Validate username
    if (strlen($username) < 4) {
        $errorMessages[] = 'Username must be at least 4 characters long.';
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = 'Please enter a valid email address.';
    }

    // Password validation
    if (strlen($password) < 6) {
        $errorMessages[] = 'Password must be at least 6 characters long.';
    } elseif ($password !== $confirmPassword) {
        $errorMessages[] = 'Passwords do not match.';
    } elseif (!preg_match('/[A-Z]/', $password) ||
              !preg_match('/[a-z]/', $password) ||
              !preg_match('/[0-9]/', $password) ||
              !preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/', $password)) {
        $errorMessages[] = 'Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.';
    }

    if (empty($errorMessages)) {
        // All data is valid, insert into the database
        // Update the database credentials and connection details
        $host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "db_event_management";

        $conn = mysqli_connect($host, $db_username, $db_password, $db_name);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Sanitize user input to prevent SQL injection
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password

        // Insert user data into the database
        $sql = "INSERT INTO user_reg_form (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
        // $sql = "INSERT INTO `tbl_users`(`id`, `name`, `pwd`, `address`, `phone`, `email`, `type`, `status`, `bdate`) VALUES ('$username', '$email', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            // Registration successful
            $successMessage = "Registration successful!";
        } else {
            $errorMessages[] = "Error in database query: " . mysqli_error($conn);
        }
        
        $sql1 = "INSERT INTO tbl_users (name, email, pwd, type,status) VALUES ('$username', '$email', '$hashedPassword', 'admin','active')";
        mysqli_query($conn, $sql1);

        // Close the database connection
        mysqli_close($conn);
    }
}
?>

<!-- The rest of your HTML code remains unchanged -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .invalid-input {
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
        function validateForm() {
            var username = document.getElementById("username").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            var usernameField = document.getElementById("username");
            var emailField = document.getElementById("email");
            var passwordField = document.getElementById("password");
            var confirmPasswordField = document.getElementById("confirm-password");

            // Reset validation styles and messages
            usernameField.classList.remove("invalid-input");
            emailField.classList.remove("invalid-input");
            passwordField.classList.remove("invalid-input");
            confirmPasswordField.classList.remove("invalid-input");
            document.getElementById("error-message").innerHTML = "";

            // Username validation
            if (username.length < 4) {
                usernameField.classList.add("invalid-input");
                document.getElementById("error-message").innerHTML = "Username must be at least 4 characters long.";
                return false;
            }

            // Email validation
            if (!emailRegex.test(email)) {
                emailField.classList.add("invalid-input");
                document.getElementById("error-message").innerHTML = "Please enter a valid email address.";
                return false;
            }

            // Password validation
            var uppercaseRegex = /[A-Z]/;
            var lowercaseRegex = /[a-z]/;
            var symbolRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/;
            var numberRegex = /[0-9]/;

            if (
                password.length < 6 ||
                !uppercaseRegex.test(password) ||
                !lowercaseRegex.test(password) ||
                !symbolRegex.test(password) ||
                !numberRegex.test(password)
            ) {
                passwordField.classList.add("invalid-input");
                document.getElementById("error-message").innerHTML = "Password must meet the complexity requirements: at least one uppercase letter, one lowercase letter, one special symbol, one number, and be at least 6 characters long.";
                return false;
            }

            // Confirm password validation
            if (password !== confirmPassword) {
                confirmPasswordField.classList.add("invalid-input");
                document.getElementById("error-message").innerHTML = "Passwords do not match.";
                return false;
            }

            return true;
        }
    </script>
</head>
<body class="d-flex align-items-center" style="height:100vh; background-image: linear-gradient(rgba(0, 0, 0, 0.4),rgba(255, 0, 0, 0.6)), url('./assets/images/red.jpg');">
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3>Registration</h3></div>
                    <div class="card-body">
                        <form method="post" onsubmit="return validateForm();" >
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-danger btn-block">Register</button>
                            </div>
                        </form>
                        <div id="error-message" class="text-danger text-center"></div><!-- Validation error message -->
                    </div>
                    <div class="card-footer text-center">
                        <a href="./loginForm.php">Already have an account? Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
