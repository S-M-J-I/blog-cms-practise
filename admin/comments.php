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

                        <?php
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }

                        switch ($source) {

                            case "accept_comment": {
                                    updateComment($_GET['id']);
                                    break;
                                }

                            case "delete_comment": {
                                    deleteComment($_GET['id']);
                                    break;
                                }

                            default: {
                                    include "components/comments_components/view_all_comments.php";
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

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

</body>

</html>