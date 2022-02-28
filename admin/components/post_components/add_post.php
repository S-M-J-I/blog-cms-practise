<div class="col-xs-6">

    <!-- Add Post form -->
    <form action="posts.php?source=add_post" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post_category_id">Post Category ID:</label>
            <select class="form-control" name="post_category_id">
                <?php getAllCategoriesByName(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input class="form-control" type="text" name="title" placeholder="Write your post title here">
        </div>
        <div class="form-group">
            <label for="author">Author:</label>
            <input class="form-control" type="text" name="author">
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input class="form-control" type="file" name="image">
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" cols="30" rows="10" type="text" name="content" placeholder="Write your post content here"></textarea>
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <input class="form-control" type="text" name="tags" placeholder="Write your post tags">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="add_post" value="Publish Post">
        </div>
    </form>
    <?php createPost(); ?>
</div>