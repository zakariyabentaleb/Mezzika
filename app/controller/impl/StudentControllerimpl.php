<?php
require_once '../../entities/Student.php';
require_once '../../enums/Role.php';
require_once '../../model/StudentModel.php';
require_once '../../model/impl/StudentModelimpl.php';
class StudentControllerimpl {

    private StudentModuleimpl $studentModel;
    public function __construct()
    {
        $this->studentModel = new StudentModuleimpl();
    }
    
    public function enroll(int $studentId, int $courseId) {
        try {    
            $result=$this->studentModel->enroll($studentId, $courseId);
            return $result;
            } 
        catch (Exception $e) {  
            return false ;
           }
    }

}


?>