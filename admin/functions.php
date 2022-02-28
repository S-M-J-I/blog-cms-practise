<?php

// * FOR categories.php

function getAllCategories()
{
    global $connection;
    // ? This code block prints all the categories in a tabular form
    $query = "SELECT * FROM categories ORDER BY id ASC";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['cat_title']}</td>
                <td><a href='categories.php?delete={$row['id']}'>Delete</a></td>
                <td><a href='categories.php?edit={$row['id']}'>Edit</a></td>
            </tr>
            ";
        }
    }
}


function insert_category()
{
    global $connection;
    // ? This statement adds a new the category
    if (isset($_POST['add'])) {
        $new_category = $_POST['cat_title'];

        if ($new_category == "") {
            echo "<b style='color: red;'>Category cannot be empty</b>";
            return;
        }

        $query = $connection->prepare("INSERT INTO categories (cat_title) VALUES (?)");
        $query->bind_param("s", $new_category);
        $result = $query->execute();

        if ($result) {
            // ? Refreshing pages in PHP
            $query->close();
            header("Location: categories.php");
        }
    }
}


function fetch_edit_name()
{
    global $connection;
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE id='$id'";
        $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

        $row = mysqli_fetch_assoc($result);
        $editName = $row['cat_title'];
        $editId = $row['id'];
    }
}


function edit_category()
{
    global $connection;
    // ? This function updates the category
    if (isset($_POST['update'])) {
        $cat_title = $_POST['cat_title'];
        $id = $_POST['id'];

        if ($cat_title == "") {
            echo "<b style='color: red;'>Category cannot be empty</b>";
            return;
        }

        $query = $connection->prepare("UPDATE categories SET cat_title=? WHERE id=?");
        $query->bind_param("si", $cat_title, $id);
        $result = $query->execute();

        if ($result) {
            $query->close();
            header("Location: categories.php");
        }
    }
}


function delete_category()
{
    global $connection;

    // ? This statement deletes the category
    if (isset($_GET['delete'])) {
        $delete = $_GET['delete'];
        $query = "DELETE FROM categories WHERE id='$delete'";
        $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

        if ($result) {
            // ? Refreshing pages in PHP
            header("Location: categories.php");
        }
    }
}





// * FOR posts.php

function getCategoryById($id)
{
    global $connection;
    $query = "SELECT * FROM categories WHERE id='$id'";
    $result = mysqli_query($connection, $query) or die("Query Failed");

    return mysqli_fetch_assoc($result)['cat_title'];
}

function getPostById($id)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id='$id'";
    $result = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    return $row = mysqli_fetch_assoc($result);
}

function createPost()
{
    global $connection;
    if (isset($_POST['add_post'])) {
        $category = $_POST['post_category_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];

        $temp = explode(".", $_FILES["image"]["name"]);
        $image = $author . '-' . $title . '.' . end($temp);
        $temp_image = $_FILES['image']['tmp_name'];

        $content = $_POST['content'];
        $date = date("Y-m-d");
        $tags = $_POST['tags'];

        move_uploaded_file($temp_image, "../images/$image");
        $query = $connection->prepare("INSERT INTO posts(`post_category_id`, `title`, `author`, `date`, `image`, `content`, `tags`) 
        VALUES (?,?,?,?,?,?,?)");
        $query->bind_param("issssss", $category, $title, $author, $date, $image, $content, $tags);
        $result = $query->execute();

        if ($result) {
            header("Location: posts.php");
        } else {
            echo "Something went wrong, couldn't add post";
        }
    }
}

function updatePost()
{
    global $connection;
    if (isset($_POST['edit_post'])) {
        $post_id = $_POST['post_id'];
        $category = $_POST['post_category_id'];
        $title = $_POST['title'];
        $author = $_POST['author'];

        $temp = explode(".", $_FILES["image"]["name"]);
        $image = $author . '-' . $title . '.' . end($temp);
        $temp_image = $_FILES['image']['tmp_name'];

        $content = $_POST['content'];
        $date = date("Y-m-d");
        $tags = $_POST['tags'];

        move_uploaded_file($temp_image, "../images/$image");
        $query = $connection->prepare(
            "UPDATE posts SET 
            post_category_id=?, 
            title=?, 
            author=?, 
            date=?,
            image=?,
            content=?,
            tags=?
            WHERE post_id=?
        "
        );
        $query->bind_param("issssssi", $category, $title, $author, $date, $image, $content, $tags, $post_id);
        $result = $query->execute();

        if ($result) {
            header("Location: posts.php");
        }
    }
}

function getAllCategoriesByName()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query) or die("Failed");

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            echo "<option value='$id'>{$row['cat_title']}</option>";
        }
    }
}

function getSelectCategoryById($idTarget)
{
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query) or die("Query Failed " . mysqli_error($connection));

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            if ($id == $idTarget) {
                echo "<option selected value='$id'>{$row['cat_title']}</option>";
            } else {
                echo "<option value='$id'>{$row['cat_title']}</option>";
            }
        }
    }
}

function getAllPostsInATable()
{
    global $connection;
    $query = "SELECT * FROM posts";
    $result = mysqli_query($connection, $query) or die("Query Failed");

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <tr>
                <td>{$row['post_id']}</td>
                <td>{$row['author']}</td>
                <td>{$row['title']}</td>
                <td>" . getCategoryById($row['post_category_id']) . "</td>
                <td><img width=100 class='img-responsive' src='../images/{$row['image']}' alt='post image' /></td>
                <td>{$row['tags']}</td>
                <td>{$row['comment_count']}</td>
                <td>{$row['date']}</td>
                <td>{$row['status']}</td>
                <td><a href='posts.php?source=edit_post&id={$row['post_id']}'>Edit</a></td>
                <td><a href='posts.php?source=delete_post&id={$row['post_id']}' style='color: red;'>Delete</a></td>
            </tr>
            ";
        }
    }
}


// * for comments.php
function getAllCommentsInATable()
{
    global $connection;

    $query = "SELECT * FROM comments";
    $result = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['comment_post_id'];
            $query = "SELECT * FROM posts WHERE post_id='$id'";
            $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

            $post = mysqli_fetch_assoc($res);
            echo "
                <tr>
                    <td>{$row['comment_id']}</td>
                    <td><a target='_blank' href='/cms/post.php?id={$post['post_id']}'>" . $post['title'] . "</a></td>
                    <td>{$row['author']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['content']}</td>
                    <td>{$row['comment_date']}</td>
                    <td>" .
                // ? toggling comment status
                toggleCase($row)
                . "</td>
                    <td><a href='comments.php?source=delete_comment&id={$row['comment_id']}' style='color: red;'>Delete</a></td>
                </tr>
            ";
        }
    }
}

function updateComment($id)
{
    global $connection;
    $query = $connection->prepare("UPDATE comments SET status='true' WHERE comment_id=?");
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Query Failed " . mysqli_error($connection));
    $query->close();

    if ($res) {
        $query = $connection->prepare("UPDATE posts SET comment_count=comment_count + 1 WHERE post_id=(SELECT comment_post_id FROM comments WHERE comment_id=?)");
        $query->bind_param("i", $id);
        $res = $query->execute() or die("Query Failed " . mysqli_error($connection));

        if ($res) {
            header("Location: comments.php");
        }
    }
}

function deleteComment($id)
{
    global $connection;
    $query = $connection->prepare("UPDATE posts SET comment_count=comment_count - 1 WHERE post_id=(SELECT comment_post_id FROM comments WHERE comment_id=?)");
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Query Failed " . mysqli_error($connection));
    $query->close();

    if ($res) {
        $query = $connection->prepare("DELETE FROM comments WHERE comment_id=?");
        $query->bind_param("i", $id);
        $res = $query->execute() or die("Query Failed " . mysqli_error($connection));
        $query->close();

        if ($res) {
            header("Location: comments.php");
        }
    }
}

function toggleCase($row)
{
    if ($row['status'] == "false") {
        return "<a href='comments.php?source=accept_comment&id={$row['comment_id']}'>Accept</a>";
    } else {
        return "<b style='color: green;'>Accepted</b>";
    }
}



// * dealing with user functions
function getAllUsersInATable()
{
    global $connection;
    $query = "SELECT * FROM users";
    $res = mysqli_query($connection, $query) or die("Query Failed" . mysqli_error($connection));

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "
                <tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['email']}</td>
                    <td><img width=100 class='img-responsive' src='../images/avatars/{$row['avatar']}' alt='user image' /></td>
                    <td><a href='users.php?source=delete_user&id={$row['user_id']}' style='color: red;'>Delete</a></td>
                </tr>
            ";
        }
    }
}


function addUser()
{
    global $connection;
    if (isset($_POST['add_user'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $temp = explode(".", $_FILES["avatar"]["name"]);
        $avatar = $_SESSION['user_id'] . '.' . end($temp);
        $temp_avatar = $_FILES['avatar']['tmp_name'];

        $role = $_POST['role'];


        move_uploaded_file($temp_avatar, "../images/avatars/$avatar");
        $query = $connection->prepare("INSERT INTO users(`username`, `password`,`first_name`, `last_name`, `email`, `avatar`, `role`) 
        VALUES (?,?,?,?,?,?,?)");
        $query->bind_param("sssssss", $username, $password, $first_name, $last_name, $email, $avatar, $role);
        $result = $query->execute();

        if ($result) {
            header("Location: users.php");
        } else {
            echo "Something went wrong, couldn't add post";
        }
    }
}


// * edit user
function editUser()
{
    global $connection;

    if (isset($_GET['target']) && (strcmp($_GET['target'], "details") == 0)) {
        $username = isset($_POST['username']) ? $_POST['username'] : $_SESSION['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $id = $_SESSION['user_id'];

        $query = $connection->prepare("UPDATE users SET username=?, email=?, password=? WHERE user_id=?");
        $query->bind_param("sssi", $username, $email, $password, $id);
        $res = $query->execute() or die("Query Failed" . mysqli_error($connection));

        // TODO: add image update as well

        if ($res) {
            header("Location: profile.php");
        } else {
            echo "<strong style='color: red;'>Couldn't update</strong>";
        }
    }

    if (isset($_GET['target']) && (strcmp($_GET['target'], "pfp") == 0)) {

        $temp = explode(".", $_FILES["avatar"]["name"]);
        $avatar = $_SESSION['user_id'] . '.' . end($temp);
        $temp_avatar = $_FILES['avatar']['tmp_name'];
        $id = $_SESSION['user_id'];

        move_uploaded_file($temp_avatar, "../images/avatars/$avatar");
        $query = $connection->prepare("UPDATE users SET avatar=? WHERE user_id=?");
        $query->bind_param("si", $avatar, $id);
        $res = $query->execute() or die("Query Failed" . mysqli_error($connection));

        // TODO: add image update as well

        if ($res) {
            header("Location: profile.php");
        } else {
            echo "<strong style='color: red;'>Couldn't update</strong>";
        }
    }
}



function deleteUser()
{
    global $connection;
    $id = $_GET['id'];
    $query = $connection->prepare("DELETE FROM users WHERE user_id=?");
    $query->bind_param("i", $id);
    $res = $query->execute() or die("Query Failed " . mysqli_error($connection));

    if ($res) {
        header("Location: users.php");
    }
}
