<?php
require 'config/database.php';
// fetch current user from database
if(isset($_SESSION['user-id'])){
  $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT avatar FROM users WHERE id=$id";
  $result = mysqli_query($connection , $query);
  $avatar = mysqli_fetch_assoc($result);
}
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
  <!-- start the navbar -->
  <nav>
    <div class="container nav_container">
      <a href="<?= ROOT_URL ?>" class="nav_logo">FTTmarket</a>
      <ul class="nav_items">
        <li><a href="<?= ROOT_URL ?>blog.php">Market</a></li>
        <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
        <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
        <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
        <?php if(isset($_SESSION['user-id'])) : ?>
        <li class="nav_profile">
          <div class="avatar">
            <img src="<?= ROOT_URL. 'Media/'.$avatar['avatar']?>"   >
          </div>
          <ul>
            <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
            <li><a href="<?= ROOT_URL ?>logout.php">Logout</a></li>
          </ul>
        </li>
        <?php else : ?>
        <li><a href="<?= ROOT_URL ?>signin.php">Signin</a></li>
        <?php  endif ?>

      </ul>
      <button id="open_nav-btn"><i class="fa-solid fa-bars"></i></button>
      <button id="close_nav-btn"><i class="fa-solid fa-xmark"></i></button>
    </div>

  </nav>

  <!-- end of the navbar -->