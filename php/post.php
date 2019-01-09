<?php 


$servername = "localhost";
$username = "root";
$password = "qwerty";
$dbname = "webpage_3";

$text = $_POST['text'];
// Var

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "insert into post (name, text) values ('k','".$text."')";
$sql1 = "insert into post (name, text) values ('k','testt')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>