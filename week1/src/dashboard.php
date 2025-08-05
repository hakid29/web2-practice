<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        echo "Welcome, " . $_SESSION['user_id'] . "<br>";
    } else {
        header("Location: login.php");
    }

    $host = getenv("DB_HOST");
    $user = getenv("MYSQL_USER");
    $password = getenv("MYSQL_PASSWORD");
    $db = getenv("MYSQL_DATABASE");
    $conn = mysqli_connect($host, $user, $password, $db);
    if (!$conn) {
        die("Server connect failed" . mysqli_connect_error());
    }

    $sql = "SELECT * FROM dashboard ORDER BY time_ DESC"; // 최신 게시글이 위에 오도록 정렬
    $posts = mysqli_query($conn, $sql);
?>

<html>
    <head>
        <h1>Dashboard</h1>
    </head>
    <body>
        <h2>Posts</h2>
        <?php foreach ($posts as $post): ?>
            <div>
                <strong><?= htmlspecialchars($post['title'])?></strong> |
                Author: <?= htmlspecialchars($post['id'])?> |
                Time: <?= htmlspecialchars($post['time_'])?><br>
                <?= '<a href="dashboard_view.php?post_id='.$post["post_id"].'">view detail</a><br><br>'?>
                -------------------------------------------------------------------------
            </div>
        <?php endforeach; ?>
            <a href="dashboard_post.php">
                <button type="button">Wirte a post</button><br><br>
            </a>
            <a href="index.php">Go back to home</a><br><br>
            <a href="logout.php">Logout</a>
    </body>
</html>
