<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Enter username">
        </div>
        <div class="form-group">
            <input name="password" type="password" class="form-control" placeholder="Enter password">
        </div>
        <div class="form-group">
            <button name="login" class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
    <?php
    if (isset($_SESSION['valid'])) {
        if (!$_SESSION['valid']) {
            echo "<h6 style='color: red;'><b>Invalid username or password</b></h6>";
            unset($_SESSION['valid']);
        }
    }
    ?>
</div>