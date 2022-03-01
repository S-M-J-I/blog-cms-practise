<?php

if (!isset($_POST['edit_post'])) {
    $id = $_GET['id'];
    $post = getPostById($id);
} else {
    updatePost();
}

?>

<div class="col-xs-6">

    <!-- Add Post form -->
    <form action="posts.php?source=edit_post" method="POST" enctype="multipart/form-data">
        <input type="text" style="display: none;" name="post_id" value=<?php echo $post['post_id'] ?>>
        <div class="form-group">
            <label for="post_category_id">Post Category ID:</label>
            <select class="form-control" name="post_category_id">
                <?php getSelectCategoryById($post['post_category_id']); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input class="form-control" type="text" name="title" placeholder="Write your post title here" value=<?php echo $post['title'] ?>>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <img width="100" src="../images/<?php echo $post['image'] ?>" alt="">
            <input class="form-control" type="file" name="image" value=<?php echo $post['image'] ?>>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" cols="30" rows="10" type="text" name="content" placeholder="Write your post content here"><?php echo $post['content'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <input class="form-control" type="text" name="tags" placeholder="Write your post tags" value=<?php echo $post['tags'] ?>>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
        </div>
    </form>
</div>