<?php
// Include the file with your database connection details
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Management System</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="home1.css">
    <link rel="stylesheet" href="display.css">
</head>
<body class="Train">
    <div class="clearfix">
        <nav>
            <div class="side-nav">
                <div>
                    <div class="title-nav text-center">  
                        <div class="nav-links py-3">
                            <ul>
                                <li><a href="home.php" class="nave"><b>HOME</b></a></li>
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
</body>

</html>