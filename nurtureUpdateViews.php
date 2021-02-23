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
      $statement = $connection->pdo->prepare("UPDATE post SET views=? WHERE id=?");
      
      $statement2 = $connection->pdo->prepare("SELECT * FROM post WHERE id = :id");

      $statement2->bindParam(":id", $_POST['id'], PDO::PARAM_STR);

      $statement2->execute();

      $allPosts = $statement2->fetchAll(PDO::FETCH_NUM);
      
      $newViews = 0;
      
      foreach($allPosts as $post)
      {
         $newViews += $post[4];
       }
       
      $newViews += 1;

      $statement->execute([intval($newViews), $_POST["id"]]);

      $statement = null;

      
      #return the jsonified data to the client
      echo json_encode(["UPDATED"=> "SUCCESSFUL"]);
    }
    catch (Exception $e){
      #return the jsonified data to the client
      echo json_encode(["UPDATED"=> "FAILED"]);
    }
  }
  else
  {
    echo json_encode([["error"=> "Connection To Server Failed!"]]);
  }

  $connector->closeConnection();
?>