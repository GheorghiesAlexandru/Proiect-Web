<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AffordableBags</title>
    <link rel="stylesheet" href="mainpage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header class="menu">
        <div class="stanga">
            <a href="siteulmeu.html"><h1>AffordableBags</h1></a>
        </div>
        <div class="mesajClient">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</div>
        <div class="logoutCart">
        <form action="logout.php" method="POST">
        <button class="btn btn-danger" type="submit" style="margin-right:70px;">Logout</button>
        </form>
        <div class="shoppingcart"  onclick="openCart()"></div>
        </div>
    </header>
    <div class="admin-options" style="padding-top:100px;">
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <h2>Admin Panel</h2>
        <form action="addProduct.php" method="POST">
            <input type="text" name="product_name" placeholder="Product Name" required>
            <input type="number" name="product_price" placeholder="Price (€)" required>
            <button class="btn btn-success" type="submit">Add Product</button>
        </form>
        <form action="deleteProduct.php" method="POST">
            <input type="text" name="product_name" placeholder="Product Name to Delete" required>
            <button class="btn btn-danger" type="submit">Delete Product</button>
        </form>
    <?php endif; ?>
</div>
    <main>
    <div class="wrapper">
    <?php
try {
    function rowCount() {
        $db = new PDO('sqlite:produse.db');
        
        $tableName = 'produse'; 
        
        $stmt = $db->query("SELECT COUNT(*) FROM $tableName");
        
        $count = $stmt->fetchColumn();
        
        $db = null;
        
        return $count;
    }
    
    echo "Numărul de rânduri este: " . rowCount();
    $conn = new PDO('sqlite:produse.db');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM produse";
    $stmt = $conn->query($sql);
    $i=rowCount();
    if (rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="shadow">';
            echo '<h1>' . htmlspecialchars($row['nume']) . '</h1>';
            echo '<p>' . number_format($row['pret'], 2) . '€</p>';
            echo '<button class="btn btn-secondary" onclick="adaugaCos(\'' . addslashes($row['nume']) . '\', ' . $row['pret'] . ')">Add to cart</button>';
            echo '</div>';
        }
    } else {
        echo '<p>No products available.</p>';
    }
} catch (PDOException $e) {
    echo "Eroare la conectarea bazei de date: " . $e->getMessage();
}
?>
        
    </div>
    <div class="cartbox">
        <h2>Shopping Cart</h2>
        <ul id="cart-items"></ul>
        <p id="total-price">Total: €0</p>
    </div>
</main>
</body>
<script src="mainpageJS.js"></script>
</html>
