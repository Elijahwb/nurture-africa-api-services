<?php
    $allPosts = file_get_contents("https://damgroup.000webhostapp.com/getNurturePosts.php");
    $allUsers = file_get_contents("https://damgroup.000webhostapp.com/getNurtureUsers.php");

    $allPosts = json_decode($allPosts);
    $allUsers = json_decode($allUsers);

    unset($allPosts[0]);
    unset($allUsers[0]);

    $totalViews = 0;

    foreach($allPosts as $post){
        $totalViews = $totalViews + $post->views;
    }
?>