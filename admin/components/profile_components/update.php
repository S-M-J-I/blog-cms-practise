<h1 class="page-header">
    <strong>Update Profile</strong>
</h1>

<div class="col-xs-6">
    <form action="profile.php?source=edit_profile&target=pfp" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="avatar">New Profile Picture:</label>
            <input class="form-control" type="file" name="avatar" placeholder="Your new avatar">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_profile_picture" value="Edit">
        </div>
    </form>
</div>

<div class="col-xs-6">
    <form action="profile.php?source=edit_profile&target=details" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input class="form-control" type="text" name="username" placeholder="Your new username">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="text" name="email" placeholder="Your new email">
        </div>

        <div class="form-group">
            <label for="password">New Password:</label>
            <input class="form-control" type="password" name="password" placeholder="Your new password">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_profile" value="Edit Profile">
        </div>
    </form>
    <?php if (isset($_POST['edit_profile']) || isset($_POST['edit_profile_picture'])) {
        editUser();
    } ?>
</div>