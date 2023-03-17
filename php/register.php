<?php // Define database connection parameters
$username=$_POST["username"];
$password=$_POST["password"];
// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "mydb");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully to MySQL database.";

// Perform a query

$sql = "SELECT * FROM userdetails WHERE username='$username'";
$result = mysqli_query($conn, $sql);

// Process the query result

if(mysqli_num_rows($result)>0){
    echo "user already exists";
}
else{
    // we want to insert here
    $sql = "INSERT INTO userdetails (username, password) VALUES ('$username', '$password');";
    $result = mysqli_query($conn, $sql);
    echo "successful";
}

// Close the database connection
mysqli_close($conn);
?>