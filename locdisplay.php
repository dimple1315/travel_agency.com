<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMS</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="home1.css">
    <link rel="stylesheet" href="display.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="display">
    <div class="addUser">
        <nav>
            <div class="side-nav">
                <div>
                    <div class="title-nav text-center">
                    </div>
                    <div class="nav-links py-3">
                        <ul>
                            <li><a href="home.php" class="nave">HOME</a></li>
                            <li><a href="transdisplay.php" class="nave">Transport_details</a></li>
                            <li><a href="empdisplay.php" class="nave">Employee_details</a></li>
                            <li><a href="schdisplay.php" class="nave">Schedule</a></li>
                            <li><a href="locdisplay.php" class="nave">Locations</a></li>
                            <li><a href="login.php" class="nave">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <?php
        // Include the file with your database connection details
        include 'connect.php';

        // Query to select location details
        $sql = 'SELECT * FROM `Location`'; // Use backticks for table name, not double quotes

        // Execute the query
        $result = $conn->query($sql);
        
        // Display table headers
        echo "<table border='2' class='tb'>
            <tr>
                <th>Vehicle ID</th>
                <th>Transport ID</th>
                <th>From</th>
                <th>To</th>
                <th>Operation</th>
            </tr>";
        
        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>". $row["vehicle_ID"]. "</td>";
                echo "<td>". $row["Transport_ID"]. "</td>";
                echo "<td>". $row["LFrom"]. "</td>"; // Corrected column name
                echo "<td>". $row["To_"]. "</td>";
                echo '<td>
                    <button class="lap"><a href="locupdate.php?vehicle_ID1='.$row['vehicle_ID'].'">update</a></button>
                    <button class="lap"><a href="locdelete.php?vehicle_ID='.$row['vehicle_ID'].'">delete</a></button>
                </td>';
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
        <button><a href="Location.php" class="Add">Add Location</a></button> <!-- Changed "Add User" to "Add Location" -->
    </div>
</body>
</html>
