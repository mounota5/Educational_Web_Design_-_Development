<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    $db = new mysqli('localhost', 'root', '', 'mywebapp');

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Perform SQL injection prevention here (use prepared statements)
    $query = "SELECT id, username, password FROM users WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $username, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $hashed_password)) {
        // Passwords match, set the user's session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        // Invalid login credentials
        $error_message = "Invalid email or password. Please try again.";
    }

    $db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>
    <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>
    <form action="index.php" method="post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register Now</a></p>
</body>
</html>
