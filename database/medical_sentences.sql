CREATE TABLE Medical_sentences (
    sentence_id INT AUTO_INCREMENT PRIMARY KEY,
    sentence_text VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    sign_video VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    ON UPDATE CURRENT_TIMESTAMP 
);

USE medicasign;

ALTER TABLE Medical_sentences CHANGE sentence_text name_ar VARCHAR(255) NOT NULL;
ALTER TABLE Medical_sentences CHANGE description description_ar TEXT;
ALTER TABLE Medical_sentences CHANGE sign_video video_url VARCHAR(255) NOT NULL;

ALTER TABLE Medical_sentences CHANGE category icon VARCHAR(255);

INSERT INTO Medical_sentences(name_ar, description_ar, icon, video_url)
VALUES
-- 1
('مرحباً، كيف يمكنني مساعدتك اليوم؟', 'جملة ترحيبية لبدء التشخيص.', 'icon/welcome.jpeg', 'https://postimg.cc/fkhJq2nn'),

-- 2
('منذ متى وأنت تشعر بهذا التعب؟', 'سؤال عن مدة ظهور الأعراض.', 'icon/duration.jpeg', 'https://postimg.cc/ZC5YXXwr'),

-- 3
('أين مكان الألم بالضبط؟', 'تحديد موقع الألم في الجسم.', 'icon/location.jpeg', 'https://postimg.cc/KRjF0BY5'),

-- 4
('هل تشعر بصداع في رأسك؟', 'الاستفسار عن وجود آلام في الرأس.', 'icon/headache.jpeg', 'https://postimg.cc/WFscgJKx'),

-- 5
('هل تشعر بدوار أو عدم اتزان؟', 'الاستفسار عن الدوخة وفقدان التوازن.', 'icon/dizzy.jpeg', 'https://postimg.cc/RN2rGYy3'),

-- 6
('هل تعاني من حساسية تجاه أي دواء؟', 'التحقق من وجود حساسية دوائية.', 'icon/allergy.jpeg', 'https://postimg.cc/rKBb5rR1'),

-- 7
('هل تعاني من أمراض مزمنة؟', 'التأكد من التاريخ الطبي للمريض.', 'icon/chronic.jpeg', 'https://postimg.cc/V5THcCRV'),

-- 8
('هل تتناول أي أدوية حالياً؟', 'حصر الأدوية التي يستخدمها المريض.', 'icon/meds.jpeg', 'https://postimg.cc/LqNNQY5N'),

-- 9
('هل تشعر بغثيان أو رغبة في القيء؟', 'الاستفسار عن مشاكل الجهاز الهضمي.', 'icon/nausea.jpeg', 'https://postimg.cc/c6KXTJSg'),

-- 10
('من فضلك، اجلس هنا واسترح.', 'توجيه للمريض بالجلوس.', 'icon/sit.jpeg', 'https://postimg.cc/QKr9pSDb'),

-- 11
('خذ نفساً عميقاً من فضلك.', 'تعليمات فحص الجهاز التنفسي.', 'icon/breath.jpeg', 'https://postimg.cc/wty7ZnTF'),

-- 12
('سأقوم بقياس درجة حرارتك الآن.', 'بدء إجراء قياس الحرارة.', 'icon/temp.jpeg', 'https://postimg.cc/QH8gwxLq'),

-- 13
('سأقيس ضغط الدم الآن.', 'بدء إجراء قياس الضغط.', 'icon/pressure.jpeg', 'https://postimg.cc/DmF14yzw'),

-- 14
('افتح فمك من فضلك.', 'فحص الفم والحلق.', 'icon/mouth.jpeg', 'https://postimg.cc/MMYMmVGq'),

-- 15
('استلقِ على السرير من فضلك.', 'توجيه للمريض للاستلقاء للفحص.', 'icon/bed.jpeg', 'https://postimg.cc/7fhGSCrS'),

-- 16
('خذ هذا الدواء مرتين يومياً، صباحاً ومساءً.', 'تعليمات جرعة الدواء.', 'icon/dose.jpeg', 'https://postimg.cc/WDWKxJCT'),

-- 17
('يجب أخذ هذا الدواء قبل الأكل بـ 30 دقيقة.', 'توقيت تناول الدواء.', 'icon/before_food.jpeg', 'https://postimg.cc/D8R1pfBS'),

-- 18
('تحتاج إلى راحة تامة في السرير لمدة يومين.', 'توصية بالراحة الجسدية.', 'icon/rest.jpeg', 'https://postimg.cc/bsStncpv'),

-- 19
('اشرب كمية كافية من الماء يومياً.', 'نصيحة طبية عامة بالترطيب.', 'icon/water.jpeg', 'https://postimg.cc/nMCj8bsd'),

-- 20
('تجنب الأطعمة الدسمة والحارة.', 'تعليمات غذائية.', 'icon/food_avoid.jpeg', 'https://postimg.cc/xJqCSMdG'),

-- 21
('راجع المستشفى إذا ساءت حالتك.', 'تعليمات المتابعة الطارئة.', 'icon/hospital.jpeg', 'https://postimg.cc/JyYrK0Q1'),

-- 22
('هل لديك أي سؤال آخر قبل المغادرة؟', 'ختام الجلسة الطبية.', 'icon/question.jpeg', 'https://postimg.cc/HcMq5kZv');