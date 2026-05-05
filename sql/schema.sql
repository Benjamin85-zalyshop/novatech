CREATE DATABASE IF NOT EXISTS novatech_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE novatech_store;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category ENUM('Ordinateurs','Imprimantes','Accessoires') NOT NULL,
    description TEXT,
    price DECIMAL(12,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    address TEXT NOT NULL,
    total_amount DECIMAL(12,2) NOT NULL,
    currency VARCHAR(10) DEFAULT 'GNF',
    country VARCHAR(100) DEFAULT 'Guinée',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(12,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO admins (username, password_hash) VALUES
('admin', '$2y$12$.TWTge4P5BL4ievBt4qV3eBnACqx9CgHh2aUsNmFXR70eECuGhL2S');

INSERT INTO products (name, category, description, price) VALUES
('HP ProBook 450', 'Ordinateurs', 'PC portable Intel Core i5, 8Go RAM, SSD 512Go', 8500000),
('Dell Inspiron Desktop', 'Ordinateurs', 'Desktop bureautique performant', 7200000),
('Canon Pixma G3410', 'Imprimantes', 'Imprimante multifonction économique', 2900000),
('HP LaserJet M111w', 'Imprimantes', 'Imprimante laser Wi-Fi', 3400000),
('Clavier mécanique RGB', 'Accessoires', 'Clavier gaming rétroéclairé', 550000),
('Souris sans fil Logitech', 'Accessoires', 'Souris ergonomique et précise', 320000);
