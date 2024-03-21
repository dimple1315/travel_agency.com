
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
<body  class="display">
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
                            <li><a href="empdisplay.php" class="nave">Empolyee_details</a></li>
                            <li><a href="schdisplay.php" class="nave">Schedule</a></li>
                            <li><a href="locdisplay.php" class="nave">Locations</a></li>
                            <li><a href="login.php" class="nave">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
       
        <table border="2" class="tb">
            <thead>
                <tr>
                    <th>Transport_id</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>No of vehicles</th>
                    <th>Capacity</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
            <?php
include 'connect.php'; // Assuming connect.php contains the database connection code

$sql = "SELECT * FROM Transport";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['Transport_ID']."</td>";
        echo "<td>".$row['TName']."</td>";
        echo "<td>".$row['TType']."</td>";
        echo "<td>".$row['TNo_of_vehicles']."</td>";
        echo "<td>".$row['Capacity']."</td>";

        echo '<td>
                <button class="lap"><a href="transupdate.php?transport_id='.$row['Transport_ID'].'">Update</a></button>
                <button class="lap"><a href="transdelete.php?transport_id='.$row['Transport_ID'].'">Delete</a></button>
              </td>';

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}
?>


                
            </tbody>
        </table>
        <button><a href="transport.php" class="Add">Add User</a></button>
    </div>
    
</body>
</html>