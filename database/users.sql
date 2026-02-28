USE medicalsign;

-- إذا مرة سابقة كان عندك جدول اسمه Users بحرف كبير وتبين توحيد الاسم إلى users:
-- RENAME TABLE Users TO users;  -- نفّذيها مرة واحدة فقط ثم علّقي السطر

-- 1) إنشاء الجدول إن لم يكن موجودًا
CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  name     VARCHAR(100),
  email    VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role     VARCHAR(50)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2) مواءمة الهيكل لو كان الجدول بصيغة قديمة
-- لو كان عندك عمود id وتبين توحّديه إلى user_id فعّلي السطر التالي:
-- ALTER TABLE users CHANGE COLUMN id user_id INT;

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