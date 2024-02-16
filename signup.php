<?php
require 'config/constants.php';

// get back from data if ther was a registration error
$first_name = $_SESSION['signup-data']['first_name'] ?? null;
$last_name = $_SESSION['signup-data']['last_name']?? null;
$username = $_SESSION['signup-data']['username']?? null;
$email = $_SESSION['signup-data']['email']?? null;
$create_password = $_SESSION['signup-data']['create_password']?? null;
$confirm_password = $_SESSION['signup-data']['confirm_password']?? null;

// delete signup data session
unset($_SESSION['signup-data']);



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP & MySQL Blog Application With Admin Panel</title>
  <!-- style scheet -->
  <link rel="stylesheet" href="<?= ROOT_URL ?>CSS/style.css">
  <!-- mediaQ -->
  <link rel="stylesheet" href="<?= ROOT_URL ?>CSS/mediaQ.css">
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Carter+One&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:wght@400;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400&family=Roboto+Condensed:wght@300;400&family=Work+Sans:ital,wght@0,200;0,400;0,500;0,700;0,800;1,200&display=swap" rel="stylesheet">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body> 
<section class="form_section">
  <div class="container form_section-container">
    <h2>Sign Up</h2>
   <?php
   if(isset($_SESSION['signup'])) :?>
    <div class="alert_message error">
    <p><?= $_SESSION['signup'] ;
    unset($_SESSION['signup']) ;
   ?> </p>
  </div>
   <?php endif ?>
    <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST" >
      <input type="text" name="first_name" value="<?=$first_name?>" placeholder="First Name">
      <input type="text" name="last_name" value="<?=$last_name?>"  placeholder="Last  Name">
      <input type="text" name="username" value="<?=$username?>"  placeholder="Username">
      <input type="email" name="email"  value="<?=$email?>" placeholder="Email">
      <input type="password" name="create_password" value="<?=$create_password?>" placeholder="Create Password">
      <input type="password" name="confirm_password" value="<?=$confirm_password?>"  placeholder="Confirm Password">
      <div class="form_control">
        <label for="avatar">User Avatar</label>
        <input type="file"  name="avatar" id="avatar">
      </div>
<button type="submit" name="submit" class="btn"> Sign Up</button>
<small>Already have an account? <a href="signin.php">Sign In</a></small>
    </form>
  </div>
</section>

  
</body>
</html>





