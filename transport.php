<?php
// Include the file with your database connection details
include 'connect.php';

// Check if the form is submitted
if(isset($_POST['submit'])){
    $id = $_POST['Transport_ID'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $TNo_of_vehicles = $_POST['TNo_of_vehicles'];
    $capacity = $_POST['capacity'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO transport (Transport_ID, TName, TType, TNo_of_vehicles, Capacity) VALUES ($id, '$name', '$type', '$TNo_of_vehicles', '$capacity')";

    // Perform the query
    $result = mysqli_query($conn, $sql);
    if($result){
        header('location:transdisplay.php');
    } else {
        // echo mysqli_error($conn);
        echo "Data not inserted successfully";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transport Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="background">
    <div class="transport">
        <h1>Add Transport Details</h1>
        <form  method="post">
            <label for="Transport_ID">Transport_ID:</label>
            <input type="number" id="Transport_ID" name="Transport_ID" ><br><br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" ><br><br>
            <label for="type">Type:</label>
            <input type="text" id="type" name="type"  ><br><br>
            <label for="TNo_of_vehicles">No of vehicles:</label>
            <input type="number" id="TNo_of_vehicles" name="TNo_of_vehicles"  ><br><br>
            <label for="capacity">Capacity:</label>
            <input type="text" id="capacity" name="capacity"  ><br><br>
            <button type="submit" class="btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
