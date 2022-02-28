<?php

function printPosts($row_value)
{
    $content_preview = substr($row_value['content'], 0, 150);
    echo "
            <h2>
                <a href='/cms/post.php?id={$row_value['post_id']}'>{$row_value['title']}</a>
            </h2>
            <p class='lead'>
                by <a href='index.php'>{$row_value['author']}</a>
            </p>
            <p><span class='glyphicon glyphicon-time'></span> Posted on {$row_value['date']}</p>
            <hr>
            <img class='img-responsive' src='images/{$row_value['image']}' alt='' style='object-fit: cover;'>
            <hr>
            <p>{$content_preview}</p>
            <a class='btn btn-primary' href='#'>Read More <span
                    class='glyphicon glyphicon-chevron-right'></span></a>
            <hr>
        ";
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

// * Gets all the approved comments of a post
function getAllComments($id)
{
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_post_id='$id' AND status='true'";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($$connection));

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <div class='media'>
                <a class='pull-left' href='#'>
                    <img class='media-object' width='64px' src='./images/avatars/demo.png' alt=''>
                </a>
                <div class='media-body'>
                    <h4 class='media-heading'>{$row['author']}
                    <small>" . date_format(date_create($row['comment_date']), "F dS, Y") . "</small>
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
    echo $post_id;

    // TODO: change author later (insert into author as well)
    $mail = "jdoe@gmail.com";
    $query = $connection->prepare("INSERT INTO comments(`comment_post_id`, `comment_date`, `email`, `content`) VALUES(?,?,?,?)");
    $query->bind_param("isss", $post_id, date("Y-m-d"), $mail, $_POST['content']);
    $result = $query->execute() or die("Failed " . mysqli_error($connection));

    if ($result) {
        header("Location: post.php?id=$post_id");
    }
}
