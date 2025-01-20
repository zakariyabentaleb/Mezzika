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
                WHERE c.instructorId = :instructorId
            ";
        $stmt = $this->conn->prepare($query);

        if ($stmt) {
            $stmt->bindParam(':instructorId', $instructorId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['total_enrolled_students'];
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
                    c.description,
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
                // $coursee->total_rows = $course->total_rows;
                $coursee->setTotalRows($course->total_rows);
                $courses[] = $coursee;

            }

        }


        return $courses;


    }

    public function getCourseStatistics(int $instructorId): array
    {
        try {


            $query = "
            SELECT 
             COUNT(DISTINCT c.id) AS total_rows, 
           COUNT(DISTINCT e.studentId) AS students
           FROM 
            courses c
          LEFT JOIN 
        enrollment e ON e.courseId = c.id
          WHERE 
            c.instructorId = :instructorId;
        ";

            $stmt = $this->conn->prepare($query);

            // Lier l'ID de l'instructeur
            $stmt->bindParam(':instructorId', $instructorId, PDO::PARAM_INT);

            // Exécuter la requête
            $stmt->execute();

            // Récupérer les résultats
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retourner les statistiques sous forme de tableau
            return [
                'total_courses' => $result['total_rows'] ?? 0,
                'total_students' => $result['students'] ?? 0
            ];
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des statistiques : " . $e->getMessage());
        }
    }

    public function deleteTeacher(string $nom) : bool {
        try {
            $query = "DELETE FROM users WHERE nom = :name";
            $stmt = $this->conn->prepare($query);
    
          
            $stmt->bindParam(':name', $nom, PDO::PARAM_STR);
    
            
            $result = $stmt->execute();
    
           
            return $result;
    
        } catch (PDOException $e) {
            return false;
        }
    }

}




?>