INSERT INTO projects
VALUES
     (1,'Learn SQL', 'School'),
     (2,'Learn Javascript', 'School'),
     (3, 'Project X', 'Personal');

INSERT INTO tasks
VALUES
    (1,'Task 1', INTERVAL 1 DAY + CURDATE(), 25, 1),
    (2,'Task 2', DATE_SUB(CURDATE(),INTERVAL 31 DAY), 25, 2),
    (3,'Task 3', INTERVAL 1 MONTH + CURDATE(), 25, 3);