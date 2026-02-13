USE doctor_app;

-- إدخال التخصصات الطبية
INSERT INTO specialties (name_ar, name_en) VALUES
('طبيب قلب', 'Cardiologist'),
('طبيب عظام', 'Orthopedist'),
('طبيب آذن', 'ENT Specialist'),
('طبيب عيون', 'Ophthalmologist'),
('طبيب باطنة', 'Internist'),
('طبيب أطفال', 'Pediatrician'),
('طبيب جلدية', 'Dermatologist'),
('طبيب نفسي', 'Psychiatrist');

-- إدخال بيانات الأطباء
INSERT INTO doctors (name_ar, specialty_id, phone, city, rating, experience_years, consultation_fee) VALUES
('د. أحمد محمد', 1, '+966501234567', 'الرياض', 4.5, 10, 200.00),
('د. سارة عبدالله', 2, '+966502345678', 'جدة', 4.8, 8, 180.00),
('د. خالد حسن', 3, '+966503456789', 'الدمام', 4.2, 12, 150.00),
('د. فاطمة علي', 4, '+966504567890', 'الرياض', 4.7, 7, 220.00),
('د. محمد عبدالرحمن', 1, '+966505678901', 'جدة', 4.9, 15, 250.00);

-- إدخال جداول العمل للأطباء
INSERT INTO doctor_schedules (doctor_id, day_of_week, start_time, end_time) VALUES
(1, 'sunday', '09:00:00', '12:00:00'),
(1, 'monday', '09:00:00', '12:00:00'),
(1, 'tuesday', '14:00:00', '17:00:00'),
(2, 'sunday', '10:00:00', '13:00:00'),
(2, 'wednesday', '10:00:00', '13:00:00'),
(3, 'monday', '08:00:00', '11:00:00'),
(3, 'thursday', '08:00:00', '11:00:00'),
(4, 'tuesday', '15:00:00', '18:00:00'),
(4, 'wednesday', '15:00:00', '18:00:00'),
(5, 'sunday', '16:00:00', '19:00:00'),
(5, 'thursday', '16:00:00', '19:00:00');

-- إدخال التشخيصات الشائعة
INSERT INTO common_diagnoses (name_ar, name_en, symptoms, recommendations) VALUES
('نقص دم', 'Anemia', 'شحوب، تعب، ضيق تنفس', 'تناول الأغذية الغنية بالحديد، فيتامين ب12'),
('ارتفاع الضغط', 'Hypertension', 'صداع، دوخة، نزيف أنفي', 'تقليل الملح، ممارسة الرياضة، المتابعة الدورية'),
('السكري', 'Diabetes', 'عطش شديد، تبول متكرر، تعب', 'مراقبة السكر، نظام غذائي، أدوية منتظمة'),
('نزلة برد', 'Common Cold', 'سعال، عطس، احتقان أنفي', 'راحة، سوائل، أدوية مسكنة'),
('الصداع النصفي', 'Migraine', 'صداع نصفي، غثيان، حساسية للضوء', 'راحة في غرفة مظلمة، أدوية مسكنة');

-- إدخال بيانات مرضى نموذجية
INSERT INTO patients (name_ar, email, phone, date_of_birth, gender) VALUES
('محمد أحمد', 'mohamed@example.com', '+966511111111', '1985-05-15', 'male'),
('نورة السعد', 'nora@example.com', '+966522222222', '1990-08-22', 'female'),
('خالد الرشيد', 'khaled@example.com', '+966533333333', '1978-12-10', 'male');

-- إدخال مواعيد نموذجية
INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, status) VALUES
(1, 1, '2024-03-20', '10:00:00', 'confirmed'),
(2, 3, '2024-03-21', '09:00:00', 'pending'),
(3, 2, '2024-03-22', '11:00:00', 'completed');