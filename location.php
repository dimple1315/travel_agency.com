<?php
// Include the file with your database connection details
include 'connect.php';

// Check if the form is submitted
if(isset($_POST['submit'])){
    $vehicle_ID = $_POST['vehicle_ID'] ?? ''; // Using null coalescing operator to handle undefined keys
    $transport_ID = $_POST['Transport_ID'] ?? ''; // Using null coalescing operator to handle undefined keys
    $LFrom = $_POST['LFrom'] ?? ''; // Using null coalescing operator to handle undefined keys
    $To_ = $_POST['To_'] ?? ''; // Using null coalescing operator to handle undefined keys

    // Check if the Transport_ID exists in the Transport table
    $check_sql = "SELECT * FROM Transport WHERE Transport_ID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $transport_ID);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if($result->num_rows === 0) {
        echo "Transport_ID does not exist. Please provide a valid Transport_ID.";
        exit;
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO Location (vehicle_ID, Transport_ID, LFrom, To_) VALUES (?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("iiss", $vehicle_ID, $transport_ID, $LFrom, $To_);

    // Execute the statement
    if($stmt->execute()){
       // echo "Data inserted successfully";
       header('location:locdisplay.php');
    } else {
        echo "Data not inserted successfully: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="background">
    <div class="Location">
        <h1>Add Location Details</h1>
        <form method="post">
            <label for="vehicle_ID">Vehicle ID:</label>
            <input type="number" id="vehicle_ID" name="vehicle_ID"><br><br>
            <label for="Transport_ID">Transport ID:</label>
            <input type="number" id="Transport_ID" name="Transport_ID"><br><br>
            <label for="LFrom">From:</label>
            <input type="text" id="LFrom" name="LFrom"><br><br>
            <label for="To_">To:</label>
            <input type="text" id="To_" name="To_"><br><br>
            <button type="submit" class="btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
