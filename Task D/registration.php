    

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendee Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php
    include('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $first_name =  $conn->real_escape_string($_POST["first_name"]);
        $last_name =  $conn->real_escape_string($_POST["last_name"]);
        $email =  $conn->real_escape_string($_POST["email"]);
        $ticket_type =  $conn->real_escape_string($_POST["ticket_type"]);
        $mailing_list =  $conn->real_escape_string($_POST["mailing_list"]) ? 1 : 0;

        $sql = "INSERT INTO Attendee (First_Name, Last_Name, Email, ID, Ticket_Type, Mailing_List, Date_Checked_In) VALUES ('$first_name', '$last_name', '$email', 0, '$ticket_type', $mailing_list, NOW())";


        if ($conn->query($sql) === TRUE) {
    $maxIDQuery = "SELECT MAX(ID) AS maxID FROM Attendee";
    $result = $conn->query($maxIDQuery);

    if ($result && $row = $result->fetch_assoc()) {
        $newlyCreatedID = $row['maxID'];
        $message= "<h2> Attendee checked-in successfully. Their ID is: " . $newlyCreatedID . " </h2>";
    } else {
        $message = "Error retrieving the new ID.";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    }

$conn->close();
    ?>
    <iframe id="navbarContainer" src="navbar.html" frameborder="0" width="100%" height="100px"></iframe>

    <div class="container" style="text-align: center; width: 50%;">
    <h1>Attendee Registration</h1>

    <form action="" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>
        <br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <br>

        <label for="ticket_type">Ticket Type:</label>
        <select id="ticket_type" name="ticket_type">
            <option value="Undergraduate">Undergraduate</option>
            <option value="Weekend">Weekend Pass</option>
            <option value="Friday">Friday Day Pass</option>
            <option value="Saturday">Saturday Day Pass</option>
            <option value="Sunday">Sunday Day Pass</option>
            <option value="Child">Child Pass (0-12)</option>
        </select><br>
        <br>

        <label for="mailing_list">Subscribe to Mailing List:</label>
        <input type="checkbox" id="mailing_list" name="mailing_list" value="1"><br>
        <br>

        <button type="submit">Check-in Attendee</button>
    </form>

    <h2><?php echo $message; ?></h2>
</div>

                
</script>
</body>

</html>
