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

    public function addCour(Cour $cour)
    {

        // Récupération des valeurs depuis l'objet Cour
        $titre = $cour->getTitre();
        $descr = $cour->getDescription();
        $price = $cour->getPrice();
        $categoryId = $cour->getCategoryId();
        $images = $cour->getimages();
        $contenu = $cour->getContenu();
        $videoUrl = $cour->getVideoUrl();
        $instructorId = $cour->getInstructorId();
        $difficulty = $cour->getDifficulty();
        $duration = $cour->getDuration();
        $cour->setStatus('pending');
        $status = $cour->getStatus();
        echo "<pre>";
        var_dump($cour);
        echo $cour->getInstructorId();
        echo "</pre>";
        try {
            $query = "INSERT INTO courses (
                titre, description, price, categoryId, images, contenu, videoUrl, instructorId , difficulty, duration,status
            ) VALUES (
                :titre, :description, :price, :categoryId, :images, :contenu, :videoUrl,:instructorId ,:difficulty, :duration,:status
            )";
            $stmt = $this->conn->prepare($query);
            echo "fdgvgd";

            // Liaison des paramètres
            $stmt->bindParam(":titre", $titre);
            $stmt->bindParam(":description", $descr);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":categoryId", $categoryId);
            $stmt->bindParam(":images", $images);
            $stmt->bindParam(":contenu", $contenu);
            $stmt->bindParam(":videoUrl", $videoUrl);
            $stmt->bindParam(":instructorId", $instructorId);
            $stmt->bindParam(":difficulty", $difficulty);
            $stmt->bindParam(":duration", $duration);
            $stmt->bindParam(":status", $status);

            // Exécution de la requête
            $stmt->execute();
            echo "execute";
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'insertion du cours : " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Une erreur inattendue s'est produite : " . $e->getMessage());
        }
    }


    public function updateCour(Cour $cour): void
    {
        // Requête de mise à jour de toutes les colonnes
        $query = "
            UPDATE courses 
            SET 
                titre = :courtitre, 
                description = :courdescription, 
                contenu = :courContent,
                images = :image,
                price = :price,
                categoryId = :categoryId,
                Difficulty = :difficulty,
                Duration = :duration,
                videoUrl = :videoUrl,
                createdDate = :createdDate,
                instructorId = :instructorId,
                status = :status
            WHERE id = :id";
    
        try {
            // Préparer la requête
            $stmt = $this->conn->prepare($query);
    
            // Exécuter la requête avec les valeurs des paramètres
            $stmt->execute(
                [
                    ':courtitre' => $cour->gettitre(),
                    ':courdescription' => $cour->getdescription(),
                    ':courContent' => $cour->getcontenu(),
                    ':image' => $cour->getimages(),
                    ':price' => $cour->getPrice(),
                    ':categoryId' => $cour->getCategoryId(),
                    ':difficulty' => $cour->getDifficulty(),
                    ':duration' => $cour->getDuration(),
                    ':videoUrl' => $cour->getVideoUrl(),
                    ':createdDate' => $cour->getCreatedDate(),
                    ':instructorId' => $cour->getInstructorId(),
                    ':status' => $cour->getStatus(),
                    ':id' => $cour->getId() // Assurez-vous de mettre à jour le cours par ID
                ]
            );
        } catch (Exception $e) {
            throw new Exception("Error while saving course into database: " . $e->getMessage());
        }
    }
    

    public function deleteCour(int $id): void
    {
        $query = "DELETE FROM courses WHERE id = :courId";
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
        $query = "SELECT COUNT(*) AS CourCount FROM courses";
        $statement = $this->conn->query($query);
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return (int) $result->CourCount;
    }

    public function getAllCours(int $page , int $itemsPerPage = 6): array
    {
        // Calculate the starting point for the query
        $offset = ($page - 1) * $itemsPerPage;

        // Modify the query to include pagination
        $query = "SELECT * FROM courses LIMIT :limit OFFSET :offset";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }


    public function getCourseById($id): array
    {
           $query = "SELECT 
         c.*, 
         cat.name AS category_name, 
         u.nom AS instructor_name, 
           COUNT(e.studentId) AS student_count,
           GROUP_CONCAT(DISTINCT tags.name) AS tag_names
          FROM 
          courses c
          left join 
          coursetag on  c.id=coursetag.courseId
          left join 
          tags on coursetag.tagId=tags.id
         LEFT JOIN 
           categories cat ON c.categoryId = cat.id
         LEFT JOIN 
         users u ON c.instructorId = u.id
         LEFT JOIN 
        enrollment e ON e.courseId = c.id
         WHERE 
          c.id = :id
          GROUP BY 
    c.id, c.titre, c.description, c.price, c.categoryId, 
    c.images, c.contenu, c.videoUrl, c.createdDate, 
    c.instructorId, c.Difficulty, c.Duration, cat.name, u.nom ";

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