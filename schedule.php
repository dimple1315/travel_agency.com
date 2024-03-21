<?php
// Include the file with your database connection details
include 'connect.php';

// Check if the form is submitted
if(isset($_POST['submit'])){
    $date = $_POST['SDate'];
    $schedule_id = $_POST['Schedule_ID']; // Corrected variable name
    $transport_id = $_POST['Transport_ID']; 
    $employee_id = $_POST['Employee_ID'];   // this is the foreign key
    $stime = $_POST['source_Time'];
    $dtime = $_POST['destination_Time'];

    // Validate form data
    if(empty($date) || empty($schedule_id) || empty($transport_id) || empty($employee_id) || empty($stime) || empty($dtime)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Check if the Transport_ID exists in the Transport table
    $check_sql = "SELECT * FROM Transport WHERE Transport_ID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $transport_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if($result->num_rows === 0) {
        echo "Transport_ID does not exist. Please provide a valid Transport_ID.";
        exit;
    }

    $check_sql = "SELECT * FROM Employee WHERE Employee_ID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $employee_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if($result->num_rows === 0) {
        echo "Employee_ID does not exist. Please provide a valid Employee_ID.";
        exit;
    }
   
    // Prepare the SQL statement
    $sql = "INSERT INTO Schedule (SDate, Schedule_ID, Transport_ID, Employee_ID, source_Time, destination_Time) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("ssissi", $date, $schedule_id, $transport_id, $employee_id, $stime, $dtime);

    // Execute the statement
    if($stmt->execute()){
        //echo "Data inserted successfully";
       header('location:schdisplay.php');
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
    <title>Add Schedule Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="background">
    <div class="container">
        <h1>Add Schedule Details</h1>
        <form method="post">
            <label for="SDate">Date:</label>
            <input type="date" id="SDate" name="SDate" required><br><br>
            <label for="Schedule_ID">Schedule_ID:</label>
            <input type="text" id="Schedule_ID" name="Schedule_ID" required><br><br>
            <label for="Transport_ID">Transport_ID:</label>
            <input type="text" id="Transport_ID" name="Transport_ID" required><br><br>
            <label for="Employee_ID">Employee_ID:</label>
            <input type="text" id="Employee_ID" name="Employee_ID" required><br><br>
            <label for="source_Time">Arrival_Time:</label>
            <input type="time" id="source_Time" name="source_Time" required><br><br>
            <label for="destination_Time">Departure_Time:</label>
            <input type="time" id="destination_Time" name="destination_Time" required><br><br>
            <button type="submit" class="btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
