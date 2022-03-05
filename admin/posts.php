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

                        <!-- TODO: fix the selection bug -->
                        <select name="bulk" id="bulk_select">
                            <option>Select</option>
                            <option id="draft" value="draft">By Draft</option>
                            <option id="comments" value="comments">By Comments</option>
                        </select>

                        <a class="btn btn-danger" href="posts.php">Reset</a>

                        <br>
                        <hr>

                        <?php
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }

                        switch ($source) {

                            case 'add_post': {
                                    include "components/post_components/add_post.php";
                                    break;
                                }

                            case 'edit_post': {
                                    include "components/post_components/edit_post.php";
                                    break;
                                }

                            case 'delete_post': {
                                    include "components/post_components/delete_post.php";
                                    break;
                                }

                            case 'filter': {
                                    include "components/post_components/filter_posts.php";
                                    break;
                                }

                            default: {
                                    include "components/post_components/view_all_posts.php";
                                    break;
                                }
                        }

                        ?>

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
        <script src="js/bulk-select.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
</body>

</html>