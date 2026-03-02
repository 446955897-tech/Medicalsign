USE medicalsign;

CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  name     VARCHAR(100),
  email    VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role     VARCHAR(50)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE users
  MODIFY COLUMN user_id INT NOT NULL AUTO_INCREMENT,
  MODIFY COLUMN name     VARCHAR(100),
  MODIFY COLUMN email    VARCHAR(100) NOT NULL,
  MODIFY COLUMN password VARCHAR(255) NOT NULL,
  MODIFY COLUMN role     VARCHAR(50)  NOT NULL;

-- 3) بيانات تجريبية
INSERT INTO users (name, email, password, role) VALUES
('مريض تجريبي', 'patient@test.com', '1234', 'patient'),
('طبيب تجريبي', 'doctor@test.com',  '1234', 'doctor');