CREATE DATABASE MetroMedClinic;
USE MetroMedClinic;

-- Admin Table
CREATE TABLE Admin (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(100)
);

-- Patients Table
CREATE TABLE Patients (
    patientsId INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    gender ENUM('Male', 'Female','Other') NOT NULL,
    dateOfBirth DATE NOT NULL,
    phoneNumber VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    registrationDate DATE
);

-- Appointments Table
CREATE TABLE Appointments (
    appointmentId INT PRIMARY KEY AUTO_INCREMENT,
    patientsId INT NOT NULL,
    appointmentDate DATE NOT NULL,
    status ENUM('Pending','Ongoing','Completed'),
    FOREIGN KEY (patientsId) REFERENCES Patients(patientsId) ON DELETE CASCADE
);

-- SOAP Notes Table
CREATE TABLE SOAPNotes (
    noteId INT PRIMARY KEY AUTO_INCREMENT,
    patientsId INT NOT NULL,
    subjective TEXT NOT NULL,
    objective TEXT NOT NULL,
    assessment TEXT NOT NULL,
    plan TEXT NOT NULL,
    dateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patientsId) REFERENCES Patients(patientsId) ON DELETE CASCADE
);

-- Insert Sample Data
INSERT INTO Admin (username, password) 
VALUES ('admin01', 'hashed_password_here');

INSERT INTO Patients (firstName, lastName, gender, dateOfBirth, phoneNumber, address)
VALUES ('John', 'Doe', 'Male', '1990-05-15', '09123456789', '123 Main St, Metro City');

INSERT INTO Appointments (patientsId, appointmentDate)
VALUES (1, '2025-02-20');

INSERT INTO SOAPNotes (patientsId, subjective, objective, assessment, plan)
VALUES (
    1,
    'Patient complains of persistent headaches for the past three days.',
    'Blood pressure is 130/85 mmHg, mild tenderness in the forehead area.',
    'Tension headache suspected. No signs of neurological issues.',
    'Prescribed ibuprofen 400mg every 8 hours as needed. Advise hydration and rest.'
);