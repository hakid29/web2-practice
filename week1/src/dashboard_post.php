<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // 요청이 POST인 경우에 db에 등록
        // db 연결
        $host = getenv("DB_HOST");
        $user = getenv("MYSQL_USER");
        $password = getenv("MYSQL_PASSWORD");
        $db = getenv("MYSQL_DATABASE");
        $conn = mysqli_connect($host, $user, $password, $db);
        if (!$conn) {
            die("Server connect failed" . mysqli_connect_error());
        }

        // db에서 유저 정보 찾기
        $user = $_SESSION['user_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        // todo: 게시글에 id 인자 넣어야함 (나중에 글 목록 띄우려면)
        $sql = "INSERT INTO dashboard (id,title,content) VALUES ('$user', '$title', '$content')"; // timestamp는 알아서 드감
        if (mysqli_query($conn, $sql)) {
            echo "<h2>Post successful!</h2>";
            echo '<a href="dashboard.php">Go back to dashboard</a>';
        } else{
            echo "<h2>Post failed.</h2>";
        }
        exit();
    }
?>

<html>
    <head>
        <h1>Post</h1>
    </head>
    <body>
        <form action="dashboard_post.php" method="POST">
            <label for="title">Title: </label>
            <input type="text" name="title"><br><br> <!-- name을 key, 입력을 value로 POST request -->
            <label for="content">Content: </label><br>
            <textarea name="content" rows="5" cols="40"></textarea><br><br>
            <input type="submit"><br><br>
            <a href="dashboard.php">Go back to dashboard</a>
            <!-- todo: logout 기능 -->
        </form>
    </body>
</html>
