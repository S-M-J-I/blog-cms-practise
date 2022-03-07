<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Sign Up</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="first_name" class="sr-only">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="John">
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="sr-only">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Desired Doe">
                            </div>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

    <?php registerUser() ?>

    <hr>



    <?php include "includes/footer.php"; ?>