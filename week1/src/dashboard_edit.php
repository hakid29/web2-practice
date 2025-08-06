<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }

    // db 연결
    $host = getenv("DB_HOST");
    $user = getenv("MYSQL_USER");
    $password = getenv("MYSQL_PASSWORD");
    $db = getenv("MYSQL_DATABASE");
    $conn = mysqli_connect($host, $user, $password, $db);
    if (!$conn) {
        die("Server connect failed" . mysqli_connect_error());
    }

    $sql = "SELECT * FROM dashboard WHERE post_id = " . $_GET["post_id"];
    $post = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($post);
    if ($post['id'] != $_SESSION['user_id']) {
        echo "No permission<br><br>";
        echo '<a href="dashboard.php">Go back to dashboard</a>';
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_SESSION['user_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "UPDATE dashboard SET title = '$title', content = '$content', time_ = CURRENT_TIMESTAMP WHERE id = '$user'";
        if (mysqli_query($conn, $sql)) {
            echo "<h2>Edit successful!</h2>";
            echo '<a href="dashboard.php">Go back to dashboard</a>';
        } else{
            echo "<h2>Edit failed.</h2>";
        }
        exit();
    }
?>

<html>
    <head>
        <h1>Edit</h1>
    </head>
    <body>
        <form action="dashboard_edit.php" method="POST">
            <label for="title">Title: </label>
            <input type="text" name="title"><br><br> <!-- name을 key, 입력을 value로 POST request -->
            <label for="content">Content: </label><br>
            <textarea name="content" rows="5" cols="40"></textarea><br><br>
            <input type="submit" value="Edit"><br>
        </form>

        <form action="dashboard_delete.php" method="POST">
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($_GET['post_id']) ?>"> <!-- 삭제할 글의 post_id 넘기기 -->
            <input type="submit" value="Delete"><br><br>
            <a href="dashboard.php">Go back to dashboard</a>
        </form>
    </body>
</html>
