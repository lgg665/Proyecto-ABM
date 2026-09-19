CREATE DATABASE IF NOT EXISTS abm_usuarios CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE abm_usuarios;

CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    role_id INT NOT NULL,
    CONSTRAINT fk_users_role
        FOREIGN KEY (role_id)
        REFERENCES roles(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO roles (name, description) VALUES
('Administrator', 'Full system access'),
('Editor', 'Content management'),
('User', 'Basic system access');

INSERT INTO users (first_name, last_name, username, email, role_id) VALUES
('Ana', 'García', 'anagarcia', 'ana@ejemplo.com', 1),
('Luis', 'Pérez', 'luisperez', 'luis@ejemplo.com', 2),
('María', 'López', 'marialopez', 'maria@ejemplo.com', 3);
