<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- First Blog Post -->
            <?php

            if (isset($_GET['topic'])) {
                $search = $_GET['topic'];
                displaySearchItems($search);
            } else if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                displaySearchItems($search);
            } else if (isset($_GET['author'])) {
                $search = $_GET['author'];
                displaySearchItemsByAuthor($search);
            }

            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php" ?>