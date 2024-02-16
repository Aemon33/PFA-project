<?php
require 'config/database.php';



if(isset($_POST['submit'])){
  // get updated form data
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $first_name = filter_var($_POST['first_name'] , FILTER_SANITIZE_SPECIAL_CHARS);
  $last_name = filter_var($_POST['last_name'] , FILTER_SANITIZE_SPECIAL_CHARS);
  $is_admin = filter_var($_POST['userrole'] , FILTER_SANITIZE_NUMBER_INT);


  // check for valid input
  if(!$first_name || !$last_name){
    $_SESSION['edit-user'] = "invalid form input on edit page" ;

  }else {
    // update user
    $query = "UPDATE users SET first_name = '$first_name' , last_name = '$last_name' , is_admin = $is_admin WHERE   id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);
    

    if(mysqli_errno($connection)){
      $_SESSION['edit-user'] = "failed to update user.";

    }else {
      $_SESSION['edit-user-success'] = "user $first_name $last_name updated successfully";
    }
  }

}
header ('location: ' . ROOT_URL . 'admin/manage_users.php');
die();