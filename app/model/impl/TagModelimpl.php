<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\TagModel.php');
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once('C:\Users\youco\Desktop\iLearN-platform\app\entities\Tags.php');
class TagModelimpl implements TagModel
{
    
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createTag( string $name): string
    {
        $stmt =  $this->conn ->prepare('INSERT INTO tags (name) VALUES (:name)');
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function getTags(): array
    {
        $query = 'SELECT * FROM tags';
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    
        $tags = [];
        foreach ($result as $row) {
            $tags[] = new Tag(
                (int) $row->id,          // Conversion de l'ID en entier
                $row->name
            );
        }
    
        return $tags;
    }
    
    public function deleteTag(int $id): bool
    {
        $query = 'DELETE FROM tags WHERE id = :id';
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    

}
?>