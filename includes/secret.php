<?php
function hash_password($password)
{
    global $connection;
    $query = "SELECT randSalt FROM users";
    $res = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($res);

    return crypt($password, $row["randSalt"]);
}
