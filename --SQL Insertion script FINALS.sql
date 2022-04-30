INSERT INTO CUSTOMER( Customer_Name) VALUES 
    ('Dr. Mario'),
    ('Samus Aran'),
    ('Madeline'),
    ('Donkey Kong'),
    ('Cereza(Bayonetta)');

INSERT INTO PRODUCT(Product_Name, Product_in_Stock, Product_Cost) VALUES
    ('Rabadons Death Cap', '20', '300.00'),
    ('Power Up Block', '100', '10.00'),
    ('Taxidermied Metroid', '3', '1000.00'),
    ('Green Shells(12 count)', '10', '25.00'),
    ('Uriels Gift Assault Rifle', '5', '1250.00'),
    ('Lumafly Lantern', '5', '20.00'),
    ('God Tuner', '10', '200.00'),
    ('Swallow Potion', '4', '10000.00'),
    ('Immortal Marionette', '1', '100000.00'),
    ('Earrings of Ruin', '4', '200.000'),
    ('Gold Star', '100', '10.00'),
    ('Bracelet of Time', '10', '150.00'),
    ('Green Herb(pack of 10)', '25', '10.00'),
    ('Mana Potion', '1000', '5.00'),
    ('Health Potion', '1000', '5.00'),
    ('Bottle of Skooma', '50', '75.00'),
    ('Daedric Armor', '10', '250.00'),
    ('Locket Of Saint Jiub', '100', '80.00'),
    ('Nuka Cola Thirst Zapper', '50', '10.00'),
    ('Pip-Boy 3000 Mark IV', '10', '100.00'),
    ('Vault Boy Bobble Head', '20', '30.00');

INSERT INTO ORDERS(Order_Date, CC_Num, Shipping_Address, Tracking_Num, Order_Status, Total_Cost, Notes, Customer_ID) VALUES
    ("2022-03-27",'1234','32 Pipe Lane, Mushroom Kingdom', '098765', 'S','1310','Where did that guy his medical license?',1),
    ("2022-02-11",'2345','CLASSIFIED, K2-L, Galactic Federation', '123456','S','20', 'didnt say a word. bad ass', 2),
    ("2022-02-05",'3456','room 3, Celestial Resort, Celeste Mountain', '456788','S','80','girl boss shit. super nice', 3),
    ("2022-01-23",'4567','Diddy Kongs Treehouse, Donkey Kong Island', '458794','S','120','angry that we dont sell bananas', 4),
    ("2022-04-10",'5678','The Gates of Hell, Inferno adjacent,', '135790', 'S','300', 'Shes a NUN???', 5); 

INSERT INTO ORDER_HAS_PRODUCTS(Order_ID, Product_ID, QTY) VALUES
    (1, 2, 3),
    (1, 5, 1), 
    (2, 2, 2), 
    (3, 18, 1), 
    (4, 15, 4),
    (4, 20, 5),
    (5, 1, 1); 


