<?php
include 'config.php';

// Escape user inputs for security
$primary_team = $conn->real_escape_string($_POST['primary_team']);
$rank = $conn->real_escape_string($_POST['rank']);
$first_name = $conn->real_escape_string($_POST['first_name']);
$last_name = $conn->real_escape_string($_POST['last_name']);
$password = $conn->real_escape_string($_POST['password']);

// print all data
// print_r($_POST);

// Insert data into the database
$sql = "INSERT INTO Staff (First_name, Last_name, ID, Primary_team, `Rank`, Password) VALUES ('$first_name', '$last_name', 0, '$primary_team', '$rank', '$password')";

if ($conn->query($sql) === TRUE) {
    // Retrieve the maximum ID from the Staff table
    $maxIDQuery = "SELECT MAX(ID) AS maxID FROM Staff";
    $result = $conn->query($maxIDQuery);

    if ($result && $row = $result->fetch_assoc()) {
        $newlyCreatedID = $row['maxID'];
        $message = "Account created successfully. Your new ID is: " . $newlyCreatedID;
    } else {
        $message = "Error retrieving the new ID.";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created</title>
  <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <br>
        <iframe id="navbarContainer" src="navbar.html" frameborder="0" width="100%" height="100px"></iframe>

        
    <div class="container" style="text-align: center;">
        <h1><?php echo $message; ?></h1>
        <h1><a href="create_account.html">Return to account creation</a></h1>
    </div>
    </body>

