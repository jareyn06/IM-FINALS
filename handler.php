<?php

require_once("connection.php");
require_once("classes/MenuItem.php");

$record = new MenuItem($conn);

if (isset($_POST["add_record"])) {
    $category_id = $_POST["category_id"] ?? "";
    $item_name = trim($_POST["item_name"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $price = $_POST["price"] ?? "";
    $stock_quantity = $_POST["stock_quantity"] ?? "";
    $status = trim($_POST["status"] ?? "");
    $record->add($category_id, $item_name, $description, $price, $stock_quantity, $status);
    header("Location: index.php?message=added");
    exit();
}

if (isset($_POST["update_record"])) {
    $item_id = $_POST["item_id"];
    $category_id = $_POST["category_id"] ?? "";
    $item_name = trim($_POST["item_name"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $price = $_POST["price"] ?? "";
    $stock_quantity = $_POST["stock_quantity"] ?? "";
    $status = trim($_POST["status"] ?? "");
    $record->update($item_id, $category_id, $item_name, $description, $price, $stock_quantity, $status);
    header("Location: index.php?message=updated");
    exit();
}

if (isset($_POST["delete_record"])) {
    $item_id = $_POST["item_id"];
    $record->delete($item_id);
    header("Location: index.php?message=deleted");
    exit();
}

?>