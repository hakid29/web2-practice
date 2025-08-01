<?php
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
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM users WHERE id = '$username'";
        if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
            echo "Already registered ID<br><br>";
            echo '<a href="register.php">Try again</a>';
            exit();
        }

        $register_sql = "INSERT INTO users (id, pw) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $register_sql)) {
            echo "<h2>Registration successful!</h2>";
            echo '<a href="index.php">Go back to home</a>';
        } else{
            echo "<h2>Registration failed.</h2>";
        }
        exit();
    }
?>

<html>
    <head>
        <h1>Register</h1>
    </head>
    <body>
        <form action="register.php" method="POST">
            <label for="username">ID: </label>
            <input type="text" name="username"><br><br>
            <label for="password">PW: </label>
            <input type="password" name="password"><br><br>
            <input type="submit"><br><br>
            <a href="index.php">Go back to home</a>
        </form>
    </body>
</html>
