<?php 

require 'config/database.php';

if (isset($_GET['id'])) {  

  $id = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT);
  // fetch user from database
  $query = "SELECT * FROM users WHERE id = $id";
  $result = mysqli_query($connection, $query);
  $user = mysqli_fetch_assoc($result);

  // make sure we got back only one user 
  if(mysqli_num_rows($result)==1){
    $avatar_name = $user['avatar'];
    $avatar_path = '../Media/' . $avatar_name;
    // delete image if it's availabe
    echo $avatar_path ;
    if($avatar_path){
      unlink($avatar_path);
    }
  }
  // FOR LATER 
  // fetch all thumbnails of user's posts and delete them

  $thumbnails_query = "SELECT thumbnail FROM posts WHERE seller_id = $id";
  $thumbnail_result = mysqli_query($connection, $thumbnails_query);
  if(mysqli_num_rows($thumbnail_result)>0){
    while($thumbnail = mysqli_fetch_assoc($thumbnail_result)){
      $thumbnail_path  ='../Media/'.$thumbnail['thumbnail'];
      // delete thumbnail from Media folder is exist 
      if($thumbnail_path){
        unlink($thumbnail_path);
      }
    }
  }
  // delete user from database
  $delete_user_query  =  "DELETE FROM users WHERE id = $id";
  $delete_user_result = mysqli_query($connection, $delete_user_query);
  if(mysqli_errno($connection)){
    $_SESSION['delete-user'] = "Couldn't  delete {$user['first_name']} {$user['last_name']}";
  } else {
    $_SESSION['delete-user-success'] = "{$user['first_name']} {$user['last_name']} deleted successfully";

  }

  
}

header ('location: '. ROOT_URL . 'admin/manage_users.php');
die();

