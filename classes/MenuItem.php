<?php

class MenuItem {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT * FROM menu_items ORDER BY item_id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($category_id, $item_name, $description, $price, $stock_quantity, $status) {
        $query = "INSERT INTO menu_items (category_id, item_name, description, price, stock_quantity, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$category_id, $item_name, $description, $price, $stock_quantity, $status]);
    }

    public function update($item_id, $category_id, $item_name, $description, $price, $stock_quantity, $status) {
        $query = "UPDATE menu_items SET category_id = ?, item_name = ?, description = ?, price = ?, stock_quantity = ?, status = ? WHERE item_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$category_id, $item_name, $description, $price, $stock_quantity, $status, $item_id]);
    }

    public function delete($item_id) {
        $query = "DELETE FROM menu_items WHERE item_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$item_id]);
    }

    public function search($keyword) {
        $keyword = "%" . $keyword . "%";
        $query = "SELECT * FROM menu_items WHERE category_id LIKE ? OR item_name LIKE ? OR description LIKE ? OR price LIKE ? OR stock_quantity LIKE ? OR status LIKE ? ORDER BY item_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$keyword, $keyword, $keyword, $keyword, $keyword, $keyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>