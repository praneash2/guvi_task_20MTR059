<?php 
require '../vendor/autoload.php';
$m = new MongoDB\Client("mongodb://localhost:27017");//the reason for using mongodb here is to store the id of mongodb in the sql id column
$db=$m->my_db;
$userdata=$db->userdata;

$username=$_POST["username"];
$password=$_POST["password"];
$ID="0";
function insert(){
    
    global $username;
    global $userdata;
    global $ID;
    $inserted_data=$userdata->insertOne(['username'=>$username]); 
    $ID=$inserted_data->getInsertedId();
}
insert();
//echo $ID;
// Create a database connection
$conn = mysqli_connect("sql12.freemysqlhosting.net", "sql12606640", "MDDkzfZjq4", "sql12606640");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully to MySQL database.";

// Perform a query

$sql = "SELECT * FROM userdetails WHERE username='$username'";
$result = mysqli_query($conn, $sql);

// Process the query result

if(mysqli_num_rows($result)>0){
    echo "0";
    
}
else{
    // we want to insert here
    $sql = "INSERT INTO userdetails (id,username, password) VALUES ('$ID','$username', '$password');";
    $result = mysqli_query($conn, $sql);
    echo "1";
    
}

// Close the database connection
mysqli_close($conn);
?>