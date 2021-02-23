<?php
  header("Access-Control-Allow-Origin: *");
  
  header("Content-Type:application/json");

  include("nurtureConnection.php");


  $serverConnector = new ServerConnection();

  $connector = $serverConnector->connectToServer();

  $connection = $connector->openConnection();

  if($connection->message == "CONNECTION SUCCESSFUL")
  {
    $statement = $connection->pdo->prepare("DELETE FROM user WHERE id = :id");

    $statement->bindParam(":id", $_GET['id'], PDO::PARAM_STR);

    $statement->execute();

    #return the jsonified data to the client
    header("location: ./deleteAccount.php");
  }
  else
  {
    echo json_encode([["error"=> "Connection To Server Failed!"]]);
  }

  $connector->closeConnection();
?>
