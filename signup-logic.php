<?php
require 'config/database.php';
// get signup form data if signup button is clicked
if(isset($_POST['submit'])){
  $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $avatar = $_FILES['avatar'];

  // validate inputs values
  if(!$first_name) {
    $_SESSION['signup'] = 'please enter your First Name';
  }
  elseif(!$last_name){
    $_SESSION['signup'] = 'please enter yourLast Name';

  }
  elseif(!$username){
    $_SESSION['signup'] = 'please enter your username';

  }
  elseif(!$email){
    $_SESSION['signup'] = 'please enter a valid Email';

  }
  elseif(strlen($create_password) < 8 || strlen($confirm_password) <8){
    $_SESSION['signup'] = 'password sould be 8+ characters';
  }
  elseif(!$avatar['name']){
    $_SESSION['signup'] = 'please add avatar';

  }
  else {
    // check if passwords dont' match
    if($create_password !== $confirm_password){
      $_SESSION['signup'] = 'passwords do not match';
    }
    else {
      // hash password
      $hashed_password = password_hash($create_password,PASSWORD_DEFAULT);
     
      // check if username or email already exist in the database
      $user_check_query = "SELECT * FROM users WHERE user_name = '$username' OR email='$email'";
      $user_check_result = mysqli_query($connection,$user_check_query);
      if(mysqli_num_rows($user_check_result) > 0){
        $_SESSION['signup'] = "Username or Email already exist";
      } else {
         // work on avatar
        // rename avatar
        $time = time();  // make each image unique using current timestamp
        $avatar_name = $time . $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $avatar_destination_path = 'Media/'.$avatar_name;
        // make sure file is an image
        $allowed_files=['png','jpg','jpeg'];
        $extention = explode ('.', $avatar_name);
        $extention = end($extention);
        if(in_array($extention , $allowed_files)){
          // make sure that the image isn't too large
          if($avatar['size'] < 1000000){
            // upload avatar
            move_uploaded_file($avatar_tmp_name , $avatar_destination_path );
          } else {
            $_SESSION['signup'] = 'File size too big. should be less than 1mb';
          }
        }else {
          $_SESSION['signup'] = "file should be png, jpg or jpeg";
        }
      }
  }
}


// redirect back to sign pag if there was any problem
if(isset($_SESSION['signup'])){
  // pass form data back to signup page
  $_SESSION['signup-data'] = $_POST;
  header ('location:' .ROOT_URL . 'signup.php');
  die();
} else {
  // insert new user into users table
  $insert_user_query = "INSERT INTO users (first_name , last_name,user_name ,email , password , avatar,is_admin)
   VALUES('$first_name','$last_name','$username','$email','$hashed_password','$avatar_name', 0)";
   
  $insert_user_result = mysqli_query($connection, $insert_user_query);


   if(!mysqli_error($connection)){
    // redirect to login page with success message
    $_SESSION['signup-success'] = "registration successful , Please log in";
    header ('location:'.ROOT_URL.'signin.php' );
    die();
   }
}

}else {
  // if button wasn't clicked , bounce back to signup page
  header('location: ' . ROOT_URL . 'signup.php');
  die();
}