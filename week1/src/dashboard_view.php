<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
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

    $sql = "SELECT * FROM dashboard WHERE post_id = " . $_GET["post_id"];
    $post = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($post);

    echo "Title: <strong>" . htmlspecialchars($post['title']) . "</strong><br>";
    echo "Author: " . htmlspecialchars($post['id']) . "<br>";
    echo "Time: " . htmlspecialchars($post['time_']) . "<br><br>";
    echo "Content: " . htmlspecialchars($post['content']) . "<br><br>";
    echo '<a href="dashboard.php">Go back</a>';
?>
