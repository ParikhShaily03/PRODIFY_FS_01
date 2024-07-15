<?php
include 'db.php';
if($_SERVER['REQUEST_METHOD']=="POST")
{
// Collect form data
$name = htmlspecialchars(trim($_POST['user_name']));
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Signup successful. <a href='login.php'>Login here</a>";
    echo "<script type='text/javascript'> alert('successfully Register')</script>";
} 
else {
    echo "Error: " . $stmt->error;
    echo "<script type='text/javascript'> alert('enter valid info')</script>";
}

$stmt->close();
$conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Signup</h2>
    <form action="signup.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="user_name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Signup</button>
    </form>
</body>
</html>
