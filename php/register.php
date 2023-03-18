    <?php 
    require '../assets/vendor/autoload.php';
    $m = new MongoDB\Client("mongodb+srv://praneashk20mts:9442681811@cluster0.ntkkh0c.mongodb.net/test");//the reason for using mongodb here is to store the id of mongodb in the sql id column
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
    $stmt = $conn->prepare("SELECT id FROM userdetails WHERE username like ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    $stmt->bind_result($res);
    if($stmt->num_rows>0){
        echo "0";
        
    }
    else{
        // we want to insert here
        $stmt2= $conn->prepare("INSERT INTO userdetails (id,username, password) VALUES (?,?, ?)");
        $stmt2->bind_param("sss", $ID,$username,$password);
        $stmt2->execute();
        
        echo "1";
        
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
?>