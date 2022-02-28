<div class="col-xs-6">

    <!-- Add Post form -->
    <form action="users.php?source=add_user" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="author">First Name:</label>
            <input class="form-control" type="text" name="first_name">
        </div>
        <div class="form-group">
            <label for="author">Last Name:</label>
            <input class="form-control" type="text" name="last_name">
        </div>
        <div class="form-group">
            <label for="title">Email:</label>
            <input class="form-control" type="text" name="email" placeholder="Write your email here">
        </div>
        <div class="form-group">
            <label for="post_category_id">Username:</label>
            <input class="form-control" type="text" name="username" placeholder="Write your username here">
        </div>
        <div class="form-group">
            <label for="content">Role:</label>
            <select class="form-control" name="role">
                <option value="Admin">Admin</option>
                <option value="Subscriber">Subscriber</option>
            </select>
        </div>
        <div class="form-group">
            <label for="author">Password:</label>
            <input class="form-control" type="password" name="password">
        </div>
        <div class="form-group">
            <label for="image">Avatar:</label>
            <input class="form-control" type="file" name="avatar">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
        </div>
    </form>
    <?php addUser(); ?>
</div>