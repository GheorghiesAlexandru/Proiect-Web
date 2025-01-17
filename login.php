<?php
session_start();
$db = new SQLite3('useri.db');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM useri WHERE username = '$username'";
    $result = $db->query($query);
    $user = $result->fetchArray();
    if ($user) {
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: mainpage.php");
            exit;
        } else {
            echo "Username sau parola incorecte.";
        }
    } else {
        echo "Nu exista utilizatorul.";
    }
}
?>
