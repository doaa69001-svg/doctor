<?php
class Database {
    private $host = "localhost";
    private $db_name = "doctor_app";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8mb4");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

// دوال مساعدة للتعامل مع قاعدة البيانات
function getSpecialties($conn) {
    $sql = "SELECT * FROM specialties ORDER BY name_ar";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDoctorsBySpecialty($conn, $specialty_id) {
    $sql = "SELECT d.*, s.name_ar as specialty_name 
            FROM doctors d 
            LEFT JOIN specialties s ON d.specialty_id = s.id 
            WHERE d.specialty_id = :specialty_id AND d.is_available = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':specialty_id', $specialty_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDoctorSchedule($conn, $doctor_id) {
    $sql = "SELECT * FROM doctor_schedules WHERE doctor_id = :doctor_id AND is_available = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':doctor_id', $doctor_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function bookAppointment($conn, $patient_id, $doctor_id, $date, $time) {
    $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, status) 
            VALUES (:patient_id, :doctor_id, :appointment_date, :appointment_time, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':doctor_id', $doctor_id);
    $stmt->bindParam(':appointment_date', $date);
    $stmt->bindParam(':appointment_time', $time);
    return $stmt->execute();
}

function searchDoctors($conn, $query, $specialty_id = null, $city = null) {
    $sql = "SELECT d.*, s.name_ar as specialty_name 
            FROM doctors d 
            LEFT JOIN specialties s ON d.specialty_id = s.id 
            WHERE (d.name_ar LIKE :query OR s.name_ar LIKE :query) 
            AND d.is_available = 1";
    
    $params = [':query' => "%$query%"];
    
    if ($specialty_id) {
        $sql .= " AND d.specialty_id = :specialty_id";
        $params[':specialty_id'] = $specialty_id;
    }
    
    if ($city) {
        $sql .= " AND d.city = :city";
        $params[':city'] = $city;
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCommonDiagnoses($conn) {
    $sql = "SELECT * FROM common_diagnoses ORDER BY name_ar";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>