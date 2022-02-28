<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<?php
$id = $_GET['id'];
$post = getPost($id);
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?php echo $post['title'] ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#"><?php echo $post['author'] ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo date_format(date_create($post['date']), "F dS, Y"); ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src=<?php echo "images/" . $post['image']; ?> alt="thumbnail">

            <hr>

            <!-- Post Content -->
            <p class="lead"><?php echo substr($post['content'], 0, 150); ?></p>
            <p style="text-align: justify;"><?php echo $post['content']; ?></p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <?php
            if (isset($_POST['submit'])) {
                // TODO: solve comment posting issue
                postComment($id);
            }
            ?>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="post.php?id=<?php echo $id ?>" method="POST">
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3"></textarea>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php include "includes/comment.php" ?>


            <!-- Comment
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    Nested Comment
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                    End Nested Comment
                </div>
            </div> -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->



    <hr>

    <?php include "includes/footer.php" ?>