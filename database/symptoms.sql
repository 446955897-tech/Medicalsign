CREATE DATABASE IF NOT EXISTS medicasign;
USE medicasign;

CREATE TABLE IF NOT EXISTS symptoms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_ar VARCHAR(100) NOT NULL,);
    description_ar TEXT,
    icon VARCHAR(255),
    video_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
USE medicasign;
INSERT INTO symptoms (name_ar, description_ar, icon, video_url)
VALUES
-- 1) صداع (بعد تغيير الصورة)
('صداع',
 'ألم في الرأس قد يكون في الجبهة أو الجانبين.',
 'icon/صداع.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=headache'),

-- 2) ألم بطن
('ألم بطن',
 'ألم في منطقة البطن وقد يكون مصحوبًا بالغثيان.',
 'icon/الم بطن.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=stomach+ache'),

-- 3) دوخة
('دوخة',
 'شعور بعدم الاتزان أو دوران الرأس.',
 'icon/دوخة.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=dizzy'),

-- 4) حرارة
('حرارة',
 'ارتفاع في درجة حرارة الجسم.',
 'icon/حمى.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=fever'),

-- 5) كحة
('كحة',
 'سعال متكرر وقد يكون جافًا أو مصحوبًا ببلغم.',
 'icon/كحة.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=cough'),

-- 6) غثيان
('غثيان',
 'شعور بعدم الارتياح بالمعدة مع رغبة في القيء.',
 'icon/غثيان.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=nausea'),

-- 7) قيء
('قيء',
 'اندفاع محتويات المعدة إلى الخارج.',
 'icon/قيء.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=vomit'),

-- 8) التهاب حلق
('التهاب حلق',
 'ألم أو تهيّج في الحلق يزداد مع البلع.',
 'icon/التهاب.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=sore+throat'),

-- 9) زكام
('زكام',
 'انسداد أو سيلان الأنف مع عطاس وإرهاق خفيف.',
 'icon/زكام.jpeg',
 'https://www.spreadthesign.com/en.us/search/?q=cold');

