<?php
include 'config.php';

function getAllEvents() {
    global $conn;
    $sql = "SELECT * FROM Event";
    $result = $conn->query($sql);

    $events = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    return $events;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Table</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Events Table</h2>
    <?php
    $events = getAllEvents();

    if (!empty($events)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Event ID</th>';
        echo '<th>Staff Event Runner ID</th>';
        echo '<th>Attendee Event Runner ID</th>';
        echo '<th>Max Attendees</th>';
        echo '<th>Length Minutes</th>';
        echo '<th>Name</th>';
        echo '<th>Description</th>';
        echo '<th>Room</th>';
        echo '<th>Time</th>';
        echo '</tr>';

        foreach ($events as $event) {
            echo '<tr>';
            echo '<td>' . $event['Event_ID'] . '</td>';
            echo '<td>' . $event['Staff_Event_Runner_ID'] . '</td>';
            echo '<td>' . $event['Attendee_Event_Runner_ID'] . '</td>';
            echo '<td>' . $event['Max_Attendees'] . '</td>';
            echo '<td>' . $event['Length_Minutes'] . '</td>';
            echo '<td>' . $event['Name'] . '</td>';
            echo '<td>' . $event['Description'] . '</td>';
            echo '<td>' . $event['Room'] . '</td>';
            echo '<td>' . $event['Time'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No events found.</p>';
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>
