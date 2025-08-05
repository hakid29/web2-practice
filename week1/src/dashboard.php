<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        echo "Welcome, " . $_SESSION['user_id'] . "<br>";
    } else {
        header("Location: login.php"); // login한 상태에서만 dashboard에 접근 가능
    }

    // todo: 게시판
?>

<html>
    <head>
        <h1>Dashboard</h1>
    </head>
    <body>
            <a href="dashboard_post.php">
                <button type="button">Wirte a post</button><br><br>
            </a>
            <a href="index.php">Go back to home</a><br><br>
            <a href="logout.php">Logout</a>
        </form>
    </body>
</html>
