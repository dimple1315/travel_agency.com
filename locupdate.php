<?php
// Include the file with your database connection details
include 'connect.php';

// Initialize variables
$id = null;
$row = null;

// Check if vehicle_ID1 is provided in the URL
if(isset($_GET['vehicle_ID1'])) {
    // Retrieve the vehicle ID from the URL
    $id = $_GET['vehicle_ID1'];

    // Fetch location details based on the vehicle ID
    $sql = "SELECT * FROM `location` WHERE vehicle_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

// Check if the form is submitted
if(isset($_POST['submit'])){
    $vehicle_ID = $_POST['vehicle_ID'];
    $transport_id = $_POST['Transport_ID'];
    $LFrom = $_POST['LFrom']; 
    $To_ = $_POST['To_']; 

    // SQL query to update data in the database
    $sql = "UPDATE `location` SET vehicle_ID=?, Transport_ID=?, LFrom=?, To_=? WHERE vehicle_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $vehicle_ID, $transport_id, $LFrom, $To_, $id);
    
    // Perform the query
    if($stmt->execute()){
        // Redirect to the display page after update
        header('location:locdisplay.php');
        exit();
    } else {
        echo "Error: " . $conn->error; // Display MySQL error
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="background">
    <div class="Location">
        <h1>Edit Location Details</h1>
        
        <form method="post">
            <label for="vehicle_ID">Vehicle ID:</label>
            <input type="text" id="vehicle_ID" name="vehicle_ID" value="<?php echo isset($row['vehicle_ID']) ? $row['vehicle_ID'] : ''; ?>"><br><br>
            <label for="Transport_ID">Transport ID:</label>
            <input type="number" id="Transport_ID" name="Transport_ID" value="<?php echo isset($row['Transport_ID']) ? $row['Transport_ID'] : ''; ?>"><br><br>
            <label for="LFrom">From:</label>
            <input type="text" id="LFrom" name="LFrom" value="<?php echo isset($row['LFrom']) ? $row['LFrom'] : ''; ?>"><br><br>
            <label for="To_">To:</label>
            <input type="text" id="To_" name="To_" value="<?php echo isset($row['To_']) ? $row['To_'] : ''; ?>"><br><br>
            <button type="submit" class="btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
