<?php
include 'partials/header.php';
?>
  
  <section class="empty_page">
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
  </section>  </section>
  <!-- start the footer  -->
  
  <?php
include 'partials/footer.php';
?>

