DROP TABLE IF EXISTS tasks , projects, img;

CREATE TABLE projects (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL UNIQUE,
    category VARCHAR(100) NOT NULL
);

CREATE TABLE tasks (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL UNIQUE,
    date_task DATE NOT NULL,
    time_task INT(3) NOT NULL,
    project_id INT(11) NOT NULL,
    CONSTRAINT fk_tas_pro
        FOREIGN KEY (project_id)
        REFERENCES projects(id)
        ON DELETE CASCADE
);

CREATE TABLE img (
    imgid INT (11) AUTO_INCREMENT PRIMARY KEY,
    filepath VARCHAR(150) NOT NULL,
    title VARCHAR(50) NOT NULL,
    upload DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    taskid INT(11) NOT NULL,
    CONSTRAINT fk_tas_ta
        FOREIGN KEY (taskid)
        REFERENCES tasks(id)
        ON DELETE CASCADE
);

CREATE TABLE task_comments (
    commentId INT (11) AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR(150) NOT NULL,
    upload DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    taskid INT(11) NOT NULL,
    archived INT(1) NOT NULL DEFAULT 0,
    CONSTRAINT fk_tas_ta_co
        FOREIGN KEY (taskid)
        REFERENCES tasks(id)
        ON DELETE CASCADE
);