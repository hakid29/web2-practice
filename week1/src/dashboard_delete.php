<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }

    // echo $_POST['post_id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = getenv("DB_HOST");
        $user = getenv("MYSQL_USER");
        $password = getenv("MYSQL_PASSWORD");
        $db = getenv("MYSQL_DATABASE");
        $conn = mysqli_connect($host, $user, $password, $db);
        if (!$conn) {
            die("Server connect failed" . mysqli_connect_error());
        }

        $sql = "DELETE FROM dashboard WHERE post_id = " . $_POST['post_id'];
        if (mysqli_query($conn, $sql)) {
            echo "<h2>Delete successful!</h2>";
            echo '<a href="dashboard.php">Go back to dashboard</a>';
        } else{
            echo "<h2>Delete failed.</h2>";
        }
    }
    exit();

?>
