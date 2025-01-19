<?php

require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\CourModel.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once('C:\Users\youco\Desktop\iLearN-platform\app\entities\Cours.php');
class CourModelimpl implements CourModel
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function addCour(Cour $cour): bool
    {

        $query = "INSERT INTO Cours (titre  , description , contenu , image ) values (:titre , :description, :contenu , :image )";
        try {
            $stmt = $this->conn->prepare($query);

            return $stmt->execute(
                [
                    ':titre' => $cour->gettitre(),
                    ':description' => $cour->getdescription(),
                    ':contenu' => $cour->getcontenu(),
                    ':image' => $cour->getimages() ?? "hhhhhhhhh.jpg"

                ]
            );

        } catch (Exception $e) {
            throw new Exception("error while saving user into database");
        }
    }

    public function updateCour(Cour $cour): void
    {



        $query = "UPDATE Cours SET titre = :courtitre, description = :courdescription, contenu = :courContent , image = :image ";


        try {
            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    ':courtitre' => $cour->gettitre(),
                    ':courdescription' => $cour->getdescription(),
                    ':courContent' => $cour->getcontenu(),
                    ':image' => $cour->getimages() ?? "hhhhhhhhh.jpg"

                ]
            );

        } catch (Exception $e) {
            throw new Exception("error while saving user into database");
        }
    }

    public function deleteCour(int $id): void
    {
        $query = "DELETE FROM Cours WHERE id = :courId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':courId', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function searchCour(string $titre): array
    {
        $query = "
            SELECT DISTINCT courses.*
            FROM courses
            WHERE courses.titre LIKE CONCAT('%', :titre, '%');
        ";
    
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR); // Bind the title parameter properly
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results as an associative array
    
            $courses = [];
    
            foreach ($results as $courseResult) {
                $course = new Cour($courseResult["titre"], $courseResult["description"], $courseResult["contenu"], $courseResult["id"]);
                $courses[] = $course;
            }
    
            return $courses;
    
        } catch (Exception $e) {
            throw new Exception("Error fetching courses: " . $e->getMessage());
        }
    }
    

    public function countCour(): int
    {
        $query = "SELECT COUNT(*) AS CourCount FROM Cour";
        $statement = $this->conn->query($query);
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return (int) $result->CourCount;
    }

    public function getAllCours(): array
    {
        $query = "select * from courses";
        $statement = $this->conn->query($query);
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }



    public function getCourseById($id): array
    {
        $query = "SELECT c.*, 
                         cat.name AS category_name, 
                         COUNT(e.studentId) AS student_count
                  FROM courses c
                  LEFT JOIN categories cat ON c.categoryId = cat.id
                  LEFT JOIN enrollment e ON e.courseId = c.id
                  WHERE c.id = :id
                  GROUP BY c.id, c.titre, c.description, c.price, c.categoryId, 
                           c.images, c.contenu, c.videoUrl, c.createdDate, 
                           c.instructorId, c.Difficulty, c.Duration, cat.name";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCourseTeacher(int $id): array
    {
        $query = "SELECT courses.*, users.nom AS teacher 
              FROM courses 
              INNER JOIN users 
              ON courses.instructorId = users.id 
              WHERE courses.id = :id ;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getCoursetags(int $id): array
    {

        $query = "SELECT courses.titre, tags.name
                    FROM courses
                  INNER JOIN coursetag ON courses.id = coursetag.courseId
                 INNER JOIN tags ON coursetag.tagId = tags.id
                  WHERE courses.id = :id ;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

}

?>