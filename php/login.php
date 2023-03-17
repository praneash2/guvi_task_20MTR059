<?php 
$username=$_POST["username"];
$password=$_POST["password"];

// Create a database connection
$conn = mysqli_connect("sql12.freemysqlhosting.net", "sql12606640", "MDDkzfZjq4", "sql12606640");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully to MySQL database.";

$sql = "SELECT * FROM userdetails WHERE username='$username'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    $sql = "SELECT * FROM userdetails WHERE username='$username' and  password='$password'";
    $result = mysqli_query($conn, $sql);
    $id="-1";
    while ($row = mysqli_fetch_assoc($result)) {
        
        $id= '' . $row['id'] . '';
        
        
    }
    
    if(mysqli_num_rows($result)>0){
        
        
        echo "1,'{$id}'"; //eco 1 means user is authenticated
    }
    else{
       
        
        echo "2,'{-1}'"; // eco 2 means password is wrong
    }
    
}
else{
    
    echo "3,'{-1}'"; //accound does not exits
}

mysqli_close($conn);
?>