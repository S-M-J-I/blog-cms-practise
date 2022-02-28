<?php

$id = $_GET['id'];

$query = $connection->prepare("DELETE FROM posts WHERE post_id=?");
$query->bind_param("i", $id);

$query->execute();

header("Location: posts.php");
