<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        echo "Welcome, " . $_SESSION['user_id'] . "<br>";
    }
?>

<html>
    <head>
        <h1>Dashboard</h1>
    </head>
    <body>
        <form action="dashboard.php" method="POST">
            <label for="title">Title: </label>
            <input type="text" name="title"><br><br>
            <label for="content">Content: </label><br>
            <textarea name="content" rows="5" cols="40"></textarea><br><br>
            <input type="submit"><br><br>
            <a href="index.php">Go back to home</a>
            <!-- todo: logout 기능 -->
        </form>
    </body>
</html>
