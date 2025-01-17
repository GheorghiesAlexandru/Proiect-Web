<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    header("Location: mainpage.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    try {
        $conn = new PDO('sqlite:produse.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO produse (nume, pret) VALUES (:name, :price)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':name', $product_name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $product_price, PDO::PARAM_INT);

        $stmt->execute();
        header("Location: mainpage.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
