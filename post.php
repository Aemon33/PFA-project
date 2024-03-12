<?php
include 'partials/header.php';


// fetch post from database if id is set 
if(isset($_GET['id'])){
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE id=$id"; 
  $result = mysqli_query($connection , $query);
  $post = mysqli_fetch_assoc($result);

}else{

  header('location: '.ROOT_URL.'blog.php');
  die();
} 



?>



<section class="singlepost">
  <div class="container singlepost_container">
    <h2><?= $post['title'] ?></h2>
    <div class="post_seller">
          <?php
          
          // fetch seller from users table using the seller_id
          $seller_id = $post['seller_id'];
          $seller_query = "SELECT * FROM users WHERE id=$seller_id";
          $seller_result = mysqli_query($connection, $seller_query);
          $seller = mysqli_fetch_assoc($seller_result); 
          
          ?>
            <div class="post_seller-avatar">
              <img src="./Media/<?= $seller['avatar']?>" alt="">
            </div>
            <div class="post_seller-info">
            <h5>By: <?= "{$seller['first_name']} {$seller['last_name']} "?> </h5>
              <small><?= date("M d, Y - H:i" , strtotime($post['date_time']))?></small>
            </div>
          </div>
    <div class="singlepost_thumbnail">
      <img src="./Media/<?= $post['thumbnail']?>" height="167px" width="251px" alt="">
    </div>
    <p>
    <?= 
      $post['body']
      ?>    </p>
  </div>
</section>
<!-- end of single post -->


<?php
  
  include 'partials/footer.php'
  ?>


