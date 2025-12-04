<?php
require_once 'config.php';

$message = '';
$messageType = '';
$editProduct = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productCode = $_POST['productCode'];
    $product = $_POST['product'];
    $qty = $_POST['qty'];
    $perPrice = $_POST['perPrice'];

    if (isset($_POST['update_id']) && !empty($_POST['update_id'])) {

        $id = $_POST['update_id'];
        $sql = "UPDATE products SET product_code = ?, product_name = ?, quantity = ?, price = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$productCode, $product, $qty, $perPrice, $id])) {
            header("Location: index.php?success=updated");
            exit();
        } else {
            $message = "Error updating product.";
            $messageType = "error";
        }
    } else {
        $sql = "INSERT INTO products (product_code, product_name, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$productCode, $product, $qty, $perPrice])) {
            header("Location: index.php?success=added");
            exit();
        } else {
            $message = "Error adding product.";
            $messageType = "error";
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$id])) {
        header("Location: index.php?success=deleted");
        exit();
    }
}

if (isset($_GET['success'])) {
    switch ($_GET['success']) {
        case 'added':
            $message = "Product added successfully!";
            $messageType = "success";
            break;
        case 'updated':
            $message = "Product updated successfully!";
            $messageType = "success";
            break;
        case 'deleted':
            $message = "Product deleted successfully!";
            $messageType = "success";
            break;
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $editProduct = $stmt->fetch(PDO::FETCH_ASSOC);
}

$sql = "SELECT * FROM products ORDER BY id DESC";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD APPLICATION</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="main-container">
        <div class="content-header">
            <h1>Product Inventory System</h1>
        </div>
        <div class="content">
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $messageType; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php" autocomplete="off">
                <?php if ($editProduct): ?>
                    <input type="hidden" name="update_id" value="<?php echo $editProduct['id']; ?>">
                <?php endif; ?>

                <div class="card">
                    <label for="productCode">Product Code</label>
                    <input type="text" name="productCode" id="productCode" 
                            placeholder="Enter Product Code" 
                            value="<?php echo $editProduct ? htmlspecialchars($editProduct['product_code']) : ''; ?>" 
                            required>
                </div>

                <div class="card">
                    <label for="product">Product Name</label>
                    <input type="text" name="product" id="product" 
                            placeholder="Enter Product Name" 
                            value="<?php echo $editProduct ? htmlspecialchars($editProduct['product_name']) : ''; ?>" 
                            required>
                </div>

                <div class="card">
                    <label for="qty">Product Quantity</label>
                    <input type="number" name="qty" id="qty" 
                            placeholder="Enter Product Quantity" 
                            value="<?php echo $editProduct ? $editProduct['quantity'] : ''; ?>" 
                            required min="1">
                </div>

                <div class="card">
                    <label for="perPrice">Product Price</label>
                    <input type="number" name="perPrice" id="perPrice" 
                            placeholder="Enter Product Price" 
                            value="<?php echo $editProduct ? $editProduct['price'] : ''; ?>" 
                            required min="0" step="0.01">
                </div>

                <div class="form-buttons">
                    <?php if ($editProduct): ?>
                        <a href="index.php" class="btn btn-reset">Cancel</a>
                    <?php else: ?>
                        <button type="reset" class="btn btn-reset">Reset</button>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-submit">
                        <?php echo $editProduct ? 'Update Product' : 'Add Product'; ?>
                    </button>
                </div>
            </form>

            <div class="product-list-content">
                <h2>Product List</h2>
                <?php if (count($products) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['product_code']); ?></td>
                                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                                    <td><?php echo $product['quantity']; ?></td>
                                    <td>₱<?php echo number_format($product['price'], 2); ?></td>
                                    <td>₱<?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="index.php?edit=<?php echo $product['id']; ?>" class="btn-edit">Edit</a>
                                            <a href="index.php?delete=<?php echo $product['id']; ?>" 
                                                class="btn-delete" 
                                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <p>No products added yet</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>