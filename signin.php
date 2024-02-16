<?php
require 'config/constants.php';
// they use this to get the data back when some error occur while filling the data 
$username_email = $_SESSION['signin-data']['username_email']?? null;
$password  = $_SESSION['signin-data']['password']?? null;

unset($_SESSION['signin-data']);
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
  <h2>Sign In</h2>

    <?php if(isset($_SESSION['signup-success']))  :?>
      <div class="alert_message success">
      <p>
        <?= $_SESSION['signup-success'];
        unset($_SESSION['signup-success']);
        ?>
      </p>
    </div>
    <?php elseif(isset($_SESSION['signin'])): ?>
      <div class="alert_message error">
      <p>
        <?= $_SESSION['signin'];
        unset($_SESSION['signin']);
        ?>
      </p>
    </div>
    <?php endif ?>
    <form action="<?= ROOT_URL ?>signin-logic.php"  method="POST" >
    
      <input type="password" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">
      <input type="password" name="password" value="<?= $password ?>" placeholder="Password">
<button type="submit" name="submit" class="btn"> Sign In</button>
<small>Don't have an account? <a href="signup.php">Sign Up</a></small>
    </form>
  </div>
</section>

  
</body>
</html>