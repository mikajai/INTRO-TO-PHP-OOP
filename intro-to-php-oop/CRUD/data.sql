CREATE TABLE student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    student_number VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL,
    date_added DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    attendance_date DATE NOT NULL,
    attendance_status ENUM('Present', 'Absent', 'Late', 'Excused') NOT NULL
);

INSERT INTO student (full_name, student_number, email) VALUES 
('Micheline Featherston', 'S2025001', 'mfeatherston0@gmail.com'),
('Derward De Mitris', 'S2025002', 'dde1@gmail.com'),
('Lewiss Simnel', 'S2025003', 'lsimnel2@gmail.com'),
('Darsie Abadam', 'S2025004', 'dabadam3@gmail.com'),
('Jena Fury', 'S2025005', 'jfury4@gmail.com');