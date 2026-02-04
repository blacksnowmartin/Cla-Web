-- Create the database
CREATE DATABASE IF NOT EXISTS cla_db;
USE cla_db;

-- Users table for login and signup
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contacts table for contact form
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories table for product categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    original_price DECIMAL(10,2),
    image VARCHAR(255),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Insert categories
INSERT INTO categories (name) VALUES ('Desktops'), ('Laptops'), ('Accessories');

-- Insert sample products from desc.txt (assuming all are desktops)
INSERT INTO products (name, price, original_price, image, category_id) VALUES
('Dell Vostro 3910 Intel Core i7 12th Gen Desktop with 8 GB RAM, 1 TB HDD & 20-Inch Monitor', 96000, 105000, 'images/Dell-vostro-3910.png', 1),
('Dell Vostro 3910 Desktop – Intel Core i5-12400, 4GB RAM, 1TB HDD, Ubuntu OS, 20-inch Display Monitor', 80000, 88000, 'images/Dell-vostro-3910-4gb-ram.png', 1),
('HP Pro Tower 290 G9 Desktop PC – Intel Core i3-12100, 4GB DDR4 3200, 1TB SATA HDD, FreeDOS, HP 125 Wired Keyboard & Mouse', 64000, 75000, 'images/HP-Pro-tower.png', 1),
('Lenovo IdeaCentre 5 Desktop – AMD Ryzen 5 4600G, 8GB RAM, 512GB SSD, Windows 11, 23.8-inch FHD Monitor', 85000, 95000, 'images/Lenovo-IdeaCentre-5.png', 1),
('Acer Aspire TC Desktop – Intel Core i7-10700, 16GB RAM, 1TB SSD, Windows 10 Pro, 24-inch Monitor', 110000, 120000, 'images/Acer-Aspire-TC.png', 1),
('ASUS ROG Strix GL10CS Gaming Desktop – Intel Core i5-9400F, 8GB RAM, 256GB SSD + 1TB HDD, NVIDIA GTX 1660, Windows 10', 120000, 130000, 'images/ASUS-ROG-Strix-GL10CS.png', 1);