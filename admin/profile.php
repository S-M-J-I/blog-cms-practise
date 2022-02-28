<?php include "components/header.php" ?>

<?php
$id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id=$id";
$res = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

if ($res) {
    $row = mysqli_fetch_assoc($res);
}
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "components/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <?php
                        $source;
                        if (isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }

                        switch ($source) {
                            case "edit_profile": {
                                    include "components/profile_components/update.php";
                                    break;
                                }

                            case "delete_profile": {
                                    include "components/profile_components/delete.php";
                                    break;
                                }

                            default: {
                                    include "components/profile_components/main.php";
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