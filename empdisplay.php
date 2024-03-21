
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
    <div>
        <nav>
            <div class="side-nav">
                <div>
                    <div class="title-nav text-center">
                    
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
            </div>
        </nav>
    </div>
    <div class="addUser">
        <table border="2" class="tb">
            <thead>
                <tr>
                    <th>Employee_ID</th>
                    <th>Admin_ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'connect.php'; // Assuming connect.php contains the database connection code

            $sql = "SELECT * FROM Employee";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['Employee_ID']."</td>";
                    echo "<td>".$row['Admin_ID']."</td>";
                    echo "<td>".$row['EName']."</td>";
                    echo "<td>".$row['Position']."</td>";
                    
                    echo '<td>
                            <button class="lap"><a href="empupdate.php?employee_id1='.$row['Employee_ID'].'">update</a></button>
                            <button class="lap"><a href="empdelete.php?employee_id='.$row['Employee_ID'].'">delete</a></button>
                            </td>';
                
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }
            ?>

                
            </tbody>
        </table>
        <button><a href="empolyee.php" class="Add">Add User</a></button>
    </div>
    
</body>
</html>