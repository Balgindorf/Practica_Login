CREATE DATABASE IF NOT EXISTS hokworks CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE hokworks;



-- Tabla de usuarios

CREATE TABLE users (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(50) NOT NULL UNIQUE,

    email VARCHAR(100) NOT NULL UNIQUE,

    password_hash VARCHAR(255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_email (email)

) ENGINE=InnoDB;



-- Tabla para tokens de recuperación de contraseña

CREATE TABLE password_resets (

    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    email VARCHAR(100) NOT NULL,

    token VARCHAR(64) NOT NULL UNIQUE,

    expires_at DATETIME NOT NULL,

    used TINYINT(1) NOT NULL DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_email_token (email, token),

    FOREIGN KEY (email) REFERENCES users(email) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB;