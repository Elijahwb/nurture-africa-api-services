<?php
    
    header("Access-Control-Allow-Origin: *");
  
    header("Content-Type:application/json");

    include("nurtureConnection.php");
  
    $serverConnector = new ServerConnection();
  
    $connector = $serverConnector->connectToServer();
  
    $connection = $connector->openConnection();
  
    if($connection->message == "CONNECTION SUCCESSFUL")
    {
  
      try
      {
      //file upload path
          $targetDir = "nurtureImages/";
          $fileName = basename($_FILES["image"]["name"]);
          $targetFilePath = $targetDir . $fileName;
          $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
          
          //allow certain file formats
          $allowTypes = array('jpg','png','jpeg');
          //upload file to server
          if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
              
          }else{
              echo "Sorry, there was an error uploading your file.";
          }
          
          $photoUrl = "https://damgroup.000webhostapp.com/". $targetFilePath;
              
        $statement = $connection->pdo->prepare("INSERT INTO post (author, information, imageurl, views) VALUES (?,?,?,?)");
  
        $statement->execute([$_POST['author'],$_POST['information'],$photoUrl,intval(0)]);
  
        $statement = null;
  
        #return the jsonified data to the client
        header('location: https://damgroup.000webhostapp.com');
      }
      catch (Exception $e){
        #return the jsonified data to the client
        echo json_encode(["REGISTERED"=> "FAILED"]);
      }
    }
    else
    {
      echo json_encode([["error"=> "Connection To Server Failed!"]]);
    }
  
    $connector->closeConnection();
  
?>