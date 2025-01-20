<?php
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\entities\Cours.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\CourModelimpl.php';
 class Courcontrollerimpl {
    private CourModelimpl $courModel;
    public function __construct()
    {
        $this->courModel = new CourModelimpl();
    }

    public function fetchCours($p): array|bool {
        try {
            $result=$this->courModel->getAllCours($p);
            return $result;
            
     
        }
        catch (Exception $e) {
            return false ;

    }
    }
    public function getCourseById($id): array|bool 
    {
       try {   
        $result=$this->courModel->getCourseById($id);
        return $result;

    }
    catch (Exception $e) {
        return false ;

    }
 }
 public function getCourseTeacher(  int $id) : array|bool
  {
   try {    
    $result=$this->courModel->getCourseTeacher($id);
    return $result;
    } 
catch (Exception $e) {  
    return false ;
   }

}

public function getCoursetags(int $id): array|bool {
       
    try {    
        $result=$this->courModel->getCoursetags($id);
        return $result;
        } 
    catch (Exception $e) {  
        return false ;
       }
}
public function countCour(): int {
    try {    
        $result=$this->courModel->countCour();
        return $result;
        } 
    catch (Exception $e) {  
        return false ;
       }


}
 public function getAllCour(): array|bool {
    try {    
        $result=$this->courModel->getAllCour();
        return $result;
        } 
    catch (Exception $e) {  
        return false ;
       }
 }
 }
?>