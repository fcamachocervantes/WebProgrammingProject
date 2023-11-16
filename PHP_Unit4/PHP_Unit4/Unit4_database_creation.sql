use fcamachocervantes;

DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS product;

CREATE TABLE customer (
    id int NOT NULL AUTO_INCREMENT,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE product (
    id int NOT NULL AUTO_INCREMENT,
    product_name varchar(255),
    image_name varchar(255),
    price decimal(6,2),
    in_stock int,
    PRIMARY KEY (id)
);

CREATE TABLE orders (
    id int NOT NULL AUTO_INCREMENT,
    product_id int,
    customer_id int,
    quantity int,
    price decimal(6,2),
    tax decimal(6,2),
    donation decimal(4,2),
    time_stamp bigint,
    PRIMARY KEY (id),
    FOREIGN KEY (product_id) REFERENCES product(id),
    FOREIGN KEY (customer_id) REFERENCES customer(id)
);

INSERT INTO customer (first_name, last_name, email) VALUES
('Francisco', 'Camacho', 'fcamachocervantes@mines.edu'),
('Eric', 'Dattore', 'edattore@mines.edu'),
('Mickey', 'Mouse', 'mmouse@mines.edu');

INSERT INTO product (product_name, image_name, price, in_stock) VALUES
('Clicky', 'NK_Cream_LaunchBlue.jpg', 23.40, 0),
('Tactile', 'NK_Cream_Tactile.jpg', 23.40, 10),
('Linear', 'NK_Cream_Dream.jpg', 23.40, 4);