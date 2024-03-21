<?php
include 'connect.php'; // Assuming connect.php contains the database connection code

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $transport_id = $_POST['transport_id'];
    $tname = $_POST['tname'];
    $ttype = $_POST['ttype'];
    $tno_of_vehicles = $_POST['tno_of_vehicles'];
    $capacity = $_POST['capacity'];

    // Prepare and execute SQL query to update the record
    $sql = "UPDATE Transport SET TName='$tname', TType='$ttype', TNo_of_vehicles='$tno_of_vehicles', Capacity='$capacity' WHERE Transport_ID=$transport_id";
    if (mysqli_query($conn, $sql)) {
        header('location:transdisplay.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// If transport_id is provided in the URL
if(isset($_GET['transport_id'])) {
    $transport_id = $_GET['transport_id'];

    // Retrieve the record to be updated
    $sql = "SELECT * FROM Transport WHERE Transport_ID=$transport_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transport Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add.css">
</head>
<body class="background">
    <div class="transport">
        <h2>Update Transport Details</h2>
        <form method="post">
            <input type="hidden" name="transport_id" value="<?php echo $row['Transport_ID']; ?>">
            <label for="tname">Name:</label><br>
            <input type="text" id="tname" name="tname" value="<?php echo $row['TName']; ?>"><br>
            <label for="ttype">Type:</label><br>
            <input type="text" id="ttype" name="ttype" value="<?php echo $row['TType']; ?>"><br>
            <label for="tno_of_vehicles">Number of Vehicles:</label><br>
            <input type="text" id="tno_of_vehicles" name="tno_of_vehicles" value="<?php echo $row['TNo_of_vehicles']; ?>"><br>
            <label for="capacity">Capacity:</label><br>
            <input type="text" id="capacity" name="capacity" value="<?php echo $row['Capacity']; ?>"><br><br>
            <button type="submit" class="btn-primary" name="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php
} else {
    echo "Invalid request";
}
?>
