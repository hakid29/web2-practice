<?php
    session_start(); // PHPSESSID가 브라우저 쿠키에 난수 형태로 저장됨
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // 요청이 POST인 경우에 db에 등록 진행
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
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM users WHERE id = '$username' AND pw = '$password'";
        if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
            $_SESSION['user_id'] = $username;
            header("Location: dashboard.php"); // login 성공 시 세션 설정하고 dashboard로 redirect
        } else {
            echo "Login failed<br><br>";
            echo '<a href="login.php">Try again</a>';
        }
        exit();
    }
?>

<html>
    <head>
        <h1>Login</h1>
    </head>
    <body>
        <form action="login.php" method="POST">
            <label for="username">ID: </label>
            <input type="text" name="username"><br><br>
            <label for="password">PW: </label>
            <input type="password" name="password"><br><br>
            <input type="submit"><br><br>
            <a href="index.php">Go back to home</a>
        </form>
    </body>
</html>
