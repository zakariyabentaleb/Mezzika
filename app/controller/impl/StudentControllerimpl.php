<?php
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\entities\Student.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\enums\Role.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\StudentModel.php';
require_once 'C:\Users\youco\Desktop\iLearN-platform\app\model\impl\StudentModelimpl.php';
class StudentControllerimpl {

    private StudentModuleimpl $studentModel;
    public function __construct()
    {
        $this->studentModel = new StudentModuleimpl();
    }
    
    public function enroll(int $studentId, int $courseId):array|string {
        try {    
            $result=$this->studentModel->enroll($studentId, $courseId);
            return $result;
            } 
        catch (Exception $e) {  
            return false ;
           }
    }
    public function getEnrolledCourses(int $studentId): array|bool
    {
        try {    
            $result=$this->studentModel->getEnrolledCourses($studentId);
            return $result;
            } 
        catch (Exception $e) {  
            return false ;
           }
    }

}
?>