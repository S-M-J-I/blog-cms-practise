<?php
function hash_password($password)
{
    $hashformat = "$2y$10$";
    $salt = "verycrazystring1234567";
    $hashformat_and_salt =  $hashformat . $salt;

    return crypt($password, $hashformat_and_salt);
}
