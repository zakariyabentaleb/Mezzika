<?php 

interface ArtistModel {
    public function getEnrolledStudentsCount(int $instructorId):int;
    
    public function getMezikkaWithDetails(int $instructorId):array ;
     
    function getMezikkaStatistics(int $instructorId): array ;

    public function deleteArtist(string $nom) : bool;
}
?>