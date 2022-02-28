<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <!-- Search bar -->
        <form action="../cms/search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>



    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <?php

                $query = "SELECT cat_title FROM categories";
                $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

                if ($result) {
                    $count = mysqli_num_rows($result);

                    if ($count == 0) {
                        echo "<li>No categories yet</li>";
                    } else {
                        echo "<ul class='list-unstyled'>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<li><a href='search.php?topic={$row['cat_title']}'>{$row['cat_title']}</a></li>";
                        }
                        echo "</ul>";
                    }
                }
                ?>
            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Login Widget Well -->
    <?php
    if (!isset($_SESSION['username'])) {
        include "widget.php";
    }
    ?>

</div>