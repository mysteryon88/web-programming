-- Триггер для INSERT
DELIMITER $$
CREATE TRIGGER orders_insert_audit_log
AFTER INSERT ON orders
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'INSERT', 'orders', NEW.OrderID);
END $$
DELIMITER ;

-- Триггер для UPDATE
DELIMITER $$
CREATE TRIGGER orders_update_audit_log
AFTER UPDATE ON orders
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (NEW.employee_id, 'UPDATE', 'orders', NEW.OrderID);
END $$
DELIMITER ;

-- Триггер для DELETE
DELIMITER $$
CREATE TRIGGER orders_delete_audit_log
AFTER DELETE ON orders
FOR EACH ROW
BEGIN
    INSERT INTO audit_log (employee_id, action, table_name, record_id)
    VALUES (OLD.employee_id, 'DELETE', 'orders', OLD.OrderID);
END $$
DELIMITER ;
