<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>


<?php
if (isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['first_name'] = $_COOKIE['first_name'];
    $_SESSION['last_name'] = $_COOKIE['last_name'];
    $_SESSION['role'] = $_COOKIE['role'];
}
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?php getAllPaginationPosts(); ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <ul class="pager">

        <?php
        $count = ceil($count / 5);
        for ($i = 1; $i <= $count; ++$i) {
            if ($i == $_GET["page"]) {
                echo "<li ><a class='active_link' href='index.php?page=$i'>$i</a></li>";
            } else {
                echo "<li><a href='index.php?page=$i'>$i</a></li>";
            }
        }
        ?>

    </ul>

    <?php include "includes/footer.php" ?>