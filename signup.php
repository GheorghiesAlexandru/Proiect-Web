<?php
$db = new SQLite3('useri.db');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM useri WHERE username = '$username'";
    $result = $db->query($query);
    if ($result->fetchArray()) {
        echo "Utilizatorul exista.";
    } else {
        $insertQuery = "INSERT INTO useri (username, password) VALUES ('$username', '$password')";
        if ($db->exec($insertQuery)) {
            header("Location: login.html");
            exit;
        } 
    }
}
?>
