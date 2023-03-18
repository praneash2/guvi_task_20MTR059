
<?php
    require '../assets/vendor/autoload.php';
    $m = new MongoDB\Client("mongodb+srv://praneashk20mts:9442681811@cluster0.ntkkh0c.mongodb.net/test");// we can enclose this in a evn file for safety but as instructed the folders should not be added i mentioned it here itself
    $db=$m->my_db;
    $userdata=$db->userdata;
    $check=$_POST["check"];
    $redis = new Predis\Client();
    function session_info_redish(){
        $redis_server = 'localhost';
        $redis_port = 6379;

        $client = new Predis\Client([
            'scheme' => 'tcp',
            'host'   => $redis_server,
            'port'   => $redis_port,
        ]);

        ini_set('session.save_handler', 'redis');
        ini_set('session.save_path', "tcp://$redis_server:$redis_port");
        session_start();
        $_SESSION['userID'] = $ID;
        $currentTime = time();

        // Store the current time in the session
        $_SESSION['lastVisitTime'] = $currentTime;
        
        //print_r($_SESSION); //this will print the session in the window tab so dont uncomment it
    }
    //IMPORTANT
    //session_info_redish(); this is used to make the connection with redish server the reason that iam commenting this the dependance and redish should be running in the terminal otherwise it will give error and stop the whole process 
    
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
    
