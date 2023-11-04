<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connect to the database
$db = new mysqli('localhost', 'root', '', 'mywebapp');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$query = "SELECT username, email FROM users WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

$db->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?></h2>
    <p>Email: <?php echo $email; ?></p>
    <p>This is your dashboard.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
