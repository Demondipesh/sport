<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$logged_in_user = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$sql_posts = "SELECT posts.id, posts.description, posts.image, posts.uploaded_by, posts.player_name, posts.created_at, users.fullname 
              FROM posts
              JOIN users ON posts.uploaded_by = users.username
              WHERE posts.uploaded_by != '$logged_in_user' 
              ORDER BY posts.created_at DESC";

$result_posts = $conn->query($sql_posts);
?>

<div class="flex gap-1 w-full p-2">
    <div class="hidden sm:flex flex-col gap-2 w-1/5 p-1">
        <?php
            require_once("./components/MatchList.php")
        ?>
    </div>
    <div class="flex w-4/5 p-2">

        <div class="main">
            <?php
            if ($result_posts->num_rows === 0) {
                echo '<p>No posts are available currently. Please check back later.</p>';
            } else {
                while ($row_posts = $result_posts->fetch_assoc()) {
                    $postId = $row_posts['id'];
                    $postDescription = $row_posts['description'];
                    $postImage = $row_posts['image'];
                    $postCreatedAt = $row_posts['created_at'];
                    $postFoodName = $row_posts['player_name'];
                    $postUploadedByFullName = $row_posts['fullname']; // Fetched full name from query result


                    // Get like count for this post
                    $sql_likes = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = '$postId'";
                    $result_likes = $conn->query($sql_likes);
                    $like_count = ($result_likes->num_rows > 0) ? $result_likes->fetch_assoc()['like_count'] : 0;

                    // Get comment count for this post
                    $sql_comments = "SELECT COUNT(*) AS comment_count FROM comments WHERE post_id = '$postId'";
                    $result_comments = $conn->query($sql_comments);
                    $comment_count = ($result_comments->num_rows > 0) ? $result_comments->fetch_assoc()['comment_count'] : 0;
            ?>
                    <div class="post">
                        <img src="postspic/<?php echo $postImage; ?>" alt="Post Image">
                        <p><strong>PlayerName:</strong> <a href="viewpost.php?post_id=<?php echo $postId; ?>"><?php echo $postFoodName; ?></a></p>
                        <p><strong>Posted by:</strong> <?php echo $postUploadedByFullName; ?></p>
                        <p><strong>Description:</strong> <?php echo $postDescription; ?></p>
                        <p><strong>Posted on:</strong> <?php echo $postCreatedAt; ?></p>

                        <!-- Like and Comment section for each post -->
                        <div class="actions-section">
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <form action="like-post.php" method="post" class="like-form">
                                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                                    <button type="submit">Like</button>
                                    <span class="like-count"><?php echo $like_count; ?> likes</span>
                                </form>
                                <form action="add-comment.php" method="post" class="comment-form" name="commentForm">
                                    <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                                    <textarea name="comment" placeholder="Leave a comment"></textarea>
                                    <span id="commentError" style="color: red;"></span> <!-- Display error messages -->
                                    <button type="submit">Submit Comment</button>
                                </form>


                                <span class="comment-count"><?php echo $comment_count; ?> comments</span>
                            <?php } else { ?>
                                <p><a href="login.php">Log in</a> to like and comment on this post.</p>
                            <?php } ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
</div>