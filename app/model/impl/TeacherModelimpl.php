<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\TeacherModel.php');
require_once('C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php');
require_once('C:\Users\youco\Desktop\iLearN-platform\app\entities\Cours.php');




class TeacherModelimpl implements TeacherModel
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }
    public function getEnrolledStudentsCount($instructorId): int
    {
        $enrolledStudentsCount = 0;

        $query = "
                SELECT COUNT(DISTINCT e.studentId) AS total_enrolled_students
                FROM enrollment e
                INNER JOIN courses c ON e.courseId = c.id
                WHERE c.instructorId = ?
            ";
        $stmt = $this->conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $instructorId);
            $stmt->execute();
            $stmt->bind_result($enrolledStudentsCount);
            $stmt->fetch();
            $stmt->close();
        }

        return $enrolledStudentsCount;
    }

    public function getCoursesWithDetails($instructorId): array
    {

        $courses = [];

        $query = "
                SELECT 
                    c.id, 
                    c.titre, 
                    cat.name AS category, 
                    c.description,  -- Ajouté
                    c.contenu,  
                       COUNT(*) AS total_rows  ,
                    COUNT(DISTINCT e.studentId) AS students
                    
                FROM courses c
                LEFT JOIN categories cat ON c.categoryId = cat.id
                LEFT JOIN enrollment e ON e.courseId = c.id
                WHERE c.instructorId = :instructorId
                GROUP BY c.id
            ";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":instructorId", $instructorId, PDO::PARAM_INT);
        $stmt->execute();

        $courses = [];

        while ($course = $stmt->fetch(PDO::FETCH_OBJ)) {
            // $courses[] = $course;
            if (isset($course->id, $course->titre, $course->description, $course->contenu)) {
                $coursee = new Cour(
                    $course->titre,
                    $course->description,
                    $course->contenu,
                    $course->id
                );
                $coursee->total_rows = $course->total_rows;
                $courses[] = $coursee;

            }

 
           
        }


        return $courses;


    }

}




?>