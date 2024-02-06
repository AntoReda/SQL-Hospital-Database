-- Query 1
-- 1. Create/Delete/Edit/Display a Facility.

-- Insert:
INSERT INTO Facility(id, name, address, city, province, postal_code, phone, web_address, capacity, facilitytype_id) 
VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]')

-- Delete:
DELETE FROM Facility WHERE 0

-- Edit:
UPDATE Facility 
SET id='[value-1]',name='[value-2]',address='[value-3]',city='[value-4]',province='[value-5]',postal_code='[value-6]',phone='[value-7]',web_address='[value-8]',capacity='[value-9]',facilitytype_id='[value-10]' 
WHERE 1

-- Display: 
SELECT id, name, address, city, province, postal_code, phone, web_address, capacity, facilitytype_id 
FROM Facility 
WHERE 1


-- Query 2
-- 2. Create/Delete/Edit/Display a Employee.

-- Insert:
INSERT INTO Employee(id, first_name, last_name, dob, citizenship, email, postal_code, province, city, address, phone, medicare) 
VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]')

-- Delete:
DELETE FROM Employee WHERE 0

-- Edit:
UPDATE Employee 
SET id='[value-1]',first_name='[value-2]',last_name='[value-3]',dob='[value-4]',citizenship='[value-5]',email='[value-6]',postal_code='[value-7]',province='[value-8]',city='[value-9]',address='[value-10]',phone='[value-11]',medicare='[value-12]' 
WHERE 1

-- Display: 
SELECT id, first_name, last_name, dob, citizenship, email, postal_code, province, city, address, phone, medicare 
FROM Employee 
WHERE 1

-- Query 3
-- 3. Create/Delete/Edit/Display a Vaccination.
-- Insert:
INSERT INTO Vaccination(id, type) 
VALUES ('[value-1]','[value-2]')

-- Delete:
DELETE FROM Vaccination 
WHERE 0

-- Edit:
UPDATE Vaccination 
SET id='[value-1]',type='[value-2]' 
WHERE 1

-- Display: 
SELECT id, type 
FROM Vaccination 
WHERE 1

-- Query 4
-- 4. Create/Delete/Edit/Display an Infection.

-- Insert:
INSERT INTO Infection(id, type) 
VALUES ('[value-1]','[value-2]')

-- Delete:
DELETE FROM Infection 
WHERE 0

-- Edit:
UPDATE Infection 
SET id='[value-1]',type='[value-2]' 
WHERE 1

-- Display: 
SELECT id, type 
FROM Vaccination 
WHERE 1

--Query 5
-- 5. Assign/Delete/Edit schedule for an Employee. (Attempt to schedule a conflicting assignment for an employee)

-- Insert:
INSERT INTO EmployeeSchedule(employee_id, facility_id, date, start_time, end_time) 
VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')

-- Delete:
DELETE FROM EmployeeSchedule 
WHERE 0

-- Edit:
UPDATE EmployeeSchedule 
SET employee_id='[value-1]',facility_id='[value-2]',date='[value-3]',start_time='[value-4]',end_time='[value-5]' 
WHERE 1

-- Display: 
SELECT employee_id, facility_id, date, start_time, end_time 
FROM EmployeeSchedule 
WHERE 1


--Query 6
-- Get details of all the facilities in the system. 

SELECT Facility.name, Facility.address, Facility.city, Facility.province, Facility.postal_code, Facility.phone, web_address, capacity, FacilityType.name as facility_type, 
    (SELECT Employee.first_name FROM Employee WHERE Employee.id in 
        (SELECT ManagedBy.employee_id FROM ManagedBy WHERE ManagedBy.facility_id = Facility.id)) as manager_fname, 
    (SELECT COUNT(EmployedHistory.employee_id) FROM EmployedHistory WHERE EmployedHistory.facility_id = Facility.id AND EmployedHistory.end_date IS NULL) As current_employee_count
FROM Facility, FacilityType
WHERE Facility.facilitytype_id = FacilityType.id
ORDER BY Facility.province, Facility.city, Facility.facilitytype_id, current_employee_count;

--Query 7
-- Get details of all the employees currently working in a specific facility LET USER INPUT FAC ID

SELECT first_name, last_name, EmployedHistory.start_date, dob, medicare, phone,  address, city, province, postal_code, citizenship, email
FROM Employee, EmployedHistory 
WHERE Employee.id = EmployedHistory.employee_id 
AND EmployedHistory.end_date IS NULL 
AND EmployedHistory.facility_id = 27
ORDER BY EmployedHistory.employeerole_id, Employee.first_name, Employee.last_name;


--Query 8
-- For a given employee, get the details of all the schedules she/he has been scheduled during a specific period of time. LET USER INPUT START, END and EID
SELECT Facility.name, date, start_time, end_time 
FROM EmployeeSchedule, Facility 
WHERE EmployeeSchedule.start_time > '10:00:00'
AND EmployeeSchedule.end_time < '21:00:00' 
AND EmployeeSchedule.employee_id = 37
AND Facility.id = facility_id 
ORDER BY Facility.name, date, start_time;


--Query 9
-- Get details of all the doctors who have been infected by COVID-19 in the past two weeks.
SELECT first_name, last_name, Was_Infected.date, Facility.name 
FROM Employee, EmployedHistory, Was_Infected, Facility 
WHERE Employee.id = EmployedHistory.employee_id 
AND Employee.id = Was_Infected.employee_id 
AND EmployedHistory.end_date IS NULL 
AND EmployedHistory.employeerole_id = 2 
AND Was_Infected.infection_id < 4 
AND Was_Infected.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW() 
AND Facility.id = EmployedHistory.facility_id 
ORDER BY Facility.name, Employee.first_name;


-- Query 10 (Manuel) 
SELECT facility_name, receiver_email, date, subject, body
FROM EmailLog
WHERE facility_name='Hospital Maisonneuve Rosemont'
ORDER BY date ASC;


-- Query 11 (Anto) In the web lets prompt the user for EmployeeSchedule.facility_id= ? insted of 27 here.
SELECT DISTINCT first_name, last_name, role  
FROM Employee, EmployeeSchedule, EmployedHistory, EmployeeRole 
WHERE EmployeeRole.id=EmployedHistory.employeerole_id AND Employee.id=EmployedHistory.employee_id 
AND EmployedHistory.facility_id=EmployeeSchedule.facility_id AND EmployeeSchedule.employee_id = EmployedHistory.employee_id 
AND (EmployedHistory.employeeRole_id=1 OR EmployedHistory.employeeRole_id=2)  AND (date BETWEEN(NOW() - INTERVAL 14 DAY) AND NOW()) 
AND EmployeeSchedule.facility_id=27 
ORDER BY role, first_name ASC;


--Query 12 (Anto) In the web lets prompt the user for EmployeeSchedule.facility_id= ? and start_time=? and end_time=? instead of 27, 14days ago, now. like here
SELECT role, SUM(TIMEDIFF(end_time, start_time))DIV 10000 AS total_hours  
FROM EmployeeSchedule, EmployeeRole, EmployedHistory 
WHERE EmployedHistory.employeerole_id=EmployeeRole.id AND EmployeeSchedule.employee_id = EmployedHistory.employee_id 
AND EmployeeSchedule.facility_id=EmployedHistory.facility_id AND EmployedHistory.facility_id=27 AND (date BETWEEN(NOW() - INTERVAL 14 DAY) AND NOW()) 
GROUP BY role
ORDER BY role ASC;


--Query 13 (Manuel) takes as input facility province, name, capacity, and the number of 
--employees in each facility infected in the last 2 weeks 
SELECT DISTINCT Facility.province, Facility.name AS facility, Facility.capacity, 
COUNT(DISTINCT Was_Infected.employee_id) AS 'Infected Employees'
FROM Facility, EmployedHistory, Employee, Was_Infected
WHERE Facility.id = EmployedHistory.facility_id AND Employee.id = EmployedHistory.employee_id 
AND Employee.id = Was_Infected.employee_id AND DATEDIFF(CURRENT_DATE(), Was_Infected.date)<=14
GROUP BY Facility.name
ORDER BY Facility.province ASC, COUNT(DISTINCT Was_Infected.employee_id) ASC;
-- Currently, Infected employees' date of infection exceed period of infection in the
-- was_infected table, so they would be excluded from the count.

--Query 14 (Anto)
SELECT first_name, last_name, Employee.city, COUNT(employee_id) AS nb_of_facilities  
FROM EmployedHistory, Employee, Facility    WHERE Facility.province ='QC' AND EmployedHistory.employeerole_id = 2 AND EmployedHistory.facility_id=Facility.id 
AND Employee.id=EmployedHistory.employee_id AND end_date IS NULL 
GROUP BY employee_id 
ORDER BY city ASC, COUNT(employee_id) DESC;

--Query 15 (Anto) Needs testinig
SELECT first_name, last_name, start_date, dob, email, SUM(TIMEDIFF(end_time, start_time))DIV 10000 AS total_hours 
FROM EmployedHistory, Employee, EmployeeSchedule 
WHERE employeerole_id=1 AND end_date IS NULL AND EmployeeSchedule.employee_id = EmployedHistory.employee_id AND Employee.id=EmployedHistory.employee_id;
--Not sure if this works properly. I need to add more values in the tables.

-- Query 16 (Will)
SELECT Employee.first_name , Employee.last_name , EmployedHistory.start_date AS 'First Work Day', 
       EmployeeRole.role, Employee.dob, Employee.email, 
       COALESCE((SELECT SUM(HOUR(TIMEDIFF(end_time, start_time)))
                 FROM EmployeeSchedule 
                 WHERE employee_id = Employee.id), 0) as 'Hours Scheduled'
FROM Employee, Facility, EmployedHistory, EmployeeRole, Was_Infected 
WHERE Employee.id = EmployedHistory.employee_id 
    AND EmployedHistory.facility_id = Facility.id 
    AND EmployedHistory.employeerole_id = EmployeeRole.id 
    AND Employee.id = Was_Infected.employee_id
    AND EmployedHistory.end_date IS NULL
    AND (EmployeeRole.role = 'Nurse' OR EmployeeRole.role = 'Doctor')
GROUP BY Employee.id 
HAVING COUNT(Employee.id) >= 3
ORDER BY EmployeeRole.role, Employee.first_name, Employee.last_name;

-- Query 17 (Will)
SELECT Employee.first_name , Employee.last_name , EmployedHistory.start_date AS 'First Work Day', 
       EmployeeRole.role, Employee.dob, Employee.email, 
       COALESCE((SELECT SUM(HOUR(TIMEDIFF(end_time, start_time)))
                 FROM EmployeeSchedule 
                 WHERE employee_id = Employee.id), 0) as 'Hours Scheduled'
FROM Employee, Facility, EmployedHistory, EmployeeRole
WHERE Employee.id = EmployedHistory.employee_id 
    AND EmployedHistory.facility_id = Facility.id 
    AND EmployedHistory.employeerole_id = EmployeeRole.id 
    AND EmployedHistory.end_date IS NULL
    AND (EmployeeRole.role = 'Nurse' OR EmployeeRole.role = 'Doctor')
    AND Employee.id NOT IN (SELECT employee_id FROM Was_Infected)
ORDER BY EmployeeRole.role, Employee.first_name, Employee.last_name;

-- Query 18 (Will)
SHOW TRIGGERS FROM gac353_4; -- (need to explain each result in shared doc)


-- Emails 
SELECT Employee.id, Facility.name, Facility.address, Employee.first_name, Employee.last_name, Employee.email, EmployeeSchedule.date, EmployeeSchedule.start_time, EmployeeSchedule.end_time 
    FROM Facility, Employee, EmployeeSchedule 
    WHERE Facility.id = EmployeeSchedule.facility_id 
    AND Employee.id = EmployeeSchedule.employee_id 
    AND EmployeeSchedule.date BETWEEN NOW() AND (NOW() + INTERVAL 14 DAY) 
    AND Employee.id in (SELECT EmployedHistory.employee_id FROM EmployedHistory WHERE EmployedHistory.end_date IS NULL) 
    ORDER BY Facility.name, Employee.id, EmployeeSchedule.date, EmployeeSchedule.start_time;
     
-- Infection Emails

SELECT EmployeeSchedule.employee_id, EmployeeSchedule.facility_id, Employee.first_name, Employee.last_name, Employee.email, Facility.name 
FROM `EmployeeSchedule`, Employee, Facility 
WHERE EmployeeSchedule.facility_id 
IN (SELECT EmployeeSchedule.facility_id FROM EmployeeSchedule WHERE EmployeeSchedule.employee_id = "employee-id" AND EmployeeSchedule.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) 
AND EmployeeSchedule.date 
IN (SELECT EmployeeSchedule.date FROM EmployeeSchedule WHERE EmployeeSchedule.employee_id = "employee-id" AND EmployeeSchedule.date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) 
AND Facility.id = EmployeeSchedule.facility_id 
AND Employee.id = EmployeeSchedule.employee_id 
GROUP BY EmployeeSchedule.employee_id;
