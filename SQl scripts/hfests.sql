
CREATE TABLE Employee (
    id INT NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    dob DATE,
    citizenship VARCHAR(30),
    email VARCHAR(50) UNIQUE,
    postal_code VARCHAR(20),
    province VARCHAR(30),
    city VARCHAR(60),
    address VARCHAR(100),
    phone VARCHAR(20),
    medicare VARCHAR(16) NOT NULL UNIQUE,
    PRIMARY KEY(id)
);

CREATE TABLE FacilityType(
    id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE Facility (
    id INT NOT NULL,
    name VARCHAR(255) UNIQUE,
    address VARCHAR(255),
    city VARCHAR(60),
    province VARCHAR(2),
    postal_code VARCHAR(7),
    phone VARCHAR(20),
    web_address VARCHAR(2100),
    capacity INT NOT NULL,
    facilitytype_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(facilitytype_id) REFERENCES FacilityType(id)
);

CREATE TABLE EmployeeRole(
    id INT NOT NULL,
    role VARCHAR(30) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE EmployedHistory(
    facility_id INT NOT NULL,
    employee_id INT NOT NULL,
    employeerole_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    FOREIGN KEY(facility_id) REFERENCES Facility(id),
    FOREIGN KEY(employee_id) REFERENCES Employee(id),
    FOREIGN KEY(employeerole_id) REFERENCES EmployeeRole(id),
    PRIMARY KEY (facility_id, employee_id, employeerole_id, start_date)
);

CREATE TABLE Vaccination(
    id INT NOT NULL,
    type VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Was_Vaccinated(
    employee_id INT NOT NULL, 
    vaccination_id INT NOT NULL,
    dose_number INT NOT NULL,
    location INT NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY(employee_id) REFERENCES Employee(id),
    FOREIGN KEY(vaccination_id) REFERENCES Vaccination(id),
    PRIMARY KEY (employee_id, vaccination_id, date)
);

CREATE TABLE Infection(
    id INT NOT NULL,
    type VARCHAR(40) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Was_Infected(
    employee_id INT NOT NULL,
    infection_id INT NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY(employee_id) REFERENCES Employee(id),
    FOREIGN KEY(infection_id) REFERENCES Infection(id),
    PRIMARY KEY (employee_id, infection_id, date)
);

CREATE TABLE EmployeeSchedule(
    employee_id INT,
    facility_id INT,
    date DATE,
    start_time TIME,
    end_time TIME NOT NULL,
    FOREIGN KEY(employee_id) REFERENCES Employee(id), 
    FOREIGN KEY(facility_id) REFERENCES Facility(id), 
    PRIMARY KEY(employee_id, facility_id, date, start_time)
);

CREATE TABLE EmailLog (
    facility_name varchar(255),
    receiver_email varchar(50),
    subject varchar(255),
    body varchar(255),
    date DATETIME,
    FOREIGN KEY(facility_name) REFERENCES Facility(name),
    FOREIGN KEY(receiver_email) REFERENCES Employee(email),
    PRIMARY KEY(facility_name, receiver_email, subject, body, date)
);

CREATE TABLE ManagedBy (
    facility_id INT,
    employee_id INT DEFAULT NULL,
    FOREIGN KEY(facility_id) REFERENCES Facility(id),
    FOREIGN KEY(employee_id) REFERENCES Employee(id),
    PRIMARY KEY(facility_id)
);

CREATE TABLE AdminUsers (
    username varchar(255),
    password varchar(255) NOT NULL,
    extra varchar(255) DEFAULT NULL,
    facilityId int NOT NULL,
    FOREIGN KEY(facilityId) REFERENCES Facility(id),
    PRIMARY KEY(username)
);

-- DUMMY DATA
INSERT INTO Vaccination (id,type)
VALUES
    (1, 'Pfizer'),
    (2, 'Moderna'),
    (3, 'AstraZeneca'),
    (4, 'Johnson & Johnson');

INSERT INTO FacilityType (id,name)
VALUES
    (1, 'Hospital'),
    (2, 'CLSC'),
    (3, 'Clinic'),
    (4, 'Pharmacy'),
    (5, 'Special');
    
INSERT INTO EmployeeRole (id, role)
VALUES
    (1, 'Nurse'),
    (2, 'Doctor'),
    (3, 'Cashier'),
    (4, 'Pharmacist'),
    (5, 'Receptionist'),
    (6, 'Administrative Personnel'),
    (7, 'Security Personnel'),
    (8, 'Regular');

INSERT INTO Infection (id,type)
VALUES
    (1, 'COVID-19'),
    (2, 'COVID-19 Delta'),
    (3, 'SARS'),
    (4, 'COVID-19 Omicron');

INSERT INTO Employee (id,first_name,last_name,dob,citizenship,email,postal_code,province,city,address,phone,medicare)
VALUES
    (8, 'Erica', 'Swanson', '2022-09-23', 'Colombia', 'tincidunt.pede.ac@google.com', 'O6J 8T8', 'NS', 'Rollegem', 'Ap #512-5190 Suspendisse Road', '(819) 341-7564', 'HLJF 2678 6133'),
    (18, 'Jolie', 'Rojas', '2023-03-16', 'Russian Federation', 'et.lacinia.vitae@icloud.com', 'p3B 3N7', 'MB', 'Calarcá', 'Ap #927-5600 Ligula St.', '1-741-535-2659', 'UAXS 2235 6968'),
    (20, 'Knox', 'Cleveland', '2023-03-29', 'South Korea', 'nunc@yahoo.net', 'b5R 2H7', 'PE', 'Ilhéus', 'Ap #176-5714 Ut Av.', '1-127-724-9055', 'HDBP 5649 7382'),
    (23, 'Kiara', 'Gardner', '2023-06-19', 'Norway', 'nullam.lobortis@icloud.ca', 'T6W 7T6', 'NT', 'Argyle', 'P.O. Box 610, 2122 Ipsum. St.', '1-846-716-0754', 'STKI 9011 2559'),
    (25, 'Pamela', 'Rojas', '2022-11-09', 'Costa Rica', 'mi.eleifend.egestas@hotmail.com', 'S6A 9K8', 'AB', 'Liberia', 'P.O. Box 589, 4057 Molestie Ave', '(737) 527-6743', 'VYDV 7327 1499'),
    (34, 'Philip', 'Gross', '2023-01-28', 'Austria', 'sem@icloud.com', 'B2E 3C8', 'NB', 'Port Blair', '2033 Nec Avenue', '1-410-468-7187', 'UJBC 9600 4838'),
    (37, 'Jena', 'Velazquez', '2023-01-29', 'South Africa', 'cursus@icloud.ca', 'V1B 3R6', 'ON', 'Harbour Grace', 'Ap #743-2843 Quisque St.', '(836) 359-4388', 'HXIP 8661 2637'),
    (38, 'Lilah', 'Duran', '2022-11-17', 'Mexico', 'iaculis@icloud.couk', 'B6G 0M5', 'AB', 'Moncton', '683-8823 Sem St.', '1-257-705-5472', 'NPEC 9234 0933'),
    (41, 'Kelly', 'Cotton', '2023-08-16', 'Singapore', 'mauris.eu@icloud.edu', '30L 3S5', 'BC', 'Cambridge Bay', 'Ap #640-5370 Amet Street', '(977) 586-2363', 'TRXR 5419 6624'),
    (43, 'Signe', 'Mathews', '2022-11-25', 'Netherlands', 'vitae.aliquet@hotmail.net', 'Y6Z 3H1', 'NU', 'Wrocław', '448-7810 Nunc Av.', '(437) 548-0188', 'YGYY 8434 9668'),
    (44, 'Quyn', 'Poole', '2023-06-04', 'Netherlands', 'pharetra.ut@yahoo.org', 'A8C 4X5', 'YT', 'Camrose', '6711 Aliquet Rd.', '1-152-633-1345', 'LPMJ 3814 2774'),
    (52, 'Zorita', 'Nichols', '2022-09-01', 'Turkey', 'ipsum.donec@yahoo.org', 'R8C 1K2', 'AB', 'Cambridge Bay', 'P.O. Box 316, 7986 Cursus Ave', '1-258-677-2157', 'YRVF 9631 3143'),
    (53, 'Rajah', 'Gaines', '2023-01-28', 'Italy', 'vivamus.rhoncus.donec@aol.com', 'V3H 7P4', 'PE', 'Fort McPherson', '915-5322 Ultricies Av.', '1-739-988-6525', 'VULL 5354 5438'),
    (67, 'Wayne', 'Banks', '2022-04-17', 'South Africa', 'morbi.metus@icloud.net', 'N4E 8M2', 'PE', 'Richmond', '320-2892 Nam Road', '1-273-657-5856', 'EVJJ 3868 6124'),
    (78, 'Leilani', 'Cash', '2023-08-02', 'Brazil', 'ipsum.phasellus@yahoo.ca', 'D1Z 1C7', 'BC', 'Halifax', '525-3513 Rhoncus St.', '1-491-248-4889', 'RVPC 3344 5122'),
    (86, 'Rama', 'Hughes', '2022-12-31', 'Vietnam', 'lacus.vestibulum@icloud.ca', '73J 7P4', 'AB', 'Macau', 'P.O. Box 996, 273 Eleifend Rd.', '(634) 521-3883', 'MVAJ 8148 7655'),
    (87, 'Katell', 'Erickson', '2024-01-15', 'France', 'purus.duis@protonmail.edu', 'S0X 6G6', 'MB', 'Rivne', '2561 Fusce Ave', '(738) 467-8794', 'FXPO 6981 2172'),
    (88, 'Brent', 'Guzman', '2023-08-30', 'Netherlands', 'molestie.sed@google.couk', 'Y7J 7A0', 'MB', 'Paço do Lumiar', '1501 Commodo Rd.', '(835) 408-7300', 'CLBC 9140 8568'),
    (89, 'Calvin', 'Langley', '2022-08-26', 'Brazil', 'lectus.justo@aol.org', 'R4S 8P8', 'NS', 'Jammu', 'P.O. Box 354, 1433 Vivamus Rd.', '(820) 745-5366', 'DVCU 8555 6024'),
    (92, 'Kenneth', 'Clark', '2022-06-19', 'United Kingdom', 'erat.volutpat@aol.com', 'N7E 8T6', 'SK', 'Anjou', '3535 Elementum, Rd.', '1-123-656-6534', 'JWUV 0013 4416');

INSERT INTO Facility (id,name,address,city,province,postal_code,phone,web_address,capacity,facilitytype_id)
VALUES
    (15, 'Odio PC', 'Ap #641-1006 Vel Street', 'Sosnowiec', 'AB', 'A6P 6H8', '1-779-624-3421', 'http://facebook.com', 350, 2),
    (27, 'Malesuada Vel Associates', '5864 Duis Rd.', 'Volgograd', 'AB', 'G8N 4W8', '1-136-572-6845', 'http://whatsapp.com', 350, 2),
    (38, 'Viverra Donec Industries', '885-7520 Laoreet Ave', 'Saint John', 'YT', 'Y1N 1L2', '(187) 751-8480', 'https://reddit.com', 300, 5),
    (50, 'Hospital Maisonneuve Rosemont', '6748 Augue Road', 'McCallum', 'BC', 'M5X 8C2', '1-306-306-2823', 'http://google.com', 2000, 1),
    (52, 'Vel Convallis Inc.', '2846 Bibendum Street', 'Guangdong', 'BC', 'T0J 2T1', '1-877-618-2484', 'https://cnn.com', 150, 4),
    (70, 'Dis Parturient Incorporated', 'Ap #915-2974 Sagittis Ave', 'Armenia', 'NT', 'D5L 3B6', '(369) 886-8780', 'https://facebook.com', 190, 1),
    (76, 'Bibendum Donec Inc.', '312-761 Arcu. Street', 'Cork', 'NS', 'I9H 5S5', '1-836-893-9757', 'http://nytimes.com', 3500, 3),
    (82, 'Rutrum Justo Praesent Ltd', '9578 Luctus Av.', 'Pasir Ris', 'NU', 'H2K 4Y1', '1-312-316-9016', 'http://google.com', 800, 5),
    (97, 'A Mi Limited', '589-2747 Magnis St.', 'Piura', 'NL', 'S1T 2T8', '1-697-715-8886', 'https://cnn.com', 700, 3),
    (98, 'Amet Lorem Semper Foundation', '799-6163 Id, Road', 'Cotabato City', 'QC', 'Y1T 7V1', '1-540-434-6117', 'https://reddit.com', 250, 4);

INSERT INTO EmployedHistory (facility_id,employee_id,employeerole_id,start_date,end_date)
VALUES
    (27, 20, 3, '2001-07-11', '2011-12-01'),
    (27, 23, 6, '2023-06-04', NULL),
    (38, 8, 6, '2023-01-01', NULL),
    (38, 20, 6, '2023-01-01', '2023-01-02'),
    (38, 86, 6, '2023-01-01', NULL),
    (38, 92, 6, '2023-01-01', NULL),
    (50, 18, 2, '2022-11-17', NULL),
    (50, 20, 7, '2015-02-05', '2016-02-04'),
    (50, 37, 2, '2022-10-18', NULL),
    (50, 41, 1, '2022-06-17', NULL),
    (50, 43, 1, '2022-11-17', '2023-01-03'),
    (50, 44, 1, '2022-09-16', NULL),
    (50, 88, 4, '2022-11-17', NULL),
    (50, 89, 3, '2022-11-17', NULL),
    (52, 44, 1, '2004-02-05', '2006-01-07'),
    (52, 78, 6, '2022-06-19', '2023-01-28'),
    (82, 38, 2, '2021-07-15', NULL),
    (82, 38, 4, '2020-02-19', '2020-05-13'),
    (82, 87, 2, '2021-07-15', '2022-01-25'),
    (97, 52, 6, '2023-01-29', NULL),
    (97, 53, 6, '2023-01-29', NULL),
    (98, 25, 6, '2022-04-17', NULL),
    (98, 34, 6, '2022-04-17', '2022-12-28'),
    (98, 67, 6, '2022-04-17', NULL);

INSERT INTO Was_Vaccinated (employee_id,vaccination_id,dose_number,location,date)
VALUES
    (8, 3, 1, 76, '2021-05-03'),
    (23, 2, 1, 50, '2022-02-01'),
    (23, 2, 2, 82, '2022-05-01'),
    (41, 2, 1, 38, '2022-09-08'),
    (41, 2, 2, 27, '2022-10-27'),
    (52, 2, 1, 82, '2021-07-03'),
    (78, 2, 1, 15, '2020-06-21'),
    (78, 2, 2, 98, '2022-09-24'),
    (78, 2, 3, 38, '2022-12-31'),
    (92, 2, 1, 52, '2022-02-01');

INSERT INTO Was_Infected (employee_id,infection_id,date)
VALUES
    (37, 1, '2023-01-02'),
    (44, 1, '2020-04-19'),
    (44, 1, '2020-05-20'),
    (53, 1, '2021-04-14'),
    (89, 1, '2022-03-09'),
    (53, 2, '2021-05-14'),
    (92, 2, '2022-07-26'),
    (53, 3, '2021-03-14'),
    (23, 4, '2022-06-17'),
    (44, 4, '2020-07-20'),
    (44, 4, '2020-07-23');


INSERT INTO ManagedBy (employee_id, facility_id) 
VALUES
    (NULL, 3),
    (NULL, 15),
    (NULL, 26),
    (NULL, 50),
    (NULL, 70),
    (NULL, 76),
    (NULL, 82),
    (NULL, 98),
    (20, 38),
    (23, 27),
    (52, 97),
    (78, 52);

INSERT INTO AdminUsers (username, password, extra, facilityId) 
VALUES
    ('testadmin', '12345', NULL, 3);

INSERT INTO EmailLog (facility_name, receiver_email, subject, date, body) 
VALUES
    ('Malesuada Vel Associates', 'cursus@icloud.ca', 'Malesuada Vel Associates Schedule for Monday 09/04/2023 to  Wednesday 16/04/2023', '2023-09-04', '<table><tr><th>Employee ID</th><th>Facility Name</th><th>Facility Address</th><t'),
    ('Hospital Maisonneuve Rosemont', 'morbi.metus@icloud.net', 'Hospital Maisonneuve Rosemont Schedule for Monday 09/04/2023 to  Wednesday 16/04/2023', '2023-09-03', '<table><tr><th>Employee ID</th><th>Facility Name</th><th>Facility Address</th><t'),
    ('Malesuada Vel Associates', 'tincidunt.pede.ac@google.com', 'Malesuada Vel Associates Schedule for Monday 09/04/2023 to  Wednesday 16/04/2023', '2023-09-07', '<table><tr><th>Employee ID</th><th>Facility Name</th><th>Facility Address</th><t'),
    ('Hospital Maisonneuve Rosemont', 'vivamus.rhoncus.donec@aol.com', 'Hospital Maisonneuve Rosemont Schedule for Monday 09/04/2023 to  Wednesday 16/04/2023', '2023-09-05', '<table><tr><th>Employee ID</th><th>Facility Name</th><th>Facility Address</th><t'),
    ('Malesuada Vel Associates', 'vivamus.rhoncus.donec@aol.com', 'Malesuada Vel Associates Schedule for Monday 09/04/2023 to  Wednesday 16/04/2023', '2023-09-04', '<table><tr><th>Employee ID</th><th>Facility Name</th><th>Facility Address</th><t');
