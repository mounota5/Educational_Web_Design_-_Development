<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    $db = new mysqli('localhost', 'root', '', 'mywebapp');

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Perform SQL injection prevention here (e.g., use prepared statements)

    // Check if the email is already in use
    $check_query = "SELECT id FROM users WHERE email = ?";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Email is already in use
        $check_stmt->close();
        $db->close();
        $error_message = "Email address is already in use. Please use a different email.";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $insert_stmt = $db->prepare($insert_query);
        $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($insert_stmt->execute()) {
            // Registration successful
            $insert_stmt->close();
            $db->close();
            // Display a confirmation message
            echo "<script>alert('Registration complete! Your information has been saved.')</script>";
        } else {
            // Registration failed
            $insert_stmt->close();
            $db->close();
            $error_message = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="index.php">Go To Login</a></p>
</body>
</html>
