<?php
session_start();
session_destroy();
unset($_COOKIE['user_id']);
setcookie('user_id', null, -1, '/');
unset($_COOKIE['username']);
setcookie('username', null, -1, '/');
unset($_COOKIE['first_name']);
setcookie('first_name', null, -1, '/');
unset($_COOKIE['last_name']);
setcookie('last_name', null, -1, '/');
unset($_COOKIE['role']);
setcookie('role', null, -1, '/');
header("Location: /cms");
