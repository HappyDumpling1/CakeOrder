
CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    Customer VARCHAR(100) NOT NULL,
    DeliveryDate DATE,
    PaymentStatus ENUM('Pending', 'Paid', 'Cancelled') DEFAULT 'Pending'
);
