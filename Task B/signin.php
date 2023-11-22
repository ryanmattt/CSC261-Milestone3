<?php
include 'config.php'; // Include your database connection configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $id = $conn->real_escape_string($_POST['id']);
    $password = $conn->real_escape_string($_POST['password']);


    // Check login credentials
    $sql = "SELECT * FROM Staff WHERE ID = '$id' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $message = "Login successful!";
    } else {
        // Login failed
        $message = "Login failed. Please check your ID and password.";
    }
} else {
    // Redirect to the sign-in page if accessed directly without form submission
    header("Location: signin.html");
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <title>Event Table</title>
</head>

<body>
    <iframe id="navbarContainer" src="navbar.html" frameborder="0" width="100%" height="100px"></iframe>
<div class="container">
    <h1><?php echo $message; ?></h1>
</div>

</body>

</html>
