


USE medicalsign;

ALTER TABLE users
  ADD COLUMN IF NOT EXISTS  user_id INT,
  ADD COLUMN IF NOT EXISTS name VARCHAR(100),
  ADD COLUMN IF NOT EXISTS email VARCHAR(100),
  ADD COLUMN IF NOT EXISTS password VARCHAR(255),
  ADD COLUMN IF NOT EXISTS role VARCHAR(50);

ALTER TABLE users
  MODIFY COLUMN  user_id INT NOT NULL AUTO_INCREMENT,
  MODIFY COLUMN name VARCHAR(100),
  MODIFY COLUMN email VARCHAR(100) NOT NULL,
  MODIFY COLUMN password VARCHAR(255) NOT NULL,
  MODIFY COLUMN role VARCHAR(50) NOT NULL;



INSERT INTO users (name, email, password, role) VALUES
('مريض تجريبي', 'patient@test.com', '1234', 'patient'),
('طبيب تجريبي', 'doctor@test.com', '1234', 'doctor');

