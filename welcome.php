<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['password'])) {
    header("Location: index.php");
    exit();
}

// Logout and redirect to login page
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome</h1>
    <p>Your password is: <?php echo htmlspecialchars($_SESSION['password']); ?></p>
    <a href="welcome.php?logout=true">Logout</a>
</body>
</html>
