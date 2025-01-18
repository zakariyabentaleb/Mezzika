<?php
require_once("../StudentModel.php");
class StudentModuleimpl implements StudentModel {

    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }



    public function enroll(int $studentId, int $courseId) {

    $checkQuery = "SELECT * FROM enrollment WHERE studentId = :studentId AND courseId = :courseId";
    $stmt =  $this->conn->prepare($checkQuery);
    $stmt->bindParam(":studentId", $studentId, PDO::PARAM_INT);
    $stmt->bindParam(":courseId", $courseId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result > 0) {
        return "You are already enrolled in this course"; 
    }

    $insertQuery = "INSERT INTO enrollment (studentId, courseId, enrollmentDate) VALUES (?, ?, NOW())";
    $stmt = $this->conn->prepare($insertQuery);
    $stmt->bindParam(":studentId", $studentId, PDO::PARAM_INT);
    $stmt->bindParam(":courseId", $courseId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true; 
    } else {
        return "Failed to enroll the student: ";
    }
}
}
?>