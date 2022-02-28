<?php include "db.php" ?>
<?php session_start(); ?>
<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($res) {
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['role'] = $row['role'];

                if (isset($_SESSION['valid'])) {
                    unset($_SESSION['valid']);
                }

                if ($row['role'] != "Admin") {
                    header("Location: /cms");
                } else {
                    header("Location: /cms/admin");
                }
            }
        } else {
            $_SESSION['valid'] = false;
            header("Location: /cms");
        }
    }
}
