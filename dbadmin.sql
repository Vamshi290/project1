-- SQL to create the admin table
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert an admin user with a hashed password (you can run this via PHPMyAdmin or your MySQL client)
INSERT INTO admin (username, password) VALUES 
('admin', '$2y$10$Wl8D6V1C0gtQ1u2QnHbN1v4.3qbgQ2czFcdFSU0fC9V1VFeaBQH.');  -- Hashed password: admin123
