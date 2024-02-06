DELIMITER $$
CREATE TRIGGER employeeschedule_validation
BEFORE INSERT
   ON EmployeeSchedule 
   FOR EACH ROW
BEGIN

    IF (NEW.start_time >= NEW.end_time) 
    THEN
    	SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Schedule start time must be before end time.';
    ELSEIF (NEW.date >= DATE_ADD(NOW(), INTERVAL 1 MONTH))
    THEN
    	SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Schedule date must be within 4 weeks.';
	ELSEIF (SELECT COUNT(*) FROM `Was_Vaccinated` 
            WHERE employee_id = NEW.employee_id 
            AND date >= DATE_SUB(NEW.date, INTERVAL 6 MONTH)) = 0 
    THEN
    	SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Employee has not been vaccinated within the past 6 months.';
    ELSEIF (SELECT COUNT(*) FROM Was_Infected 
            WHERE employee_id = NEW.employee_id
            AND date >= DATE_SUB(NEW.date, INTERVAL 2 WEEK)) > 0 
    THEN
    	SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Employee has been infected within the past 2 weeks.';
    ELSEIF (SELECT COUNT(*) FROM EmployeeSchedule 
            WHERE employee_id = NEW.employee_id 
            AND date = NEW.date
            AND NEW.start_time < DATE_ADD(end_time, INTERVAL 1 HOUR) 
            AND NEW.end_time > DATE_SUB(start_time, INTERVAL 1 HOUR)) > 0 
    THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Employee schedule has a time conflict.';
    END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER new_facility_manager
AFTER INSERT
   ON Facility 
   FOR EACH ROW
BEGIN
	INSERT INTO ManagedBy(facility_id,employee_id) VALUES (NEW.id, NULL);
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER facility_capacity_check
BEFORE INSERT
   ON EmployedHistory 
   FOR EACH ROW
BEGIN
    IF  (SELECT 1 WHERE 
            (SELECT COUNT(*) FROM `EmployedHistory` WHERE facility_id = NEW.facility_id AND end_date IS NULL) >= 
            (SELECT capacity FROM Facility WHERE id = NEW.facility_id)) > 0
    THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'This facility is at capacity.';
	END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER infected_employee_schedule
BEFORE INSERT
   ON Was_Infected 
   FOR EACH ROW
BEGIN
    DELETE FROM `EmployeeSchedule` WHERE employee_id = NEW.employee_id AND (date BETWEEN NEW.date AND NEW.date + INTERVAL 2 WEEK);
END$$
DELIMITER ;