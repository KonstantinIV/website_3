<?php 


$servername = "localhost";
$username = "root";
$password = "qwerty";
$dbname = "webpage_3";

// Var

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT ID , first_text, second_text, third_text FROM project_text";
$result = $conn->query($sql);
$information = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $information[] = $row;
        //echo $row;
    }
} else {
    echo "0 results";
}
$conn->close();
echo  json_encode($information); 
/*
  $output = "TROOLRROTRKTOERKPTKERPKTRK";
  echo $output;*/
?>