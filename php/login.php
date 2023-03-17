<?php 
$username=$_POST["username"];
$password=$_POST["pwd"];
// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "mydb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully to MySQL database.";

$sql = "SELECT * FROM userdetails WHERE username='$username'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $sql = "SELECT * FROM userdetails WHERE password='$password'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        echo "user_logged";
    }
    else{
        echo "password error";
    }
    
}
else{
    echo "account not exits";
}

mysqli_close($conn);
?>