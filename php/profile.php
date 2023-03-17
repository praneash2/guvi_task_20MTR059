
<?php
    require '../vendor/autoload.php';
    $m = new MongoDB\Client("mongodb://localhost:27017");
    $db=$m->my_db;
    $userdata=$db->userdata;
    $check=$_POST["check"];
    
    //echo "<p> {$name} {$email} ${age} ${college} ${department}</p>";
    function insert(){
        $name=$_POST["name"];
        $email=$_POST["email"];
        $age=$_POST["age"];
        $college=$_POST["college"];
        $department=$_POST["department"];
        global $userdata;
        $inserted_data=$userdata->insertOne(['name'=>$name,'email'=>$email,'age'=>$age,'college'=>$college,'department'=>$department]); 
        echo $inserted_data->getInsertedId();
    }
    
    
    function update(){
            global $userdata;
            $name=$_POST["name"];
            $email=$_POST["email"];
            $age=$_POST["age"];
            $college=$_POST["college"];
            $department=$_POST["department"];
   
            $ID=$_POST["id"];
            $filter = ['_id' => new MongoDB\BSON\ObjectID($ID)];

            $update = array('$set' => array("name" => $name,"email"=>$email,"age"=>$age,"college"=>$college,"department"=>$department));

            $options = array("upsert" => false);

            $result = $userdata->updateOne($filter, $update, $options);
            printf("Matched %d document(s) and updated %d document(s)\n", $result->getMatchedCount(), $result->getModifiedCount());
    }
    
    
    function read(){
        global $userdata;
        $ID=$_POST["id"];
        $filter = ['_id' => new MongoDB\BSON\ObjectID($ID)];
        $cursor = $userdata->find($filter);
        
        $results = array();

        // Loop through the result set and append each document to the results array
        foreach ($cursor as $document) {
            $results[] = $document;
        }

        // Convert the results array to JSON format
        $json = json_encode($results);

        // $json now contains the query results in JSON format
        echo $json; 
    }
    

    if($check=="1"){
        insert();
    }
    else if($check=="2"){
        read();
    }
    else if($check=="3"){
        update();
    }
?>
    
