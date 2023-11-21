<?php
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the table name from the HTML form
    $tableName = $conn->real_escape_string($_POST['tableName']);

    // Fetch column names from the database
    $sqlColumns = "SHOW COLUMNS FROM $tableName";
    $resultColumns = $conn->query($sqlColumns);

    // Check if there is data
    if ($resultColumns->num_rows > 0) {
        $columns = array();

        // Store column names in an array
        while ($rowColumns = $resultColumns->fetch_assoc()) {
            $columns[] = $rowColumns['Field'];
        }

        // Fetch data from the database
        $sqlData = "SELECT * FROM $tableName";
        $resultData = $conn->query($sqlData);

        // Check if there is data
        if ($resultData->num_rows > 0) {
            echo "<table border='1' id='mainTable'>";
            
            // Output table header with column names
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<th>" . $column . "</th>";
            }
            echo "</tr>";   

            // Output data of each row
            while ($rowData = $resultData->fetch_assoc()) {
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<td>" . $rowData[$column] . "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "0 results";
        }
    } else {
        echo "No columns found for table: $tableName";
    }
} else {
    // If form is not submitted, display the form
    echo '<form method="post" action="">
            <label for="tableName">Enter Table Name:</label>
            <input type="text" name="tableName" required>
            <button type="submit">Submit</button>
          </form>';
}

// Close the database connection
$conn->close();
?>
