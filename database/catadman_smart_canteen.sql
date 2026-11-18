CREATE DATABASE IF NOT EXISTS catadman_smart_canteen;

USE catadman_smart_canteen;

CREATE TABLE menu_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    item_name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    price DECIMAL(10,2),
    stock_quantity INT,
    status VARCHAR(30)
);

INSERT INTO menu_items
(category_id, item_name, description, price, stock_quantity, status)
VALUES
(1, 'Cheeseburger', 'Burger with cheese', 45.00, 20, 'Available');
