<?php
  header("Access-Control-Allow-Origin: *");
  
  header("Content-Type:application/json");

  include("nurtureConnection.php");


  $serverConnector = new ServerConnection();

  $connector = $serverConnector->connectToServer();

  $connection = $connector->openConnection();

  if($connection->message == "CONNECTION SUCCESSFUL")
  {
    $statement = $connection->pdo->prepare("SELECT * FROM post");

    $statement->execute();

    $allPosts = $statement->fetchAll(PDO::FETCH_NUM);

    $postsArray = [];

    if(count($allPosts) > 0){
      array_push($postsArray, ["valid"=> "TRUE"]);
      foreach($allPosts as $post)
      {
         array_push($postsArray, array("id"=> $post[0],"author"=> $post[1],"info"=> $post[2],"image"=> $post[3],"views"=> intval($post[4])));
       }
    }
    else
    {
      array_push($postsArray, ["valid"=> "FALSE"]);
    }
    #return the jsonified data to the client
    echo json_encode($postsArray);
  }
  else
  {
    echo json_encode([["error"=> "Connection To Server Failed!"]]);
  }

  $connector->closeConnection();
?>
