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
