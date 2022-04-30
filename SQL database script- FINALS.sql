DROP TABLE ORDER_HAS_PRODUCTS;
DROP TABLE ORDERS;
DROP TABLE PRODUCT;
DROP TABLE CUSTOMER; -- remove all tables (1)

-- create store tables (2)
CREATE TABLE CUSTOMER(
    Customer_ID int AUTO_INCREMENT,
    Customer_Name VarChar(64) NOT NULL,

    PRIMARY KEY(Customer_ID)
);

CREATE TABLE PRODUCT(
    Product_ID int AUTO_INCREMENT,
    Product_Name VarChar(64) NOT NULL,
    Product_in_Stock int NOT NULL,
    Product_Cost FLOAT NOT NULL,

    PRIMARY KEY(Product_ID)
);

CREATE TABLE ORDERS(
    Order_ID int AUTO_INCREMENT,
    Order_Date Date,
    CC_Num int(4) NOT NULL,
    Shipping_Address VarChar(100) NOT NULL,
    Tracking_Num Char(50),
    Order_Status VarChar(1) NOT NULL,
    Total_Cost FLOAT,
    Notes VarChar(100),
    Customer_ID int,

    PRIMARY KEY(Order_ID),
    FOREIGN KEY(Customer_ID) REFERENCES CUSTOMER(Customer_ID)
);

CREATE TABLE ORDER_HAS_PRODUCTS(
    Order_ID int,
    Product_ID int,
    QTY int NOT NULL,

    PRIMARY KEY(Order_ID, Product_ID),

    FOREIGN KEY(Order_ID) REFERENCES ORDERS(Order_ID),
    FOREIGN KEY(Product_ID) REFERENCES PRODUCT(Product_ID)
);