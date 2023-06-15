<?php
require_once '../database/Connection.php';
require_once '../includes/Sessions.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new \database\Connection();

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = pg_query($db->conn, $sql);

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        $storedPassword = $row['password'];

        if (password_verify($password, $storedPassword)) {
            $sn = new Includes\Sessions();

            $sn->sessionStart(900, '/', 'localhost', true, true);

            $_SESSION['username'] = $username;
            header("Location: ../public/index.php");
        } else {
            header("Location: ../public/login.php");
        }
    } else {
        header("Location: ../public/login.php");
    }

    pg_close($db->conn);
}
elseif (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    try {
        $db = new \database\Connection();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Users (username, password) VALUES ('$username', '$hashedPassword')";

        $result = pg_query($db->conn, $sql);
    } catch (Exception $exception){
        echo $exception;
    }


    if ($result) {
        header("Location: ../public/login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . pg_last_error($db->conn);
    }
    pg_close($db->conn);
}