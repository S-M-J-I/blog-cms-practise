<?php include "components/header.php" ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "components/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>


                        <div class="col-xs-6">

                            <!-- Add Category form -->
                            <form action="categories.php" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Add Category:</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add" value="Add Category">
                                </div>
                            </form>
                            <?php insert_category(); ?>

                            <br>
                            <hr>
                            <br>

                            <!-- Update category form -->
                            <form action="categories.php" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Update Category:</label>
                                </div>
                                <div class="form-group">
                                    <?php

                                    if (isset($_GET['edit'])) {
                                        $id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE id='$id'";
                                        $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

                                        $row = mysqli_fetch_assoc($result);
                                        $editName = $row['cat_title'];
                                        $editId = $row['id'];
                                    }


                                    ?>
                                    <input class="form-control" type="text" name="cat_title" value="<?php if (isset($editName)) {
                                                                                                        echo $editName;
                                                                                                    } ?>">
                                    <input name="id" type="text" style="display: none;" value="<?php echo $editId; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                                </div>
                            </form>
                            <?php edit_category(); ?>
                        </div>




                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody><?php getAllCategories();
                                        delete_category(); ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

</body>

</html>