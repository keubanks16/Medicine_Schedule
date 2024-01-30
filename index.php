
<br></br>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<center>
<br>
</br>
<h2>Add Medication</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Drug: <input type="text" name="name" required><br></br>
    Time: <input type="time" name="schedule_time" required><br></br>
    Date: <input type="date" name="start_date" required><br></br>

    <input type="submit" value="Add Medication">
</form>
</center>

<center>
<?php


$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "medicine_schedule";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch medications from the database
$sql = "SELECT name, DATE_FORMAT(schedule_time, '%h:%i %p') AS schedule_time, DATE_FORMAT(start_date, '%m/%d/%Y') AS start_date FROM medications";
$result = $conn->query($sql);

// Display medication schedule
echo "<h2>Medication Schedule</h2>";

if ($result->num_rows > 0) {
    echo "<table border='2' cellpadding='10px'>";
    echo "<tr><th> Drug </th><th> Time </th><th> Date </th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["schedule_time"] . "</td>";
        echo "<td>" . $row["start_date"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

}
$conn->close();

?> </center>


<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "medicine_schedule";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $scheduleTime = $_POST["schedule_time"];
    $startDate = $_POST["start_date"];

    // Insert medication into the database
    $sql = "INSERT INTO medications (name, schedule_time, start_date) VALUES ('$name', '$scheduleTime', '$startDate')";

    if ($conn->query($sql) === TRUE) {
        echo "<meta http-equiv='refresh' content='0'>";
		
	} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 


}


	
?>

