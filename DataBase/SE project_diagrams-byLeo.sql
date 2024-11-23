CREATE TABLE Users (
	user_id INT NOT NULL PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	role VARCHAR(50) NOT NULL);

insert ALL
into Users values 
(1, 'administrator', 'systemadmin')
into Users values 
(2, 'warehouse', 'warehouse manager')
into Users values 
(3, 'sales', 'sales staff')
select * from dual;
    

CREATE TABLE Product (
	product_id VARCHAR(100) NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	type VARCHAR(100) NOT NULL,
	price NUMERIC NOT NULL);


INSERT ALL
INTO Product (product_id, name, type, price) VALUES 
('P01', 'Desk', 'Office Furniture', 189)
INTO Product (product_id, name, type, price) VALUES
('P02', 'Dining Chair', 'Dining Furniture', 89)
INTO Product (product_id, name, type, price) VALUES
('P03', 'Sofa Bed', 'Living Room Furniture', 329)
INTO Product (product_id, name, type, price) VALUES
('P04', 'Bar Stool', 'Dining Furniture', 49)
INTO Product (product_id, name, type, price) VALUES
('P05', 'Children Bed', 'Kids Furniture', 299)
INTO Product (product_id, name, type, price) VALUES
('P06', 'Wardrobe', 'Bedroom Furniture', 499)
INTO Product (product_id, name, type, price) VALUES
('P07', 'TV Stand', 'Living Room Furniture', 199)
INTO Product (product_id, name, type, price) VALUES
('P08', 'Console Table', 'Living Room Furniture', 99)
INTO Product (product_id, name, type, price) VALUES
('P09', 'Folding Chair', 'Multi-functional Furniture', 29)
INTO Product (product_id, name, type, price) VALUES
('P10', 'Rocking Chair', 'Living Room Furniture', 159)
INTO Product (product_id, name, type, price) VALUES
('P11', 'Dressing Table', 'Bedroom Furniture', 249)
INTO Product (product_id, name, type, price) VALUES
('P12', 'Bookshelf', 'Office Furniture', 129)
INTO Product (product_id, name, type, price) VALUES
('P13', 'Footstool', 'Living Room Furniture', 39)
INTO Product (product_id, name, type, price) VALUES
('P14', 'Plant Stand', 'Decorative Furniture', 59)
INTO Product (product_id, name, type, price) VALUES
('P15', 'Nightstand', 'Bedroom Furniture', 79)
INTO Product (product_id, name, type, price) VALUES
('P16', 'Display Cabinet', 'Commercial Furniture', 199)
INTO Product (product_id, name, type, price) VALUES
('P17', 'Closet', 'Living Room Furniture', 349)
INTO Product (product_id, name, type, price) VALUES
('P18', 'Shoe Cabinet', 'Entryway Furniture', 139)
INTO Product (product_id, name, type, price) VALUES
('P19', 'Corner Table', 'Living Room Furniture', 49)
INTO Product (product_id, name, type, price) VALUES
('P20', 'Storage Cabinet', 'Multi-functional Furniture', 89)
INTO Product (product_id, name, type, price) VALUES
('P21', 'Sideboard', 'Dining Furniture', 159)
INTO Product (product_id, name, type, price) VALUES
('P22', 'Bean Bag Chair', 'Recreational Furniture', 179)
INTO Product (product_id, name, type, price) VALUES
('P23', 'Book Rack', 'Office Furniture', 69)
INTO Product (product_id, name, type, price) VALUES
('P24', 'Coffee Table', 'Living Room Furniture', 99)
INTO Product (product_id, name, type, price) VALUES
('P25', 'Computer Desk', 'Office Furniture', 119)
INTO Product (product_id, name, type, price) VALUES
('P26', 'Massage Chair', 'Recreational Furniture', 499)
INTO Product (product_id, name, type, price) VALUES
('P27', 'Study Desk', 'Kids Furniture', 129)
INTO Product (product_id, name, type, price) VALUES
('P28', 'Double Sofa', 'Living Room Furniture', 249)
INTO Product (product_id, name, type, price) VALUES
('P29', 'Backrest Chair', 'Living Room Furniture', 79)
INTO Product (product_id, name, type, price) VALUES
('P30', 'Room Divider', 'Decorative Furniture', 149)
SELECT * from dual;


CREATE TABLE Inventory (
	inventory_id VARCHAR(50) NOT NULL PRIMARY KEY,
	product_id VARCHAR(50) NOT NULL,
	quantity INT NOT NULL,
	updated_by INT NOT NULL);
    
INSERT ALL
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV001', 'P01', 120, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV002', 'P02', 85, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV003', 'P03', 60, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV004', 'P04', 200, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV005', 'P05', 150, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV006', 'P06', 90, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV007', 'P07', 50, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV008', 'P08', 30, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV009', 'P09', 110, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV010', 'P10', 75, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV011', 'P11', 95, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV012', 'P12', 130, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV013', 'P13', 170, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV014', 'P14', 40, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV015', 'P15', 60, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV016', 'P16', 200, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV017', 'P17', 120, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV018', 'P18', 50, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV019', 'P19', 140, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV020', 'P20', 180, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV021', 'P21', 75, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV022', 'P22', 95, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV023', 'P23', 100, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV024', 'P24', 150, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV025', 'P25', 80, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV026', 'P26', 70, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV027', 'P27', 60, 3)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV028', 'P28', 220, 1)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV029', 'P29', 130, 2)
INTO Inventory (inventory_id, product_id, quantity, updated_by) VALUES
('INV030', 'P30', 190, 3)
select * from dual;



CREATE TABLE InventoryHistory (
	history_id VARCHAR(100) NOT NULL PRIMARY KEY,
	inventory_id VARCHAR(100) NOT NULL,
	change_quantity INT NOT NULL,
	updated_by INT NOT NULL,
	update_date DATE NOT NULL);
    
INSERT ALL
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H01', 'INV001', 20, 1, TO_DATE('2024-11-01', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H02', 'INV002', -10, 2, TO_DATE('2024-11-02', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H03', 'INV003', 15, 3, TO_DATE('2024-11-03', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H04', 'INV004', -5, 1, TO_DATE('2024-11-04', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H05', 'INV005', 30, 2, TO_DATE('2024-11-05', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H06', 'INV006', -20, 3, TO_DATE('2024-11-06', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H07', 'INV007', 10, 1, TO_DATE('2024-11-07', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H08', 'INV008', -15, 2, TO_DATE('2024-11-08', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H09', 'INV009', 25, 3, TO_DATE('2024-11-09', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H10', 'INV010', -10, 1, TO_DATE('2024-11-10', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H11', 'INV001', 40, 2, TO_DATE('2024-11-11', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H12', 'INV002', -35, 3, TO_DATE('2024-11-12', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H13', 'INV003', 50, 1, TO_DATE('2024-11-13', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H14', 'INV004', -25, 2, TO_DATE('2024-11-14', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H15', 'INV005', 45, 3, TO_DATE('2024-11-15', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H16', 'INV006', -30, 1, TO_DATE('2024-11-16', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H17', 'INV007', 35, 2, TO_DATE('2024-11-17', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H18', 'INV008', -40, 3, TO_DATE('2024-11-18', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H19', 'INV009', 55, 1, TO_DATE('2024-11-19', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H20', 'INV010', -50, 2, TO_DATE('2024-11-20', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H21', 'INV001', 25, 3, TO_DATE('2024-11-21', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H22', 'INV002', -15, 1, TO_DATE('2024-11-22', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H23', 'INV003', 10, 2, TO_DATE('2024-11-23', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H24', 'INV004', -5, 3, TO_DATE('2024-11-24', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H25', 'INV005', 35, 1, TO_DATE('2024-11-25', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H26', 'INV006', -25, 2, TO_DATE('2024-11-26', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H27', 'INV007', 15, 3, TO_DATE('2024-11-27', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H28', 'INV008', -10, 1, TO_DATE('2024-11-28', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H29', 'INV009', 20, 2, TO_DATE('2024-11-29', 'YYYY-MM-DD'))
INTO InventoryHistory (history_id, inventory_id, change_quantity, updated_by, update_date) VALUES
('H30', 'INV010', -15, 3, TO_DATE('2024-11-30', 'YYYY-MM-DD'))
select * from dual;



CREATE TABLE Sales (
	order_id VARCHAR(100) NOT NULL PRIMARY KEY ,
	product_id VARCHAR(100) NOT NULL,
	customer VARCHAR(200) NOT NULL,
	quantity_sold INTEGER NOT NULL,
	total_sales NUMERIC NOT NULL,
	sale_date DATE NOT NULL);
    
INSERT ALL
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O01', 'P01', 'Alice Johnson', 2, 40.00, TO_DATE('2024-11-01', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O02', 'P02', 'Bob Smith', 1, 25.00, TO_DATE('2024-11-02', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O03', 'P03', 'Charlie Brown', 3, 75.00, TO_DATE('2024-11-03', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O04', 'P04', 'David Wilson', 1, 35.00, TO_DATE('2024-11-04', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O05', 'P05', 'Eva White', 5, 125.00, TO_DATE('2024-11-05', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O06', 'P06', 'Frank Taylor', 4, 80.00, TO_DATE('2024-11-06', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O07', 'P07', 'Grace Moore', 2, 60.00, TO_DATE('2024-11-07', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O08', 'P08', 'Hannah Green', 3, 90.00, TO_DATE('2024-11-08', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O09', 'P09', 'Ian Lewis', 1, 20.00, TO_DATE('2024-11-09', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O10', 'P10', 'Jack Clark', 2, 50.00, TO_DATE('2024-11-10', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O11', 'P01', 'Kate Miller', 4, 80.00, TO_DATE('2024-11-11', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O12', 'P02', 'Leo Adams', 2, 50.00, TO_DATE('2024-11-12', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O13', 'P03', 'Mia Hall', 3, 90.00, TO_DATE('2024-11-13', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O14', 'P04', 'Noah Perez', 1, 35.00, TO_DATE('2024-11-14', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O15', 'P05', 'Olivia Scott', 2, 50.00, TO_DATE('2024-11-15', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O16', 'P06', 'Paul King', 5, 100.00, TO_DATE('2024-11-16', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O17', 'P07', 'Quinn Harris', 4, 120.00, TO_DATE('2024-11-17', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O18', 'P08', 'Ruby Turner', 1, 30.00, TO_DATE('2024-11-18', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O19', 'P09', 'Sophia Walker', 2, 40.00, TO_DATE('2024-11-19', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O20', 'P10', 'Tom Robinson', 3, 75.00, TO_DATE('2024-11-20', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O21', 'P01', 'Uma Wright', 5, 100.00, TO_DATE('2024-11-21', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O22', 'P02', 'Victor Young', 4, 100.00, TO_DATE('2024-11-22', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O23', 'P03', 'Wendy Allen', 1, 30.00, TO_DATE('2024-11-23', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O24', 'P04', 'Xander Foster', 3, 105.00, TO_DATE('2024-11-24', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O25', 'P05', 'Yara Torres', 2, 60.00, TO_DATE('2024-11-25', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O26', 'P06', 'Zoe Hughes', 3, 75.00, TO_DATE('2024-11-26', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O27', 'P07', 'Alex Diaz', 1, 30.00, TO_DATE('2024-11-27', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O28', 'P08', 'Bella Evans', 2, 60.00, TO_DATE('2024-11-28', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O29', 'P09', 'Chris Gordon', 4, 80.00, TO_DATE('2024-11-29', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O30', 'P10', 'Diana Ramirez', 5, 125.00, TO_DATE('2024-11-30', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O31', 'P01', 'Ella Griffin', 3, 60.00, TO_DATE('2024-11-15', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O32', 'P02', 'Felix Barnes', 2, 50.00, TO_DATE('2024-11-16', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O33', 'P03', 'George Simpson', 1, 25.00, TO_DATE('2024-11-17', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O34', 'P04', 'Harper Brooks', 5, 175.00, TO_DATE('2024-11-18', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O35', 'P05', 'Ivy Bell', 4, 100.00, TO_DATE('2024-11-19', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O36', 'P06', 'Jake Reed', 2, 50.00, TO_DATE('2024-11-20', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O37', 'P07', 'Kara Hayes', 1, 30.00, TO_DATE('2024-11-21', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O38', 'P08', 'Liam Carter', 4, 120.00, TO_DATE('2024-11-22', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O39', 'P09', 'Mason Richardson', 5, 100.00, TO_DATE('2024-11-23', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O40', 'P10', 'Nina Sullivan', 2, 50.00, TO_DATE('2024-11-24', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O41', 'P01', 'Olive Barrett', 3, 75.00, TO_DATE('2024-11-25', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O42', 'P02', 'Peter Alexander', 4, 100.00, TO_DATE('2024-11-26', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O43', 'P03', 'Quincy Chambers', 2, 50.00, TO_DATE('2024-11-27', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O44', 'P04', 'Rita Jenkins', 1, 35.00, TO_DATE('2024-11-28', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O45', 'P05', 'Sara Watkins', 5, 125.00, TO_DATE('2024-11-29', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O46', 'P06', 'Theo Harper', 3, 75.00, TO_DATE('2024-11-30', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O47', 'P07', 'Ursula Wallace', 4, 120.00, TO_DATE('2024-11-01', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O48', 'P08', 'Victor Neal', 2, 60.00, TO_DATE('2024-11-02', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O49', 'P09', 'Wanda Porter', 1, 20.00, TO_DATE('2024-11-03', 'YYYY-MM-DD'))
INTO Sales (order_id, product_id, customer, quantity_sold, total_sales, sale_date) VALUES
('O50', 'P10', 'Xavier Vaughn', 5, 125.00, TO_DATE('2024-11-04', 'YYYY-MM-DD'))
select * from dual;


--select * from users;
--select * from product;
--select * from inventory;
--select * from inventoryhistory;
--select * from sales;


    