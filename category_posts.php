<?php
include 'partials/header.php';

// fetch posts if id is set 
if( isset($_GET['id'])){
  $id = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE category_id = $id ORDER BY date_time DESC";
  $posts = mysqli_query($connection, $query);

}else {
  header('location:' . ROOT_URL . 'blog.php');
  die();
}


?>

  <!-- start the navbar -->
  <header class="category_title">
<h2>
<?php 
      // fetch category from categories table using category_id of post
      $category_id = $id;
      $category_query = "SELECT * FROM  categories WHERE  id = $id";
      $catgeory_result = mysqli_query($connection, $category_query);
      $category = mysqli_fetch_assoc($catgeory_result);
      echo $category['title']
      ?>
</h2>
</header>
<!-- start posts  -->
<?php if(mysqli_num_rows($posts)>0) :  ?>
<section class="posts">
    <div class="container posts_container">
      <?php while($post = mysqli_fetch_assoc($posts)):?>

      <article class="post">
        <div class="post_thumbnail">
          <img src="./Media/<?= $post['thumbnail']?>" height="167px" width="251px" alt="">
        </div>
        <div class="post_info">
       

          <h3 class="post_title">
            <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id']?>"><?= $post['title']?></a></h3>
          <p class="post_body">
          <?= substr($post['body'], 0, 150) ?>...
          </p>
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
        </div>

      </article>
      <?php endwhile ?>
      
    </div>
  </section>
  <?php else :?>
    <div class="alert_message error lg">
      <p>No posts found for this category</p>
    </div>
    <?php endif ?>



<!-- end of posts -->
<!-- start of category buttons -->
<section class="category_buttons">
    <div class="container category_buttons-container">
      <?php 
      $all_categories_query = "SELECT  * FROM categories";
      $all_categories = mysqli_query($connection, $all_categories_query )
      ?>
      <?php while($category = mysqli_fetch_assoc($all_categories)):?>
      <a href="<?= ROOT_URL?>category_posts.php?id=<?= $category['id'] ?>" class="category_button"><?= $category['title']?></a>
      <?php endwhile ?>
    
    </div>
  </section>
<!-- end of category buttons -->
<?php
include 'partials/footer.php';
?>


