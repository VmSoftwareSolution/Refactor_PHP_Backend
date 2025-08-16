-- Create role table
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(200)
);

INSERT INTO roles (name) VALUES ('cliente'), ('admin'); -- valores base

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role_id INT NOT NULL,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Create person table
CREATE TABLE persons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    gender ENUM('male','female','other') DEFAULT 'other',
    date_of_birth DATE,
    avatar VARCHAR(512),
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_user INT NOT NULL,
    CONSTRAINT fk_person_user FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    price INT NOT NULL,
    stock INT NOT NULL,
    category VARCHAR(100),
    image TEXT
);

CREATE TABLE shopping_car (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_person INT NOT NULL,
    total_price INT NOT NULL DEFAULT 0,
    products JSON NOT NULL,
    FOREIGN KEY (id_person) REFERENCES persons(id)
);

CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_person INT NOT NULL,
    products JSON NOT NULL,
    FOREIGN KEY (id_person) REFERENCES persons(id)
);

CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tittle VARCHAR(50) NOT NULL,
    message VARCHAR(200) NOT NULL,
    priority ENUM('low', 'medium', 'high') NOT NULL,
    status ENUM('open', 'in_progress', 'closed') NOT NULL,
    id_person INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_person) REFERENCES persons(id)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    products JSON NOT NULL,
    total_price INT NOT NULL DEFAULT 0
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('open', 'in_progress', 'closed') NOT NULL,
    id_person INT NOT NULL,
    FOREIGN KEY (id_person) REFERENCES persons(id)
);

CREATE TABLE shipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_order INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    status ENUM('pending', 'shipped', 'delivered') NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_order) REFERENCES orders(id)
);

CREATE TABLE payloads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_order INT NOT NULL,
    method ENUM('VISA', 'MASTERCARD', 'PAYPAL') NOT NULL,
    status ENUM('complete', 'in_progress', 'canceled') NOT NULL,
    payment_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_order) REFERENCES orders(id)
);