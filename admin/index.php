<?php 
include 'partials/header.php';


// fetch  current user's posts from the database
$current_user_id = $_SESSION['user-id'];
$query  = "SELECT id, title, category_id FROM posts  WHERE seller_id = $current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
?>
<section class="dashboard">

<?php if(isset($_SESSION['add-post-success'])) :   // shows if add post was  not successful
  ?>
    <div class="alert_message success container">
      <p>
        <?= $_SESSION['add-post-success'];
        unset($_SESSION['add-post-success']);
        ?>
      </p>
    </div>
<?php elseif(isset($_SESSION['edit-post-success'])) :   // shows if edit post was  not successful
  ?>
    <div class="alert_message success container">
      <p>
        <?= $_SESSION['edit-post-success'];
        unset($_SESSION['edit-post-success']);
        ?>
      </p>
    </div>
<?php elseif(isset($_SESSION['edit-post'])) :   // shows if edit post was  not successful
  ?>
    <div class="alert_message error container">
      <p>
        <?= $_SESSION['edit-post'];
        unset($_SESSION['edit-post']);
        ?>
      </p>
    </div>
    <?php elseif(isset($_SESSION['delete-post-success'])) :   // shows if delete post was  not successful
  ?>
    <div class="alert_message success container">
      <p>
        <?= $_SESSION['delete-post-success'];
        unset($_SESSION['delete-post-success']);
        ?>
      </p>
    </div>
    <?php endif ?>


  <div class="container dashboard_container">
    <butoon id="show_sidebar-btn" class="sidebar_toggle"><i class="fa-solid fa-chevron-right"></i></butoon>
    <butoon id="hide_sidebar-btn" class="sidebar_toggle"><i class="fa-solid fa-chevron-left"></i></butoon>
    <aside>
      <ul>
        <li><a href="add_post.php"><i class="fa-solid fa-pen"></i> 
        <h5>Add Post</h5>
        </a></li>
        <li><a href="index.php" class="active"><i class="fa-regular fa-address-card"></i>
        <h5>Manage Posts</h5>
        </a></li>
        <?php 
        if(isset($_SESSION['user_is_admin'])):
        ?>
        <li><a href="add_user.php"><i class="fa-solid fa-user-plus"></i>
        <h5>Add User</h5>
        </a></li>
        <li><a href="manage_users.php" ><i class="fa-solid fa-user-group"></i>
        <h5>Manage User</h5>
        </a></li>
        <li><a href="add_category.php"><i class="fa-solid fa-pen-to-square"></i>
        <h5>Add Category</h5>
        </a></li>
        <li><a href="manage_categories.php" ><i class="fa-solid fa-list"></i>
        <h5>Manage Categories</h5>
        </a></li>
        <?php endif?>
      </ul>
    </aside>
    <main>
<h1>Manage Posts</h1>
<?php 
if (mysqli_num_rows($posts) > 0) :?>
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Category</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php while($post = mysqli_fetch_assoc($posts)) : ?>
    <!-- get category title of each post from categories table  -->
    <?php  
    $category_id = $post['category_id'];
    $category_query = "SELECT title FROM categories WHERE id=$category_id";
    $category_result = mysqli_query($connection, $category_query);
    $category = mysqli_fetch_assoc($category_result);
    ?>
    <tr>
      <td><?= $post['title'] ?></td>
      <td><?= $category['title'] ?></td>
      <td><a href="<?= ROOT_URL ?>admin/edit_post.php?id=<?= $post['id'] ?>" class="btn sn">Edit</a></td>
      <td><a href="<?= ROOT_URL ?>admin/delete_post.php?id=<?= $post['id'] ?>" class="btn sn danger">Delete</a></td>
    </tr>
    <?php endwhile ?>
   
  </tbody>
</table>
<?php else :?>
  <div class="alert_message error"><?= 'No posts Found' ?></div>
  <?php endif ?>

    </main>
  </div>
</section>
<?php
 include '../partials/footer.php'
 
 ?> 