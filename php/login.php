<?php 
$username=$_POST["username"];
$password=$_POST["password"];
$conn = new mysqli("sql12.freemysqlhosting.net", "sql12606640", "MDDkzfZjq4", "sql12606640");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT id FROM userdetails WHERE username like ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

$stmt->bind_result($res);
if($stmt->num_rows>0){
    $stmt2= $conn->prepare("SELECT id FROM userdetails WHERE username like ? AND password like ?");
    $stmt2->bind_param("ss", $username,$password);
    $stmt2->execute();
    
    $stmt2->store_result();
    
    $stmt2->bind_result($id);
    if($stmt2->num_rows>0){
        
        
        while($stmt2->fetch()){
            $ID=''.$id.'';
        }
        echo "1,'{$ID}'";
    }
    else{
        echo "2,'{-1}'";
    }
    $stmt2->close();
}
else{
    echo "3,'{-1}'";
}


$stmt->close();
$conn->close();

?>