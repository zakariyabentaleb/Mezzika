<?php
require_once('C:\Users\youco\Desktop\iLearN-platform\app\model\CategoryModel.php');
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\config\Database.php';
require_once('C:\Users\youco\Desktop\iLearN-platform\app\entities\Category.php');
class CategoryModelimpl implements CategoryModel
{
    
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createCategory( string $name): string
    {
        $stmt =  $this->conn ->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function getCategories(): array
    {
        $query = 'SELECT * FROM categories';
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    
        $categories = [];
        foreach ($result as $row) {
            $categories[] = new Category(
                (int) $row->id,          // Conversion de l'ID en entier
                $row->name
            );
        }
    
        return $categories;
    }
    
    public function deleteCategory(int $id): bool
    {
        $query = 'DELETE FROM categories WHERE id = :id';
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    

}
?>