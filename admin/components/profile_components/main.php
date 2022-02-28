<h1 class="page-header">
    <strong>User Profile</strong>
</h1>

<div class="col-xs-6">
    <img src="../images/avatars/<?php echo $row['avatar'] ?>" width="300" alt="">
</div>

<div class="col-xs-6">
    <h3><strong>Name:</strong> <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h3>
    <h3><strong>Username:</strong> <?php echo $row['username'] ?></h3>
    <h3><strong>Email:</strong> <?php echo $row['email'] ?></h3>
    <h3><strong>Role:</strong> <?php echo $row['role'] ?></h3>
    <div class="form-group">
        <a class="btn btn-primary" href="profile.php?source=edit_profile">Update</a>
    </div>
    <div class="form-group">
        <a class="btn btn-danger" href="profile.php?source=delete_profile">Delete</a>
    </div>
</div>