<?php 
include 'partials/header.php';
// get back form data  there was an error
$first_name = $_SESSION['add-user-data']['first_name'] ?? null;
$last_name = $_SESSION['add-user-data']['last_name']?? null;
$username = $_SESSION['add-user-data']['username']?? null;
$email = $_SESSION['add-user-data']['email']?? null;
$create_password = $_SESSION['add-user-data']['create_password']?? null;
$confirm_password = $_SESSION['add-user-data']['confirm_password']?? null;



// delete session data
unset($_SESSION['add-data-session']);

?>
<section class="form_section">
  <div class="container form_section-container">
    <h2>Add User</h2>
    <?php 
    if(isset($_SESSION['add-user']))  : ?>
    <div class="alert_message error">
      <p>
        <?=$_SESSION['add-user'];
        unset($_SESSION['add-user']);

        ?>
      </p>
    </div>
    <?php endif?>
    <form action="<?= ROOT_URL ?>admin/add_user-logic.php" enctype="multipart/form-data" method="POST" >
      <input type="text" name="first_name" value="<?= $first_name?>" placeholder="First Name">
      <input type="text" name="last_name" value="<?= $last_name?>" placeholder="Last  Name">
      <input type="text" name="username" value="<?= $username?>" placeholder="Username">
      <input type="email" name="email" value="<?= $email?>" placeholder="Email">
      <input type="passwoed" name="create_password" value="<?= $create_password?>" placeholder="Create Password">
      <input type="passwoed" name="confirm_password" value="<?= $confirm_password?>" placeholder="Confirm Password">
      <select  name="userrole" >
        <option value="0">Seller</option>
        <option value="1">Admin</option>
      </select>
      <div class="form_control">
        <label for="avatar">User Avatar</label>
        <input type="file" name="avatar"  id="avatar">
      </div>
<button type="submit" class="btn" name="submit"> Add User</button>
    </form>
  </div>
</section>
  
<?php
 include '../partials/footer.php';
?>