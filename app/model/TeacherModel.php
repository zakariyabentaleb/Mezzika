<?php 

interface TeacherModel {
    public function getEnrolledStudentsCount(int $instructorId):int;
    
    public function getCoursesWithDetails(int $instructorId):array ;
     
    function getCourseStatistics(int $instructorId): array ;
}
?>