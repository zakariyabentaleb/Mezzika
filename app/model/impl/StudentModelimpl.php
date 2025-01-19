<?php
require_once("C:\Users\youco\Desktop\iLearN-platform\app\model\StudentModel.php");
require_once ('C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php');
require_once ('C:\Users\youco\Desktop\iLearN-platform\app\entities\Cours.php');

class StudentModuleimpl implements StudentModel
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }
    public function enroll(int $studentId, int $courseId): array|string
    {

        $checkQuery = "SELECT * FROM enrollment WHERE studentId = :studentId AND courseId = :courseId";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(":studentId", $studentId, PDO::PARAM_INT);
        $stmt->bindParam(":courseId", $courseId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return "You are already enrolled in this course";
        }

        $insertQuery = "INSERT INTO enrollment (studentId, courseId, enrollmentDate) VALUES (:studentId,:courseId, NOW())";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bindParam(":studentId", $studentId, PDO::PARAM_INT);
        $stmt->bindParam(":courseId", $courseId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Failed to enroll the student: ";
        }
    }

    public function getEnrolledCourses(int $studentId): array|bool
    {
        $query = "SELECT courses.*, users.nom AS instructorName 
                  FROM courses
                  JOIN enrollment ON courses.id = enrollment.courseId
                  JOIN users ON courses.instructorId = users.id
                  WHERE enrollment.studentId = :studentId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":studentId", $studentId, PDO::PARAM_INT);
        $stmt->execute();
               
        $courses = [];
       
        while ($course = $stmt->fetch(PDO::FETCH_OBJ)) {
            // $courses[] = $course;
            $course = new Cour(
                $course->titre,
                $course->description,
                $course->contenu,
                $course->id,
                null,
                null,
                $course->images
            );
            $courses[] = $course;
            
        }
     
        return $courses;
              
    }

}

?>