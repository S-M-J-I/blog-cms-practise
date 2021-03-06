<?php

include "secret.php";


// * This function will register a user
function registerUser()
{
    global $connection;
    if (isset($_POST["submit"])) {

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $first_name = mysqli_real_escape_string($connection, $first_name);
        $last_name = mysqli_real_escape_string($connection, $last_name);
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $password = hash_password($password);
        $role = "Subscriber";

        $query = $connection->prepare("INSERT INTO users(`username`, `password`, `first_name`, `last_name`, `email`, `role`) VALUES(?,?,?,?,?,?)");
        $query->bind_param("ssssss", $username, $password, $first_name, $last_name, $email, $role);
        $res = $query->execute() or die("Query Failed " . mysqli_error($connection));

        if ($res) {
            echo "<h5 style='color: green;'>User has been registered</h5>";
        }
    }
}


// * This function will print posts
function printPosts($row_value)
{
    global $connection;
    $content_preview = substr($row_value['content'], 0, 150);
    $author_id = $row_value['author'];
    $query = "SELECT * FROM users WHERE user_id=$author_id";
    $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));
    $author_id = mysqli_fetch_assoc($res)['username'];
    echo "
            <h2>
                <a href='/cms/post.php?id={$row_value['post_id']}'>{$row_value['title']}</a>
            </h2>
            <p class='lead'>
                by <a href='search.php?author={$row_value['author']}'>{$author_id}</a>
            </p>
            <p><span class='glyphicon glyphicon-time'></span> Posted on " . date_format(date_create($row_value['date']), "dS F, Y") . "</p>
            <hr>
            <img class='img-responsive' src='images/{$row_value['image']}' alt='' style='object-fit: cover;'>
            <hr>
            <p>{$content_preview}</p>
            <a class='btn btn-primary' href='post.php?id={$row_value['post_id']}'>Read More <span
                    class='glyphicon glyphicon-chevron-right'></span></a>
            <hr>
        ";
}

function displaySearchItems($search)
{
    global $connection;

    $query = "SELECT * FROM posts WHERE tags LIKE '%$search%' ORDER BY date DESC";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

    if ($result) {
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            echo "<h1>NO RESULT</h1>";
        } else {
            echo "<h1 class='page-header'>Found {$count} results for: <small>{$search}</small></h1>";
            while ($row = mysqli_fetch_assoc($result)) {
                printPosts($row);
            }
        }
    }
}


function displaySearchItemsByAuthor($search)
{
    global $connection;

    $query = "SELECT * FROM posts WHERE author=$search ORDER BY date DESC";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

    if ($result) {
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            echo "<h1>NO RESULT</h1>";
        } else {
            echo "<h1 class='page-header'>Found {$count} results for: <small>" . getUserById($search)["username"] . "</small></h1>";
            while ($row = mysqli_fetch_assoc($result)) {
                printPosts($row);
            }
        }
    }
}

function getPostsCount()
{
    global $connection;
    $query = "SELECT COUNT(*) num FROM posts";
    $result = mysqli_query($connection, $query) or die("Query Failed");

    return mysqli_fetch_assoc($result)["num"];
}



function getAllPaginationPosts()
{
    global $connection;
    // ? see recent posts first

    $page = "";
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }

    if ($page == "" || $page == 1) {
        $page_1 = 0;
    } else {
        $page_1 = ($page * 5) - 5;
    }

    $per_page = 5;

    $query = "SELECT * FROM posts ORDER BY date DESC LIMIT $page_1, $per_page";
    $result = mysqli_query($connection, $query) or die("Query Failed");

    while ($row = mysqli_fetch_assoc($result)) {
        echo printPosts($row);
    }
}

function getAllPosts()
{
    global $connection;
    // ? see recent posts first
    $query = "SELECT * FROM posts ORDER BY date DESC";
    $result = mysqli_query($connection, $query) or die("Query Failed");

    while ($row = mysqli_fetch_assoc($result)) {
        echo printPosts($row);
    }
}

function getPost($id)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id='$id'";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

    return mysqli_fetch_assoc($result);
}

function getUserById($id)
{
    global $connection;
    $query = "SELECT * FROM users WHERE user_id=$id";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

    return mysqli_fetch_assoc($result);
}



// * Gets all the approved comments of a post
function getAllComments($id)
{
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_post_id='$id' AND status='true' ORDER BY comment_date DESC";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($$connection));

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $commenter = getUserById($row['author']);
            echo "
            <div class='media'>
                <a class='pull-left' href='#'>
                    <img class='media-object' width='64px' src='./images/avatars/{$commenter['avatar']}' alt=''>
                </a>
                <div class='media-body'>
                    <h4 class='media-heading'>{$commenter['username']}
                    <small>" . date_format(date_create($row['comment_date']), "dS F, Y") . "</small>
                    </h4>
                    {$row['content']}
                </div>
            </div>
            ";
        }
    }
}

// * Post a comment
function postComment($post_id)
{
    global $connection;
    $user_id = $_SESSION['user_id'];

    $query = $connection->prepare("INSERT INTO comments(`comment_post_id`, `comment_date`, `author`, `content`) VALUES(?,?,?,?)");
    $query->bind_param("isis", $post_id, date("Y-m-d"), $user_id, $_POST['content']);
    $result = $query->execute() or die("Failed " . mysqli_error($connection));

    if ($result) {
        header("Location: post.php?id=$post_id");
    }
}
