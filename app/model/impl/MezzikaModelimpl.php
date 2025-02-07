<?php
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\CourModel.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once('C:\Users\youco\Desktop\iLearN-platform\app\entities\Cours.php');
class MezzikaModelimpl implements MezzikaModel
{

    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function addSong(Song $song)
{
    $title = $song->getTitle();
    $artistId = $song->getArtistId();
    $genre = $song->getGenre();
    $releaseDate = $song->getReleaseDate();
    $filePath = $song->getFilePath();

    try {
        $query = "INSERT INTO songs (
            title, artist_id, genre, release_date, file_path
        ) VALUES (
            :title, :artist_id, :genre, :release_date, :file_path
        )";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":artist_id", $artistId);
        $stmt->bindParam(":genre", $genre);
        $stmt->bindParam(":release_date", $releaseDate);
        $stmt->bindParam(":file_path", $filePath);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de l'insertion de la chanson : " . $e->getMessage());
    } catch (Exception $e) {
        throw new Exception("Une erreur inattendue s'est produite : " . $e->getMessage());
    }
}



public function updateSong(Song $song) : void
{
    $query = "
        UPDATE songs
        SET 
            title = :songtitle,
            artist_id = :artistId,
            genre = :genre,
            release_date = :releaseDate,
            file_path = :filePath,
            status = :status
        WHERE id = :id";

    try {
        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                ':songtitle' => $song->getTitle(),
                ':artistId' => $song->getArtistId(),
                ':genre' => $song->getGenre(),
                ':releaseDate' => $song->getReleaseDate(),
                ':filePath' => $song->getFilePath(),
                ':id' => $song->getId()
            ]
        );
    } catch (Exception $e) {
        throw new Exception("Error while updating song in database: " . $e->getMessage());
    }
}

    public function deleteSong(int $id): void
    {
        $query = "DELETE FROM songs WHERE id = :courId";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':courId', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function searchSong(string $titre): array
    {
        $query = "
            SELECT DISTINCT courses.*
            FROM courses
            WHERE courses.titre LIKE CONCAT('%', :titre, '%');
        ";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR); 
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 

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


    public function countSong(): int
    {
        $query = "SELECT COUNT(*) AS CourCount FROM courses";
        $statement = $this->conn->query($query);
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return (int) $result->CourCount;
    }

    public function getAllSongs(int $page , int $itemsPerPage = 6): array
    {
       
        $offset = ($page - 1) * $itemsPerPage;

      
        $query = "SELECT * FROM courses LIMIT :limit OFFSET :offset";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }


    public function getSongById($id): array
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

    public function getSongArtist(int $id): array
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
    public function getAllSongs(): array {
        try {
           
            $query = "select * from courses inner join  users on courses.instructorId=users.id;";
            
           
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
    
          
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
          
            return $courses;
        } catch (PDOException $e) {
           
            throw new Exception("Erreur lors de la récupération des cours : " . $e->getMessage());
        }
    }
    
    }



?>