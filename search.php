<?php include "includes/header.php" ?>

<!-- A function to handle the search items in this page -->
<?php

function displaySearchItems($search)
{
    global $connection;

    $query = "SELECT * FROM posts WHERE tags LIKE '%$search%' ORDER BY date DESC";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

    if ($result) {
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            echo "<h1>NO RESULT</h1>";
        } else {
            echo "<h1 class='page-header'>Found {$count} results for: <small>{$search}</small></h1>";
            while ($row = mysqli_fetch_assoc($result)) {
                printPosts($row);
            }
        }
    }
}

?>


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
            }

            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php" ?>