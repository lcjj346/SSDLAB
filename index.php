<?php
session_start();

// Load the common passwords into an array
function loadCommonPasswords($filePath) {
    $commonPasswords = [];
    if (file_exists($filePath)) {
        $file = fopen($filePath, "r");
        while (($line = fgets($file)) !== false) {
            $commonPasswords[] = trim($line);
        }
        fclose($file);
    } else {
        die("Password list file not found.");
    }
    return $commonPasswords;
}

// Function to validate the password
function validatePassword($password, $commonPasswords) {
    // Check password length
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }

    // Check for common passwords
    if (in_array($password, $commonPasswords)) {
        return "Password is too common. Please choose a different password.";
    }

    // Check for at least one uppercase letter, one lowercase letter, one number, and one special character
    if (!preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[\W_]/', $password)) {
        return "Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }

    return true;
}

// Load common passwords
$commonPasswords = loadCommonPasswords("10-million-password-list-top-1000.txt");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $validationResult = validatePassword($password, $commonPasswords);

    if ($validationResult === true) {
        // Password is valid, set session and redirect
        $_SESSION['password'] = $password;
        header("Location: welcome.php");
        exit();
    } else {
        // Password is invalid, show error message
        $error = $validationResult;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
