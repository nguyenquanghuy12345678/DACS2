-- Create the database
CREATE DATABASE book_db;

-- Use the newly created database
USE book_db;

-- Create the book_form table
CREATE TABLE book_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    location VARCHAR(100) NOT NULL,
    guests INT NOT NULL,
    arrivals DATE NOT NULL,
    leaving DATE NOT NULL
);

-- Insert sample data into the book_form table
INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) VALUES 
('John Doe', 'john.doe@example.com', '1234567890', '123 Elm Street', 'New York', 2, '2024-11-10', '2024-11-15'),
('Jane Smith', 'jane.smith@example.com', '0987654321', '456 Maple Avenue', 'Los Angeles', 4, '2024-12-01', '2024-12-05'),
('Alice Johnson', 'alice.j@example.com', '5551234567', '789 Oak Lane', 'Chicago', 1, '2024-11-20', '2024-11-22'),
('Bob Brown', 'bob.brown@example.com', '4443210987', '321 Pine Road', 'Houston', 3, '2024-12-10', '2024-12-15');