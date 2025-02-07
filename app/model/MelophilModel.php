<?php 

interface MelophilModel {
    public function enroll(int  $studentId, int $courseId): array|string ;
    
    public function getEnrolledCourses(int $studentId) : array|bool;
       
    public function deleteStudent(string $nom) : bool;
}
?>