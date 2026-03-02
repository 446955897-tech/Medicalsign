CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATETIME NOT NULL,
    reason VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ON UPDATE CURRENT_TIMESTAMP
);

 
ALTER TABLE appointments
ADD CONSTRAINT fk_patient
FOREIGN KEY (patient_id)
REFERENCES users(id)
ON DELETE CASCADE;

ALTER TABLE appointments
ADD CONSTRAINT fk_doctor
FOREIGN KEY (doctor_id)
REFERENCES users(id)
ON DELETE CASCADE;



ALTER TABLE appointments
ADD COLUMN status
ENUM('scheduled','completed','canceled')
DEFAULT 'scheduled';

SELECT * FROM appointments;