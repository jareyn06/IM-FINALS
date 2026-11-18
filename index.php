<?php

require_once("connection.php");
require_once("classes/MenuItem.php");

$record = new MenuItem($conn);
$edit_data = null;

if (isset($_GET["search"])) {
    $keyword = trim($_GET["keyword"] ?? "");
    $records = $record->search($keyword);
} else {
    $records = $record->getAll();
}

if (isset($_GET["edit"])) {
    $edit_id = $_GET["edit"];
    foreach ($records as $row) {
        if ($row["item_id"] == $edit_id) {
            $edit_data = $row;
            break;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Canteen Ordering System (SCOS)</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<div class="header-area">
<h1>Smart Canteen Ordering System (SCOS)</h1>
<p class="subtitle">Simple PHP PDO OOP CRUD System</p>
</div>

<div class="note">This simple version follows the Prelim's CRUD Menu Management feature and the MENU_ITEMS entity from the ERD.</div>

<?php if (isset($_GET["message"])): ?>
<div class="message">
<?php
if ($_GET["message"] == "added") echo "Record added successfully.";
if ($_GET["message"] == "updated") echo "Record updated successfully.";
if ($_GET["message"] == "deleted") echo "Record deleted successfully.";
?>
</div>
<?php endif; ?>

<div class="box">
<h2><?= $edit_data ? "Update Record" : "Add Record"; ?></h2>

<form action="handler.php" method="POST">
<?php if ($edit_data): ?>
<input type="hidden" name="item_id" value="<?= $edit_data["item_id"]; ?>">
<?php endif; ?>

<div class="form-grid">
<div>
<label>Category ID</label>
<input type="number" name="category_id" value="<?= htmlspecialchars($edit_data["category_id"] ?? ""); ?>">
</div><div>
<label>Item Name</label>
<input type="text" name="item_name" value="<?= htmlspecialchars($edit_data["item_name"] ?? ""); ?>">
</div><div>
<label>Description</label>
<input type="text" name="description" value="<?= htmlspecialchars($edit_data["description"] ?? ""); ?>">
</div><div>
<label>Price</label>
<input type="number" step="0.01" name="price" value="<?= htmlspecialchars($edit_data["price"] ?? ""); ?>">
</div><div>
<label>Stock Quantity</label>
<input type="number" name="stock_quantity" value="<?= htmlspecialchars($edit_data["stock_quantity"] ?? ""); ?>">
</div><div>
<label>Status</label>
<select name="status"><option value="">Select</option><option value="Available" <?= ($edit_data["status"] ?? "") == "Available" ? "selected" : ""; ?>>Available</option><option value="Low Stock" <?= ($edit_data["status"] ?? "") == "Low Stock" ? "selected" : ""; ?>>Low Stock</option><option value="Unavailable" <?= ($edit_data["status"] ?? "") == "Unavailable" ? "selected" : ""; ?>>Unavailable</option></select>
</div>
</div>

<?php if ($edit_data): ?>
<button type="submit" name="update_record" class="btn">Update</button>
<a href="index.php" class="cancel">Cancel</a>
<?php else: ?>
<button type="submit" name="add_record" class="btn">Add</button>
<?php endif; ?>
</form>
</div>

<div class="box">
<div class="table-header">
<h2>Records</h2>
<form method="GET" class="search">
<input type="text" name="keyword" placeholder="Search records" value="<?= htmlspecialchars($_GET["keyword"] ?? ""); ?>">
<button type="submit" name="search" class="btn">Search</button>
<a href="index.php" class="cancel">Clear</a>
</form>
</div>

<div class="table-container">
<table>
<thead>
<tr>
<th>ID</th>
<th>Category ID</th><th>Item Name</th><th>Description</th><th>Price</th><th>Stock Quantity</th><th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php foreach ($records as $row): ?>
<tr>
<td><?= $row["item_id"]; ?></td>
<td><?= htmlspecialchars($row["category_id"]); ?></td><td><?= htmlspecialchars($row["item_name"]); ?></td><td><?= htmlspecialchars($row["description"]); ?></td><td><?= htmlspecialchars($row["price"]); ?></td><td><?= htmlspecialchars($row["stock_quantity"]); ?></td><td><?= htmlspecialchars($row["status"]); ?></td>
<td class="actions">
<a href="index.php?edit=<?= $row["item_id"]; ?>" class="edit">Edit</a>

<form action="handler.php" method="POST" onsubmit="return confirm('Delete this record?');">
<input type="hidden" name="item_id" value="<?= $row["item_id"]; ?>">
<button type="submit" name="delete_record" class="delete">Delete</button>
</form>
</td>
</tr>
<?php endforeach; ?>

<?php if (count($records) == 0): ?>
<tr><td colspan="8">No record found.</td></tr>
<?php endif; ?>

</tbody>
</table>
</div>
</div>

</div>
</body>
</html>